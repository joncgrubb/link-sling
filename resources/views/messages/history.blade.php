@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading sling-main-panel">Link-Sling</div>
                <div class="panel-heading text-center"><h4>History</h4></div>

                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>Recipient</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th>Received</th>

                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($messages as $message)
                      <tr>
                        <td>Contact Name Placeholder</td>
                        <td>{{ $message->mobile }}</td>
                        <td>{{ $message->dateFormat() }}</td>
                        <td><i class="fa fa-spinner" aria-hidden="true"></i>
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
