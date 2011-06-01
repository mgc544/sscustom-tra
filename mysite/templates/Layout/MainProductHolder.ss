<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>
	
	$Content
	$Form

		<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
			<% control Children %>
				<a class="product-thumb" href="$Link" title="$Title">
				<% if Photo %>
				$Photo.CroppedImage(218,125)
				<% else %>
				<img src="http://placehold.it/218x125">
				<% end_if %>
				<span class="title <% control Level(1) %>$URLSegment<% end_control %>">$Title</span></a>
			<% end_control %>
		</div>

</div>


<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
