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
                        <div class="col-xs-6">
                            <a href="#contactModal{{ $contact->id }}" data-toggle="modal">
                                {{ $contact->name }}
                            </a>
                        </div>
                        <div class="col-xs-6">{{ $contact->mobile }}</div>
                        <div id="contactModal{{ $contact->id }}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">{{ $contact->name }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Contact Details</p>
                                        <p>
                                            <i class="fa fa-mobile fa-2x" aria-hidden="true"></i> <span class="mobile-num-modal">{{ $contact->mobile }}</span>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
