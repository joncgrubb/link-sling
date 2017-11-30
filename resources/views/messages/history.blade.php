@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading sling-main-panel">Link-Sling</div>
                <div class="panel-heading text-center"><h4>History</h4></div>

                <div class="panel-body table-responsive">

                  <table class="table history-table">
                    <thead>
                      <tr>
                        <th>Recipient</th>
                        <th>Link</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th>Received</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($messages as $message)
                      <tr>
                        <td>Contact Name</td>
                        <td>
                            <a href="#historyModal{{ $message->id }}" data-toggle="modal">
                                {{ str_limit($message->link, $limit = 25, $end = '...') }}
                            </a>
                            <div id="historyModal{{ $message->id }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Contact Name</h4>
                                            <h4 class="modal-title modal-mobile">{{ $message->mobile }}</h4>
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
                        <td>{{ $message->mobile }}</td>
                        <td>{{ $message->dateFormat() }}</td>
                        <td class="text-center"><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i>
                        </td>
                      </tr>
                    @endforeach

                  </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
