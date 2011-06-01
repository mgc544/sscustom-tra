
<div class="hr grid_12 clearfix"></div>
		<h2 class="grid_12 caption"><span>$Title:</span>$SEO</h2>

		<div class="grid_12"><% include BreadCrumbs %></div>

<div class="hr grid_12 clearfix"></div>

<% include SidebarLeft %>
		
<div id="productholder" class="grid_9 floatright typography">		
		<% control Product %>

		<!-- Column 1 / Project Information -->
		<div class="grid_4 alpha">
		
		
		<a class="meta" href="#">$Manufacture</a>
		
		
		
		<h4 class="title">$Name</h4>
		
			$ProductDescription
			
				<% if Brochures %>
				<h4>Literature:</h4>
				<ul class="productlists">
				<% control Brochures %>
				<li><a href="$Attachment.Url">$AttachmentDescription</a></li>
				<% end_control %>
				</ul>
				<% end_if %>	
			<p class="clearfix">
				<a target="_blank" href="$VisitSite" class="button float right">Visit Site</a>
			</p>
			
				
		</div>
		
		<!-- Column 2 / Image Carosuel -->
		<div id="productdetail" class="grid_5 cleafix alpha omega right">
			
				<div id="showImage$ID" class="ProductImage">
					<% control MainImage %>
					<% control CroppedImage(360, 170) %>
					<img class="" src="$URL"  alt="$Name"/>
					<% end_control %>
					<% end_control %>
				</div>
				<div class="hr grid_4 clearfix">&nbsp;</div>	
			<table id="hor-zebra">
				<thead><tr><th scope="col">Models:</th><th scope="col">Details:</th></thead>
				<tbody>
					<% control ProductModels %>
					<tr class="$EvenOdd">
						<td style="width:70%">
						<% if Photo %>
						<a href="{$Top.Link}showImage/{$ID}" class="tip" title="Click to view image" onclick="$('#showImage$Product.ID').load('{$Top.Link}/showImage/{$ID}'); return false;">&nbsp; $ModelNumber</a>
						<% else %>
						$ModelNumber
						<% end_if %>
						</td>
					
						<td style="width:30%">
						<a href="$Top.URLSegment/ajaxFeature/{$ID}?height=475&width=669&modal=true" class="thickbox">Features</a> |<% if Specs %> <a href="$Top.URLSegment/ajaxSpecs/{$ID}?height=475&width=669&modal=true" class="thickbox">Specs</a>	<% end_if %>					
						</td>
					</tr>
					<% end_control %>
				</tbody>
			</table>			
		</div>
		<div class="hr grid_9 clearfix">&nbsp;</div>
		<% end_control %>		
</div>		
		
		
		
