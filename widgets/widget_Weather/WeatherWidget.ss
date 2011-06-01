<% control YahooWeather %> 
<div id="yw-forecast">
		<div class="forecast-temp right">
		<div class="forecast-icon" style="background: transparent url('$ImageURL') no-repeat top left; height: 180px; "></div>
		<div id="yw-temp">$Temp&deg;</div>
		<p>H: $High&deg; L: $Low&deg;</p>
		</div>
		<div class="forecast-details left">
		<p class="city">$City, $Region</p><p>Conditions: $ConditionText<br/>$LastBuildDate</p>
		</div>
</div>
<% end_control %> 