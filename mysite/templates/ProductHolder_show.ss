<!DOCTYPE html>
<html lang="en">
<head>
<% base_tag %>
		<title>
		<% if ProductCategory %>
		<% control ProductCategory %>
		Find $Top.Product.Manufacture<% control Products %> $Name, <% end_control %> $Category at &raquo; $SiteConfig.Title
		<% end_control %>	
		<% end_if %>
		</title>
		
		<meta name="keywords" content="$Top.Product.Manufacture, <% control ProductCategory %>$Category, <% control Products %>$Name, <% end_control %><% end_control %> $SiteConfig.Title"/> 
		<meta name="description" content="<% control ProductCategory %>Find $Top.Product.Manufacture <% control Products %>$Name,<% if Last %> and $Name<% end_if %> <% end_control %>$Category<% end_control %> at $SiteConfig.Title" /> 
</head>
<body>

<div class="<% if PageLayout=0 %>full-width<% end_if %><% if PageLayout=1 %>two-column-left<% end_if %><% if PageLayout=2 %>two-column-right<% end_if %><% if PageLayout=3 %>three-column<% end_if %>">

<% include Header %>
<!-- start content -->
	
<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
	<% if Level(2) %>
	  	<% include BreadCrumbs %>
	<% end_if %>
	
	<% if SEO %>
	<h3>$ProductCategory.SEO</h3>
	<% else %>
	<h3>Find <% control Products.first %>$Manufacture<% end_control %> $ProductCategory.Category for sale at  $SiteConfig.Title, your source for new and used equipment in Washington.</h3>
	<% end_if %>

	$Content
<% if PageLayout=0 %>
<% if ProductCategory %>
		
		<% control ProductCategory %>
		<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
			<% control Products %>
			<!-- Column 1 / Project Information -->
			<div class="productdescription">	
				<h3>$Name</h3>
				$ProductDescription
			</div><!-- end productdescription -->
		
			<div class="productdetail">
			<div class="links">
				<div id="showImage$ID" class="item">
					<% if MainImage %>
					<% control MainImage %>
						<% control CroppedImage(225, 150) %>
							<img class="" src="$URL"  alt="$Name"/>
						<% end_control %>
					<% end_control %>
					<% else %>
					<img src="http://placehold.it/225x150">
					<% end_if %>
				</div>					
				<p><a class="button" href="$VisitSite" class="button" target="_blank">Learn More</a></p>
				<% if Brochures %>
						<% control Brochures %>
						<a target="_blank" href="$Attachment.Url">$AttachmentDescription</a>
						<% end_control %>
					<% end_if %>
			</div>	
			
			
			<% if ProductModels %>
				<table class="producttable">
					<thead><tr><th scope="col">Models:</th><th scope="col">Details:</th></thead>
					<tbody>
						<% control ProductModels %>
						<tr class="$EvenOdd">
							<td style="width:50%">
							<% if Photo %>
							<a href="{$Top.Link}showImage/{$ID}" title="Click to view image" onclick="return !loadAjax('showImage$Product.ID', '$BaseHref{$Top.Link}showImage/{$ID}')">$ModelNumber</a>&nbsp; <span class="photo"></span> 
							<% else %>
							$ModelNumber
							<% end_if %>
							</td>
							<td style="width:30%">
							<% if Features %><a href="$Top.URLSegment/features/{$URLSegment}" class="pop">Features</a><% end_if %><% if Specs %> | <a href="$Top.URLSegment/specifications/{$URLSegment}" class="pop">Specs</a>	<% end_if %>					
							</td>
						</tr>
						<% end_control %>
					</tbody>
				</table>
				<% end_if %>
			<div class="clear"></div></div><!-- end productdetail -->
			<% end_control %>
		</div>	<!-- end category-->
		<% end_control %>	
<% end_if %>
<% end_if %>
	
<% if PageLayout=1 %>	
<% if ProductCategory %>
	
		<% control ProductCategory %>
		<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
			<% control Products %>
			<!-- Column 1 / Project Information -->
			<div class="productdescription">	
				<h3>$Name</h3>
				$ProductDescription
			</div><!-- end productdescription -->
		
			<div class="productdetail">
			<div class="links">
				<div id="showImage$ID" class="item">
					<% if MainImage %>
					<% control MainImage %>
						<% control CroppedImage(225, 150) %>
							<img class="" src="$URL"  alt="$Name"/>
						<% end_control %>
					<% end_control %>
					<% else %>
					<img src="http://placehold.it/225x150">
					<% end_if %>
				</div>					
				<p><a class="button" href="$VisitSite" class="button" target="_blank">Learn More</a></p>
				<% if Brochures %>
						<% control Brochures %>
						<a target="_blank" href="$Attachment.Url">$AttachmentDescription</a>
						<% end_control %>
					<% end_if %>
			</div>	
			
			
			<% if ProductModels %>
				<table class="producttable">
					<thead><tr><th scope="col">Models:</th><th scope="col">Details:</th></thead>
					<tbody>
						<% control ProductModels %>
						<tr class="$EvenOdd">
							<td style="width:50%">
							<% if Photo %>
							<a href="{$Top.Link}showImage/{$ID}" title="Click to view image" onclick="return !loadAjax('showImage$Product.ID', '$BaseHref{$Top.Link}showImage/{$ID}')">$ModelNumber</a>&nbsp; <span class="photo"></span> 
							<% else %>
							$ModelNumber
							<% end_if %>
							</td>
							<td style="width:30%">
							<% if Features %><a href="$Top.URLSegment/features/{$URLSegment}" class="pop">Features</a><% end_if %><% if Specs %> | <a href="$Top.URLSegment/specifications/{$URLSegment}" class="pop">Specs</a>	<% end_if %>					
							</td>
						</tr>
						<% end_control %>
					</tbody>
				</table>
				<% end_if %>
			<div class="clear"></div></div><!-- end productdetail -->
			<% end_control %>
		</div>	<!-- end category-->
		<% end_control %>	
<% end_if %>
<% end_if %>


<% if PageLayout=2 %>	
<% if ProductCategory %>
	
		<% control ProductCategory %>
		<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
			<% control Products %>
			<!-- Column 1 / Project Information -->
			<div class="productdescription">	
				<h3>$Name</h3>
				$ProductDescription
			</div><!-- end productdescription -->
		
			<div class="productdetail">
			<div class="links">
				<div id="showImage$ID" class="item">
					<% if MainImage %>
					<% control MainImage %>
						<% control CroppedImage(225, 150) %>
							<img class="" src="$URL"  alt="$Name"/>
						<% end_control %>
					<% end_control %>
					<% else %>
					<img src="http://placehold.it/225x150">
					<% end_if %>
				</div>					
				<p><a class="button" href="$VisitSite" class="button" target="_blank">Learn More</a></p>
				<% if Brochures %>
						<% control Brochures %>
						<a target="_blank" href="$Attachment.Url">$AttachmentDescription</a>
						<% end_control %>
					<% end_if %>
			</div>	
			
			
			<% if ProductModels %>
				<table class="producttable">
					<thead><tr><th scope="col">Models:</th><th scope="col">Details:</th></thead>
					<tbody>
						<% control ProductModels %>
						<tr class="$EvenOdd">
							<td style="width:50%">
							<% if Photo %>
							<a href="{$Top.Link}showImage/{$ID}" title="Click to view image" onclick="return !loadAjax('showImage$Product.ID', '$BaseHref{$Top.Link}showImage/{$ID}')">$ModelNumber</a>&nbsp; <span class="photo"></span> 
							<% else %>
							$ModelNumber
							<% end_if %>
							</td>
							<td style="width:30%">
							<% if Features %><a href="$Top.URLSegment/features/{$URLSegment}" class="pop">Features</a><% end_if %><% if Specs %> | <a href="$Top.URLSegment/specifications/{$URLSegment}" class="pop">Specs</a>	<% end_if %>					
							</td>
						</tr>
						<% end_control %>
					</tbody>
				</table>
				<% end_if %>
			<div class="clear"></div></div><!-- end productdetail -->
			<% end_control %>
		</div>	<!-- end category-->
		<% end_control %>	
<% end_if %>
<% end_if %>




<% if PageLayout=3 %>	
<% if ProductCategory %>
	
		<% control ProductCategory %>
		<div class="category <% control Top.Level(1) %>$URLSegment<% end_control %>">
			<% control Products %>
			<!-- Column 1 / Project Information -->
			<div class="productdescription">	
				<h3>$Name</h3>
				<div class="links">
				<div id="showImage$ID" class="item">
					<% if MainImage %>
					<% control MainImage %>
						<% control CroppedImage(225, 150) %>
							<img class="" src="$URL"  alt="$Name"/>
						<% end_control %>
					<% end_control %>
					<% else %>
					<img src="http://placehold.it/225x150">
					<% end_if %>
				</div>					
				<p><a class="button" href="$VisitSite" class="button" target="_blank">Learn More</a></p>
				<% if Brochures %>
						<% control Brochures %>
						<a target="_blank" href="$Attachment.Url">$AttachmentDescription</a>
						<% end_control %>
					<% end_if %>
			</div>
				$ProductDescription
			</div><!-- end productdescription -->
		
			<div class="productdetail">	
			<% if ProductModels %>
				<table class="producttable">
					<thead><tr><th scope="col">Models:</th><th scope="col">Details:</th></thead>
					<tbody>
						<% control ProductModels %>
						<tr class="$EvenOdd">
							<td style="width:50%">
							<% if Photo %>
							<a href="{$Top.Link}showImage/{$ID}" title="Click to view image" onclick="return !loadAjax('showImage$Product.ID', '$BaseHref{$Top.Link}showImage/{$ID}')">$ModelNumber</a>&nbsp; <span class="photo"></span> 
							<% else %>
							$ModelNumber
							<% end_if %>
							</td>
							<td style="width:30%">
							<% if Features %><a href="$Top.URLSegment/features/{$URLSegment}" class="pop">Features</a><% end_if %><% if Specs %> | <a href="$Top.URLSegment/specifications/{$URLSegment}" class="pop">Specs</a>	<% end_if %>					
							</td>
						</tr>
						<% end_control %>
					</tbody>
				</table>
				<% end_if %>
			<div class="clear"></div></div><!-- end productdetail -->
			<% end_control %>
		</div>	<!-- end category-->
		<% end_control %>	
<% end_if %>
<% end_if %>

</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>
	<!-- end content -->
	<% include Footer %>
</div>
</body>
</html>





