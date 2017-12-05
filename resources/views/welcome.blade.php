@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center"><i class="fa fa-commenting fa-5x link-title" aria-hidden="true"></i></i><h1 class="sling-title" style="font-family: 'Open Sans', sans-serif;">Link-Sling</h1></div>
            <div class="panel panel-default sling-blurb-title-panel"><h2 class="sling-blurb-title text-center">The easiest way to send web links and short messages to your friends and family on the web!</h2></div>
            <h3 class="sling-blurb">Welcome to Link-Sling! This site utilizes the Twilio SMS service to make it easy for you, your friends, and colleagues to share web links and short messages to each other from PC, Mac or Linux to any phone. We don't require you to install any third party apps on your machine or recipient mobile device, making it as simple as creating an account to start sharing!</h3>
        </div>
    </div>
    <div class="row how-to">
    	<h3 class="text-center">How does it work?</h3>
    	<div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-desktop fa-4x" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Search the web and find an awesome link!</p>
      	</div>
      </div>
      <div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-link fa-4x" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Copy/Paste and sling the link to your saved contacts!</p>
      	</div>
      </div>
      <div class="col-xs-4">
      	<div class="panel panel-default text-center how-to-panel">
      		<i class="fa fa-mobile fa-4x" aria-hidden="true"></i>
      		<p class="how-to-panel-text">Your contacts receive the link via SMS!</p>
      	</div>
      </div>
    </div>
</div>
@endsection

