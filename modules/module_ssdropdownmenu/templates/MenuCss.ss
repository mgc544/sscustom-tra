 <ul class="cssMenu cssMenum">

    <% control Menu(1) %>
	<li class="cssMenui">

            <a class="cssMenui $LinkingMode" href="$Link">
                <% if Children %>
                    <span>$MenuTitle</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
                    <% include _MenuCss %>
                <% else %>
                    $MenuTitle
                <% end_if %>
            </a>

        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
        </li>

    <% end_control %>
    
    <% if AddAdminMenu %>
        <% include _MenuAdmin %>
     <% end_if %>
     
</ul>