<div class="hr grid_12 clearfix"></div>
		<h2 class="grid_12 caption"><span>$Title:</span>$SEO</h2>
		
		<div class="grid_12"><% include BreadCrumbs %></div>

		
<div class="hr grid_12 clearfix"></div>
		
		
					
			
			
			$Content		
			$Form	

		
		<% if ProductCategories %>
		<% control ProductCategories %>

		<div class="catagory_1 clearfix">
			<div class="grid_3 textright">
			<span class="meta">View All</span>
			<h4 class="title "><a href="$Link">$Category</a></h4>
			<div class="hr clearfix dotted">&nbsp;</div>
			</div>
				<div class="grid_9">
					<% if Products %>
					<% control Products %>
					<div class="grid_3 alpha">

					<a href="$Link">
					<% control MainImage %>
					<% control CroppedImage(223,100) %>
					<img class="" src="$URL"  alt="$Name"/>
					<% end_control %>
					<% end_control %>
					</a>
					<p><a href="$Link">$Name</a></p>
					</div>
					<% end_control %>
					<% end_if %>
				</div>
		</div>
		<% end_control %>
		<% end_if %>
		
		
		
