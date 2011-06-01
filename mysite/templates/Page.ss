<!DOCTYPE html>
<html lang="en">
<head>
<% base_tag %>
<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
$MetaTags(false)
</head>
<body >

<div class="<% if PageLayout=0 %>full-width<% end_if %><% if PageLayout=1 %>two-column-left<% end_if %><% if PageLayout=2 %>two-column-right<% end_if %><% if PageLayout=3 %>three-column<% end_if %>">
	<% include Header %>
	<!-- start content -->
	
		$Layout
	
	<!-- end content -->
	<% include Footer %>
</div>
</body>
</html>
