<% if PageLayout=1 %><% include LeftSidebar %><% end_if %>
<% if PageLayout=3 %><% include LeftSidebar %><% end_if %>

<div id="main-content" class="typography">
	
<h2><span>$Title: </span>$SEO</h2>
$Content
$Form

<div class="hr clear"></div>
<h3>NewsLetter Archive</h3>

<% control getNewsletters %>
				<% if SentNewsletters %>
						<% if MostRecentSentNewsletters %>
						<p>Most Recent $RecentSeperator</p>
						<div class="list">

								<% control MostRecentSentNewsletters %>
								<div class="content_block" style="width:45%;">
		                        <p><a href="$PreviewLink">$Title</a>
		                       	<br><strong>Sent on:</strong> $SentDate.Nice</p>
		                        </div>
		                        <% end_control %>
		                 </div>
						<% end_if %>
			<% end_if %>
			<% if SentNewsletters %>
						<% if OlderSentNewsletters %>
						<p>Older</p>
						<div class="list">

								<% control OlderSentNewsletters %>
		                        <li><a href="$PreviewLink">$Title</a></li>
		                        <% end_control %>
		                 </div>
						<% end_if %>
			<% end_if %>
<% end_control %>

</div>

<% if PageLayout=2 %><% include RightSidebar %><% end_if %>
<% if PageLayout=3 %><% include RightSidebar %><% end_if %>




