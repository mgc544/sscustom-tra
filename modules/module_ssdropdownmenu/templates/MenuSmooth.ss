<div id="smoothmenu" class="ddsmoothmenu">
  <ul>
    <% control Menu(1) %>
    <li>
      <a <% if Children %>href="javascript:void(0)"<% else %> href="$Link"<% end_if %> class="$LinkingMode">$MenuTitle</a>
        <% include _MenuSmooth %>
    </li>
    <% end_control %>

    <% if AddAdminMenu %>
        <% include _MenuAdmin %>
     <% end_if %>
     
  </ul>
</div>