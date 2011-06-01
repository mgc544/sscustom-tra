<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>
$Content
$Form
			<iframe style="background-color:#$BgColor; text-decoration:underline;" src="http://www.equipmentlocator.com/remarket/dealer/salespecials/hotlist.aspx?master=$SiteConfig.MasterControl&$Language&bg=%23$BgColor&tc=%23$TextColor&lc=%23$LinkColor&mode=$Mode<% if Stores %>&control=$Stores<% end_if %>"
			name="ssRemoteWindow" id="ssRemoteWindow" 
			width="$width"
			height="$height" frameborder="0"
			scrolling="auto">
			</iframe>

</div>


<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
