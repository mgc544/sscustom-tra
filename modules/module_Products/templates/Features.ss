<!DOCTYPE html>

<html lang="$ContentLocale">
  <head>
		<% base_tag %>
		<title>Features $ProductModel.ModelNumber available from $SiteConfig.Title</title>
		

		<link rel="shortcut icon" href="/favicon.ico" />
		
		<meta name="keywords" content="<% control Products.first %>$Manufacture<% end_control %>, <% control ProductCategory %><% control Products %>$Name, <% end_control %><% end_control %>$ProductCategory.Category, Texas, Brownsville, Mission" /> 
		
		<meta name="description" content="Find <% control Products.first %>$Manufacture<% end_control %> <% control ProductCategory %><% control Products %>$Name, <% end_control %><% end_control %>$ProductCategory.Category for sale at $SiteConfig.Title" /> 

<style type="text/css">
.typography ul{
	margin:0px!important;
	padding:10px!important;
}

.typography ul li{
	line-height:18px;
	color:#333;
}

.typography p{
	color:#333!important;
}

table{
	width:99%;
}

.typography td {
border: 1px solid gray!important;
padding: 5px;
}


</style>
</head>

<body style="background-color: #fff">


<div style="background:#fff !important; width:790px; padding:10px;" class="typography">


<% control ProductModel %>
<h1 <% control Top.Level(1) %>class="$URLSegment"<% end_control %> style="color:#000; font-size:22px;">Features $ModelNumber available from $Top.SiteConfig.Title</h1>


<div style="margin:0;padding:0;border:solid 1px #000;width:778px; height:150px;">
<div style="float:left; width:228px; height:150px;">
<% if Photo %>
<% control Photo %>
	<% control CroppedImage(225, 150) %>
	<img style="margin-right:2px; float:left; background:#fff; border-right:1px #333 solid;" src="$URL" title="$ModelNumber" >
	<% end_control %>
<% end_control %>
<% end_if %>
</div>

<div style="background: green url({$BaseHref}themes/LayoutX/images/bg-secs.jpg) repeat-x;overflow:hidden; width:538px; height:136px; margin-left:4px; position:relative; margin-top:6px; float:left;">


<div style="width:242px;height:150px;margin-top:5px;margin-left:auto;margin-right:auto;">
<% control Top.SiteConfig %>
<% control SiteLogo %>
<a id="logo2" href="#"><img src="$URL"></a>
<% end_control %>
<% end_control %>
</div>
</div>



</div>


<div style="clear:both;">&nbsp;</div>
$Features
<% end_control %>
</div>

	<script type="text/javascript">
		$(document).ready(function() {
		
		$('table').attr({width:'99%'});
		$('table a').attr({target:'_blank'});
				
			
		});
		
		
		</script>
</body>
