@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default sling-panel">
                <div class="panel-heading sling-main-panel">Link-Sling</div>
                <div class="panel-heading text-center"><h4>History</h4></div>

                <div class="panel-body table-responsive">

                  <table class="table history-table">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Link</th>
                            <th>Date</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($messages as $message)
                    <tr>
                        <td>{{ $contacts->where('mobile', $message->mobile)->pluck('name')->first() }}</td>
                        <td>
                            <a href="#historyModal{{ $message->id }}" data-toggle="modal">
                                {{ str_limit($message->link, $limit = 25, $end = '...') }}
                            </a>
                            <div id="historyModal{{ $message->id }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ $contacts->where('mobile', $message->mobile)->pluck('name')->first() }}</h4>
                                            <h4 class="modal-title modal-mobile">{{ $message->mobileFormat($message->mobile) }}</h4>
                                            <span class="modal-edits">
                                                <a href="#deleteMessageModal{{ $message->id }}" data-toggle="modal" data-dismiss="modal"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                                            </span>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $message->link }}</p>
                                        </div>
                                        <div class="modal-footer sling-nav">
                                            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $message->dateFormat() }}</td>
                        <td class="text-center">
                            @if ($message->is_received == 1)
                                <a href="#" data-toggle="tooltip" data-placement="auto" title="Link sent">
                                    <i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i>
                                </a>
                            @elseif ($message->is_received == 0)
                                <a href="#" data-toggle="tooltip" data-placement="auto" title="Waiting for contact authorization">
                                    <i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>
                                </a>
                            @elseif ($message->is_received == 2)
                                <a href="#" data-toggle="tooltip" data-placement="auto" title="Contact declined receiving messages from Link-Sling">
                                    <i class="fa fa-times-circle-o fa-lg" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                    </tr>

                    @endforeach

                  </table>
                    
                </div>
            </div>

            @foreach ($messages as $message)

                <div id="deleteMessageModal{{ $message->id }}" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirm Delete Message</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <p class="text-center">Are you sure you want to delete this message?</p>
                                </div>

                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center sling-nav">
                                            <form class="button-form" method="POST" action="/message/{{ $message->id }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-xs btn-default">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" data-toggle="modal" data-target="#historyModal{{ $message->id }}">Close</button>
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
</div>

@endsection
