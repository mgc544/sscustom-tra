<p>Sign up to get the latest news and promotions from MV Equipment. </p>


$ShowForm.Form

<br/>
<% control getNewsletters %>
				<% if SentNewsletters %>
						<% if MostRecentSentNewsletters %>
						<p>Most Recent</p>
						<div class="list">

								<% control MostRecentSentNewsletters %>
								<div class="content_block">
		                        <p><a href="$PreviewLink">$Title</a>
		                       	<br><strong>Sent on:</strong> $SentDate.Nice</p>
		                        </div>
		                        <% end_control %>
		                 </div>
						<% end_if %>
			<% end_if %>
<% end_control %>
