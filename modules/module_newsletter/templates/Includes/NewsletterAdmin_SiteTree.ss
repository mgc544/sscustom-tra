<% if NewsletterTypes %>
	<ul id="sitetree" class="tree unformatted">
	<% control NewsletterTypes %>
		<li id="mailtype_$ID" class="MailType">
			<a href="#">$Title</a>
			<ul>
				<li id="drafts_$ID" class="DraftFolder nodelete closed"><a href="$baseURL/admin/showtype/$ID"><% _t('DRAFTS','Drafts') %></a>
				<% if DraftNewsletters %>
					<ul>
						<% control DraftNewsletters %>
						<li class="Draft" id="draft_{$ParentID}_{$ID}"><a href="$baseURL/admin/newsletter/shownewsletter/$ID">$Title</a></li>
						<% end_control %>
					</ul>
				<% end_if %>
				</li>
				<% if SentNewsletters %>
				<li id="sent_$ID" class="SentFolder nodelete closed"><a href="$baseURL/admin/showtype/$ID"><% _t('SENT','Sent Items') %></a>
                    <ul>
						<% if MostRecentSentNewsletters %>
						<li class="SentFolder MostRecentFolder nodelete closed" id="mostrecent_$ID"><a href="$baseURL/admin/showtype/$ID">-- Most Recent $RecentSeperator</a>
							<ul>
								<% control MostRecentSentNewsletters %>
		                        <li class="Sent" id="sent_{$ParentID}_{$ID}"><a href="$baseURL/admin/newsletter/shownewsletter/$ID">$Title</a></li>
		                        <% end_control %>
							</ul>
						</li>
						<% end_if %>
						<% if OlderSentNewsletters %>
						<li class="SentFolder OlderFolder nodelete closed" id="older_$ID"><a href="$baseURL/admin/showtype/$ID">-- <% _t('OLDER', 'Older') %></a>
							<ul>
								<% control OlderSentNewsletters %>
		                        <li class="Sent" id="sent_{$ParentID}_{$ID}"><a href="$baseURL/admin/newsletter/shownewsletter/$ID">$Title</a></li>
		                        <% end_control %>
							</ul>
						</li>
						<% end_if %>
                    </ul>
                </li>
                <% end_if %>
                <li id="recipients_$ID" class="Recipients nodelete closed"><a href="$baseURL/admin/newsletter/showtype/$ID"><% _t('MAILLIST','Mailing List') %></a></li>
            </ul>
		</li>
	<% end_control %>
	</ul>
<% else %>
<ul id="sitetree" class="tree unformatted">
</ul>
<% end_if %>
