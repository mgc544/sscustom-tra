<!DOCTYPE html>

<html lang="en">

<head>
<% base_tag %>	
		<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
		
		$MetaTags(false)
		
<% require css(mysite/css/login.css) %>
<style type="text/css">
		.typography p{
		color:#000;
		}
		.typography h1{
		color:#000;
		}
</style>
</head>
<body class="login basecamp"> 
  
 
 
<div class="container"> 
   
  <div id="login_content" data-state="username" > 
    <div id="login_content_inner"> 
      <div class="dialog_contents typography"> 
       
       <% if SiteConfig.SiteLogo %>
       $SiteConfig.SiteLogo
       <% end_if %>
        <div id="login_dialog" class="login_dialog clearfix"> 
 			<h1>Sign in</h1>
          
 			<p>$Content</p>
          	$Form 
 
          
        </div> 
        <p></p>
        <img src="pwdby.jpg" alt="logo">
      </div> 
       
    </div> 
  </div> 
  
  
 
</div> 
 

</body> 
</html> 
