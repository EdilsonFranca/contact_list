<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $data = $request->only(['name', 'cell_phone', 'email', 'photo', 'contact_list_id']);
        $validation = $this->getValidate($data);
        $contact_list = ContactList::find($data['contact_list_id']);

        if ($validation->fails()) {
            return view('contact_list_creation')->with('contact_list', $contact_list)
                                                      ->with('errors', $validation->errors());
        }

        $contact = Contact::where('name', $data['name'])->first();

        if (!is_null($contact)) {
            return view('contact_list_creation')->with('contact_list', $contact_list)
                ->with('message', 'already have contact with this name!')
                ->with('type', 'danger');
        }

        Contact::create($data);
        return view('contact_list_creation')->with('contact_list', $contact_list)
                                                 ->with('message', 'contact list successfully registered !')
                                                 ->with('type', 'success');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(contact $contact)
    {
        //
    }


    public function edit(contact $contact)
    {
        //
    }


    public function update(Request $request, contact $contact)
    {
        //
    }


    public function destroy(contact $contact)
    {
        //
    }

    public function getValidate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $validation = Validator::make($data, array(
            'name' => 'required',
            'cell_phone' => 'required',
            'email' => 'required',
            'contact_list_id' => 'required',
        ));

        return $validation;
    }
}
