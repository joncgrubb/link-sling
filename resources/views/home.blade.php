@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading sling-main-panel">Link-Sling</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="post" action="/messages">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                      <label for="recipients" class="col-sm-2 control-label">Link</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="link" id="subject" placeholder="Paste web link here...">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="subject" class="col-sm-2 control-label">Recipient</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="recipient" id="subject" placeholder="Mobile number or Contact Name">
                      </div>
                    </div>

                    <hr />

                    <div class="form-group">
                      <div class="col-sm-12 text-center sling-nav">
                        <button type="submit" name="button" value="send" class="btn btn-xs btn-default">Send</button>
                      </div>
                    </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
