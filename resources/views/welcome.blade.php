@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center"><i class="fa fa-commenting fa-5x link-title" aria-hidden="true"></i></i><h1 class="sling-title">Link-Sling</h1></div>
            <div class="panel panel-default sling-blurb-title-panel"><h2 class="sling-blurb-title text-center">The easiest way to send web links and short messages to your friends and family on the web!</h2></div>
            <blockquote><h3 class="sling-blurb">Welcome to Link-Sling! We utilize the Twilio SMS service to make it easy for you and your friends to share web links and short messages from PC, Mac or Linux to any mobile phone. We don't require you to install any third party apps on your computer or recipient mobile device, making it as simple as creating an account and adding your contacts to start sharing!</h3></blockquote>
        </div>
    </div>
    <h3 class="text-center how-does">How does it work?</h3>
    <div class="row how-to equal">
    	<div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-desktop fa-4x how-to-icon" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Search the web and find an awesome link!</p>
      	</div>
      </div>
      <div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-link fa-4x how-to-icon" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Copy/Paste the link and <b style="color: #4CA6FF; text-shadow: 1px 1px 1px #ccc;">Sling!</b> to your saved contacts!</p>
      	</div>
      </div>
      <div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-mobile fa-4x how-to-icon" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Your contacts receive the link via SMS!</p>
      	</div>
      </div>
    </div>
</div>
@endsection

