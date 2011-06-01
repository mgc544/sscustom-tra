<% if Children %>
  <ul>
    <% control Children %>
    <li>
      <a <% if Children %>href="javascript:void(0)"<% else %> href="$Link"<% end_if %> class="$LinkingMode">$MenuTitle</a>
        $Template(_MenuSmooth)
    </li>
    <% end_control %>
  </ul>
<% end_if %>

