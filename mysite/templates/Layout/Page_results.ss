<div class="hr grid_12 clearfix"></div>

<h2 class="caption"><span>$Title:</span>$SEO</h2>

<div class="hr grid_12 clearfix"></div>


<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>

<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>




<% if PageLayout=1 %><div id="maincontent" style="width: 710px; margin-top: 0px; margin-left:0px; margin-right:10px;" class="grid_9 typography"><% end_if %>

<% if PageLayout=2 %><div id="maincontent" style="width: 710px; margin-top: 0px; margin-left:10px; margin-right:0px;" class="grid_9 typography"><% end_if %>

<% if PageLayout=3 %><div id="maincontent"style="width: 480px;"  class="grid_6 typography"><% end_if %>

<% if PageLayout=0 %><div id="maincontent" class="grid_12 typography" style="margin-top: 0px; margin-left:10px; margin-right:10px;"><% end_if %>
<div class="pad">
$Content
$Form

<div id="Content" class="searchResults">
  <h2>$Title</h2>
 
  <% if Query %>
    <p class="searchQuery"><strong>You searched for &quot;{$Query}&quot;</strong></p>
  <% end_if %>
 
  <% if Results %>
      <% control Results %>
        <div class="grid_3" style="width:100%;">
          <a class="searchResultHeader" href="$Link">
            <% if MenuTitle %>
              $MenuTitle
            <% else %>
              $Title
            <% end_if %>
          </a>
          <p>$Content.LimitWordCountXML</p>
          <a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
        </div>
        <div class="hr clear"></div>
      <% end_control %>
  
  <% else %>
    <p>Sorry, your search query did not return any results.</p>
  <% end_if %>
 
  <% if Results.MoreThanOnePage %>
    <div id="PageNumbers">
      <% if Results.NotLastPage %>
        <a class="next" href="$Results.NextLink" title="View the next page">Next</a>
      <% end_if %>
      <% if Results.NotFirstPage %>
        <a class="prev" href="$Results.PrevLink" title="View the previous page">Prev</a>
      <% end_if %>
      <span>
        <% control Results.Pages %>
          <% if CurrentBool %>
            $PageNum
          <% else %>
            <a href="$Link" title="View page number $PageNum">$PageNum</a>
          <% end_if %>
        <% end_control %>
      </span>
      <p>Page $Results.CurrentPage of $Results.TotalPages</p>
    </div>
  <% end_if %>
</div>


</div>
</div>


<% if PageLayout=2 %>
<% include RightSidebar %>
<% end_if %>


<% if PageLayout=3 %>
<% include RightSidebar %>
<% end_if %>
