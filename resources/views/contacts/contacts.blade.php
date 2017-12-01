@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading sling-main-panel">Link-Sling</div>
                <div class="panel-heading text-center"><h4>Contacts</h4></div>

                <div class="panel-body">

                    @foreach ($contacts as $contact)
                    <div class="row contact-row">
                        <div class="col-xs-2 text-center">
                            <div class="avatar-circle">
                                <span class="initials">
                                    {{ str_limit($contact->name, $limit = 1, $end = '') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-5 contact-text">
                            <a href="#contactModal{{ $contact->id }}" data-toggle="modal">
                                {{ $contact->name }}
                            </a>
                        </div>
                        <div class="col-xs-5 text-right contact-text">{{ $contact->mobileFormat($contact->mobile) }}</div>
                        
                        <div id="contactModal{{ $contact->id }}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="avatar-circle-lg">
                                            <span class="initials-lg">
                                                {{ str_limit($contact->name, $limit = 1, $end = '') }}
                                            </span>
                                        </div>
                                        <h4 class="modal-title">{{ $contact->name }}</h4>
                                        <span class="modal-edits">    
                                            <a href="#editContactModal{{ $contact->id }}" data-toggle="modal" data-dismiss="modal"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                                            <a href="#deleteContactModal{{ $contact->id }}" data-toggle="modal" data-dismiss="modal"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                    <div class="modal-body">
                                        <p>Contact Details</p>
                                        <p>
                                            <i class="fa fa-mobile fa-2x modal-mobile" aria-hidden="true"></i> <span class="mobile-num-modal">{{ $contact->mobileFormat($contact->mobile) }}</span>
                                        </p>
                                    </div>
                                    <div class="modal-footer sling-nav">
                                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="editContactModal{{ $contact->id }}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Contact</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="/contacts/{{ $contact->id }}" role="form">

                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                      <div class="form-group">
                                        <label for="link" class="col-sm-2 control-label"><i class="fa fa-user fa-lg" aria-hidden="true"></i></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="name" id ="name" value="{{ $contact->name }}">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="recipient" class="col-sm-2 control-label"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $contact->mobile }}">
                                        </div>
                                      </div>

                                      <div class="modal-footer">
                                        <div class="form-group">
                                            <div class="col-sm-12 text-center sling-nav">
                                              <button type="submit" class="btn btn-xs btn-default">Save</button>
                                              <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">Close</button>
                                            </div>
                                        </div>
                                      </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="deleteContactModal{{ $contact->id }}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Confirm Delete Contact</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p class="text-center">Are you sure you want to delete the contact: {{ $contact->name }}?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <div class="col-sm-12 text-center sling-nav">
                                                <form class="button-form" method="POST" action="/contact/{{ $contact->id }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-xs btn-default">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>

            <a href="#addContactModal" data-toggle="modal">
                <button class="btn btn-default add-contact"><span class="add-contact-plus">+</span></button>
            </a>

            <div id="addContactModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create Contact</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="/contact" role="form">

                              <input type="hidden" name="_token" value="{{ csrf_token() }}">

                              <div class="form-group">
                                <label for="link" class="col-sm-2 control-label"><i class="fa fa-user fa-lg" aria-hidden="true"></i></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="name" id ="name" placeholder="Contact Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="recipient" class="col-sm-2 control-label"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
                                </div>
                              </div>

                              <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-12 text-center sling-nav">  
                                      <button type="submit" class="btn btn-xs btn-default">Save</button>
                                      <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                              </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
