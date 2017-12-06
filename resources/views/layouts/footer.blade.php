@if (\Request::is('/'))	
	<div class="sling-foot-welcome">
		<div id="copyright" style="display: inline-block; color: white; margin-top: 30px;">
			© Copyright 2017 Link-Sling
		</div>
		<div class="text-center">
			<a href="https://www.twilio.com/"><img style="display: inline-block; height: 10%; width: 10%; margin-top: 15px; margin-bottom: 20px;" src="{{ asset('twilio-blue.png') }}"></a>
		</div>
	</div>
@else
	<div class="sling-foot-welcome">
		<div id="copyright" style="display: inline-block; color: white; margin-top: 30px;">
			© Copyright 2017 Link-Sling
		</div>
		<div class="text-center">
			<a href="https://www.twilio.com/"><img style="display: inline-block; height: 10%; width: 10%; margin-top: 15px; margin-bottom: 20px;" src="{{ asset('twilio-blue.png') }}"></a>
		</div>
	</div>
@endif