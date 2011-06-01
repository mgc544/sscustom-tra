<!DOCTYPE html>
<html lang="en">
<head>
<% base_tag %>
<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
$MetaTags(false)
</head>

<body>

<div class="<% if PageLayout=0 %>full-width<% end_if %><% if PageLayout=1 %>two-column-left<% end_if %><% if PageLayout=2 %>two-column-right<% end_if %><% if PageLayout=3 %>three-column<% end_if %>">
	<% include Header %>
	<!-- start content -->
	
<div id="main-content" class="typography">
	
	<h2><span>$Title: </span>$SEO</h2>
			
				<% control StoreLocation %>
					<% if Departments %>
						<% control Departments %> 
							<% if Staffs %><h3><strong>$DepartmentName</strong></h3><% end_if %>
							<% if Staffs %>
								<% control Staffs %>
								<p><% if Name %><strong>$Name</strong><% end_if %> 
								<% if Position %>- $Position<br/><% end_if %>
								<% if Phone %>Phone: $Phone<br/><% end_if %>
								<% if Email %>Email: $Email<% end_if %></p>  
								<% end_control %>
							<% end_if %>
						<% end_control %>
					<% end_if %>
				<% end_control %>

</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>

		
	<!-- end content -->
	<% include Footer %>
</div>
</body>
</html>