<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
	<h2><span>$Title: </span>$SEO</h2>

	$Content
	<div class="youtubegallery typography">
			<div id="ytvideomain"></div>
			<% if YoutubeVideos.Count %>
			<ul class="youtubepage">
				<% control YoutubeVideos %>
						 <li><a href="$PlayerVideoURL"></a></li>
				<% end_control %>
			</ul>	
			
			<div class="pages">
					<div class="paginator"></div>
					<span class="results">($YoutubeVideos.Count Videos)</span>
			</div>
			<% else %>
				<span>Sorry! Gallery doesn't contain any images for this page.</span>
			<% end_if %>
			
	</div>
</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>