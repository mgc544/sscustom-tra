<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>
$Content
$Form
			<% if BuildYourOwnItems %>
				<% control BuildYourOwnItems  %>
						<div id="$ClassName">
							<% control Photo %><img alt="$Name" title="$Name" src="$URL"/><% end_control %>
							<div>
								<h6>$Name</h6>
								<p><a class="button" href="$ExternalLink" title="Visit $Name" target="_blank">Visit Website</a></p>
							</div>
						</div>
				<% end_control %>
			<% end_if %>
			


</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
