@extends('principal')
@section('css')
@stop
@section('conteudo')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (isset($message))
        <div class="alert alert-{{ $type }}">
            <p class="text-center p-0 m-0"><span>{{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 mb-4">
            <form enctype="multipart/form-data" class="border px-3 py-5 m-4" style="border-radius: 10px"
                  action="{{ action((isset($contact_list)) ? 'ContactListController@edit':'ContactListController@create')}}"
                  method="POST">
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input name="name"
                           class="form-control"
                           id="exampleInputName"
                           value="{{ old('name')?? $contact_list->name ??'' }}">
                </div>
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                @if(!isset($contact_list))
                    <input type="file" name="csv" class="mr-3">
                    <button type="submit" class="btn btn-primary">Record</button>
                @else
                    <input type="hidden" name="_method" value="put"/>
                    <input type="hidden" name="id" value="{{ $contact_list->id  }}"/>
                    <button type="submit" class="btn btn-primary">Edit</button>
                @endif
            </form>
        </div>
        <div class="col-md-6 mb-4">
            @if(isset($contact_list))
                <button data-toggle="modal" data-target="#ExemploModal"
                        class="btn text-white m-4"
                        style="border: 3px solid darkorange;
           background: rgb(255, 181, 0); margin: 0px 10px;">
                    <svg viewBox="0 0 16 16" width="21px" height="21px"
                         fill="currentColor"
                         class="bi-plus-circle mr-2 b-icon bi">
                        <g data-v-7925e972="">
                            <path fill-rule="evenodd"
                                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                            <path fill-rule="evenodd"
                                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                        </g>
                    </svg>
                    Add new Contact
                </button>
            @endif

        </div>
        <a href="/list_management"
           class="btn text-white"
           style="border: 3px solid darkorange;
           background: rgb(255, 181, 0); margin: 0px 10px;">
            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
        <!-- modal start new contact -->
        <div class="modal fade" id="ExemploModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog row" role="document">
                <div class="modal-content col-12">
                    <form class="border w-100 p-3 my-2"
                          style="border-radius: 10px"
                          action="{{ action('ContactController@create')}}" method="POST">
                        <div id="modal-header" class="text-center  text-secondary h5">New Contact</div>
                        <div id="modal-body" class="row">

                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <input type="hidden" name="contact_list_id"
                                   value="@if(isset($contact_list)) {{ $contact_list->id  }} @endif"/>

                            <div class="mb-3 col-12">
                                <label for="exampleInputName" class="form-label">Name</label>
                                <input name="name"
                                       class="form-control"
                                       id="exampleInputName"
                                       value="{{ old('name')?? $contact->name ??'' }}">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="exampleInputPhone" class="form-label">Cell Phone</label>
                                <input name="cell_phone"
                                       class="form-control"
                                       id="exampleInputPhone"
                                       value="{{ old('cell_phone')?? $contact->cell_phone ??'' }}">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="exampleCpf" class="form-label">Email</label>
                                <input name="email"
                                       class="form-control"
                                       id="exampleCpf"
                                       value="{{ old('email')?? $contact->email ??'' }}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn  btn-outline-primary  col-2">add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal-->
    </div>
@stop