@extends('layouts.app-panel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default sling-panel">
                <div class="panel-heading sling-main-panel">Link-Sling</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="/message" role="form">

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                        <label for="link" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="link" id ="link" placeholder="Web link or text to send..." required="true" oninvalid="this.setCustomValidity('Link field must not be blank')"
                            oninput="setCustomValidity('')">
                          @if ($errors->has('link'))
                            <span class="help-block">
                              <strong>{{ $errors->first('link') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group{{ $errors->has('recipient') ? ' has-error' : '' }}">
                        <label for="recipient" class="col-sm-2 control-label">Recipient</label>
                        <div class="col-sm-10">
                          <autocomplete></autocomplete>
                          @if ($errors->has('recipient'))
                            <span class="help-block">
                              <strong>{{ $errors->first('recipient') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <hr />

                      <div class="form-group">
                        <div class="col-sm-12 text-center sling-nav">
                          <button type="submit" class="btn btn-xs btn-default">Send</button>
                        </div>
                      </div>

                    </form>
                </div>
            </div>
            <div class="home-spacer"></div>
        </div>
    </div>
</div>
@endsection
