<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
	<h2><span>$Title: </span>$SEO</h2>
	$Content
	$Form


<% if ProductCategories %>
		<% control ProductCategories %>
			<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
					<% if Products %>
					<h3><a href="$Link">$Category <span class="viewall">View</span></a></h3>
					<% control Products %>
						<a class="product-thumb" href="$ProductCategory.Link" title="$Title">
							<% if MainImage %>
							<% control MainImage %>
									<% control CroppedImage(218,125) %>
									<img class="" src="$URL"  alt="$Name"/>
									<% end_control %>
							<% end_control %>
							<% else %>
							<img src="http://placehold.it/218x125">
							<% end_if %><span class="title <% control Top.Level(1) %>$URLSegment<% end_control %>">$Name</span>
						</a>
					<% end_control %>
					<div class="clear"></div>
					<% end_if %>
			</div>
		<% end_control %>
<% end_if %>

</div>



<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
