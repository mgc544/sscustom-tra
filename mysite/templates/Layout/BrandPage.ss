<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>
$Content
$Form
			<% if Brands %>
				<% control Brands  %>
						<div class="$ClassName">
							<% control BrandPhoto %><img title="$BrandName" alt="$BrandName" src="$URL"/><% end_control %>						
							<div>
								<h6>$BrandName</h6>
								<p>$BrandDescription</p>
								<p><a class="button" href="$VisitSite" title="Visit $BrandName" target="_blank">Visit Website</a></p>
							</div>
						</div>					
				<% end_control %>
			<% end_if %>
</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
