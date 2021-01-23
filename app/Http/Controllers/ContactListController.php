<?php

namespace App\Http\Controllers;

use App\Models\ContactList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ContactListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contact_list_creation');
    }


    public function create(Request $request)
    {
        $data = $request->only(['name', 'csv']);
        $validation = $this->getValidate($data);

        if ($validation->fails()) {
            return view('contact_list_creation')->with('errors', $validation->errors());
        }

        $file = $request->file('csv');

        $contact_list = ContactList::where('name', $data['name'])->first();

        if (is_null($contact_list)) {
            Excel::load($file, function ($reader) use ($data) {
                $results = $reader->get()->toArray();
                foreach ($results as $key => $value) {
                    ContactList::create(array(
                        'name' => $data['name'],
                        'phone' => $value['phone'],
                        'cpf' => $value['cpf'],
                        'status' => $value['status'],
                    ));
                }
            });

            $request->session()->flash('message', "contact list registered successfully !");
            $request->session()->flash('type', "success");
            return redirect()->route('list_contact');
        }

        return view('contact_list_creation')
            ->with('message', 'contact list with this name already exists !')
            ->with('type', 'danger');
    }


    public function store(Request $request)
    {
        $contact_list = ContactList::paginate(2);
        $message = $request->session()->get('message');
        $type = $request->session()->get('type');

        return view('list_management')->with('contact_lists', $contact_list)
            ->with('message', $message)
            ->with('type', $type);
    }


    public function show(int $id)
    {
        $contact_list = ContactList::find($id);
        if (is_null($contact_list)) {
            return view('list_management')->with('contact_lists', ContactList::all())
                ->with('message', 'contact list not found !')
                ->with('type', 'danger');
        }
        return view('contact_list_creation')->with('contact_list', $contact_list);

    }

    public function edit(Request $request)
    {
        $data = $request->only(['id', 'name', 'phone', 'CPF', 'status']);

        $contact_list = ContactList::find($data['id']);
        if (is_null($contact_list)) {
            return view('list_management')->with('contact_lists', ContactList::paginate(2))
                ->with('message', 'contact list not found !')
                ->with('type', 'danger');
        }

        $contact_list->fill($data);
        $contact_list->save();

        return view('list_management')->with('contact_lists', ContactList::paginate(2))
            ->with('message', 'contact list  updated successfully ! !')
            ->with('type', 'success');
    }


    public function update(Request $request, contactList $contactList)
    {
        //
    }


    public function destroy(Request $request)
    {
        $contact_list = ContactList::find($request['id']);

        if (is_null($contact_list)) {
            return view('list_management')->with('contact_lists', ContactList::all())
                ->with('message', 'contact list not found !')
                ->with('type', 'danger');
        }

        $contact_list->contacts()->delete();
        ContactList::destroy($request['id']);
        $request->session()->flash('message', "contact list removed successfully!");
        $request->session()->flash('type', "success");

        return redirect()->route('list_contact');
    }

    public function report(int $id)
    {
        $contact = ContactList::find($id);
        if (is_null($contact)) {
            return view('list_management')->with('contact_lists', ContactList::all())
                ->with('message', 'contact list not found !')
                ->with('type', 'danger');
        }
        $contact_list = ContactList::all();
        $contStatus = 0;
        foreach ($contact_list as $contact_item) {
            if($contact_item->status == $contact->status)  $contStatus++;
        }

        $porc = ($contStatus * 100)/count($contact_list);

        return view('contact_report')->with('contact', $contact)->with('porc', $porc);
    }

    public function getValidate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $messages = ['required' => 'o campo :attribute  não pode ser vazio !'];
        $validation = Validator::make($data, array(
            'name' => 'required',
            'csv' => 'required',
        ), $messages);

        return $validation;
    }
}
