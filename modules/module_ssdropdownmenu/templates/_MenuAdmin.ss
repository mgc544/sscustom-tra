<% if AddAdminMenu %>
    <% if CurrentMember %>
        <li><a href="/admin">Admin</a></li>
    <% end_if %>
    <li>
        <% if CurrentMember %>
            <a href="/Security/logout">Log out</a>
        <% else %>
            <a href="/Security/login">Log in</a>
        <% end_if %>
    </li>
<% end_if %>