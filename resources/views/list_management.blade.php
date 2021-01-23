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
        <div class="col-12 ">
            <h3>contact list</h3>
        </div>
        <div class="col-md-7 mb-5">
            <div class="content">
                <ul class="list-group">
                    @foreach ($contact_lists as $lists)
                        <li class="row list-group-item-se m-2 px-0">
                            <a href="{{action('ContactListController@show', $lists->id)}}"
                               class="col-md-10  d-flex  justify-content-between align-items-center">
                                   <span class="text-dark w-100 h-100">
                                        <svg width="16" height="16" fill="currentColor" class="bi bi-record"
                                             viewBox="0 0 16 16">
                                             <path fill-rule="evenodd"
                                                   d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 1A5 5 0 1 0 8 3a5 5 0 0 0 0 10z"/>
                                         </svg>
                                        <strong class="mr-3">Name <small
                                                    class="text-muted">{{ $lists->name }}</small></strong>
                                   </span>
                                <span class="badge bg-primary rounded-pill text-white mr-2 d-inline-block">{{ count($lists->contacts) }}</span>
                            </a>
                            <div class="col p-0 d-flex">
                                <a href="{{action('ContactListController@report', $lists->id)}}">
                                    <svg  width="25" height="25"  class="mr-4" viewBox="0 0 16 16">
                                        <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                                    </svg>
                                </a>

                                <form method="post" action="list_management/{{ $lists->id }}"
                                      onsubmit="return confirm('Are you sure you want to remove {{ addslashes($lists->name) }}?')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="p-0" style="border-radius: 20px;border: 2px solid red ">
                                        <svg width="25" height="25" fill="red" class="btn-close" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                        </a>
                    @endforeach
                </ul>
                {{ $contact_lists->links() }}
            </div>
        </div>
        <div class="col-md-5">
            <a href="/list_management_creation"
               class="btn text-white"
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
                Add new list</a>
        </div>

    </div>
@stop
