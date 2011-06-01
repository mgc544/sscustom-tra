<% if Orientation == V %>
	<ul id="scrollinglistings-V">
	<% control FeedItems %>
		<li>
			 <a target="_blank" href="$Link&close=Y">
			 $Photo $Title
			 </a>
		</li>
	<% end_control %>
	</ul>
<% end_if %>

<% if Orientation == H %>
	<ul id="scrollinglistings-H">
	<% control FeedItems %>
		<li>
			<a target="_blank" href="$Link&close=Y">$Photo</a>
		</li>
	<% end_control %>
	</ul>
<% end_if %>