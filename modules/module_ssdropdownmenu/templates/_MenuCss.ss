<ul class=" cssMenum">
    <% control Children %>
        <li class="cssMenui">
            <a class="cssMenui $LinkingMode" href="$Link">
                <% if Children %>
                    <span>$MenuTitle</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
                    $Template(_MenuCss)
                <% else %>
                    $MenuTitle
                <% end_if %>
            </a>

        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
        </li>
    <% end_control %>
</ul>

