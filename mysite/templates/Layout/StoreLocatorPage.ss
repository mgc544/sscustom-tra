<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>

				
			$Content
			$Form 
			
			
					<div id="map" style="height:300px;"></div> 
					
					<div id="LocationList">
						<% control getLocations %>
						<div class="location">
							<p><a href="javascript:myclick({$Pos(0)})"><strong>$Name</strong> - Get Directions</a><br>$Address<br>$City, $State&nbsp;$Zip</p>
							
							<% if HoursMF %>
							<p><strong>Store Hours:<br/></strong>
							<% if HoursMF %>Mon. - Fri. $HoursMF<br/><% end_if %>
							<% if HoursSat %>Sat: $HoursSat<br/><% end_if %>
							<% if HoursSun %>Sun: $HoursSun</p><% end_if %>
							<% end_if %>
							
							<% if Phone %><p><strong>Phone:</strong>$Phone</p><% end_if %>
							<% if Fax %><p><strong>Fax:</strong> $Fax</p><% end_if %>
							<% if Toll %><p><strong>Toll Free:</strong> $Toll</p><% end_if %>
							
							<% if Departments %>
							<p><a href="$Top.URLSegment/directory/{$ID}">Staff Directory</a></p>
							<% end_if %>
							
						</div>				
						<% end_control %>
					</div>

</div>


<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>

