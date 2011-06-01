<html>
	<head>
		<style type="text/css">
				div.data span {
					width: 50%;
				}
			
				div.data span.left {
					text-align: right;
					font-weight: bold;
				}
				
				div.data a {
					overflow: visible;
				}
		</style>
	</head>
	<body>
		<h1>$Subject</h1>
		<p>Dear $FirstName,</p>
		<p>Thanks for subscribe to our mailing list.</p>
		
		 <% if MemberInfoSection %>The following data was submitted:<br />
			<ul>
				<% control MemberInfoSection %>
				<li><% if Title %>$Title<% else %>$Name<% end_if %>: $EmailalbeValue</li>
				<% end_control %>
			</ul>
		<% end_if %>
		
		<% if Newsletters %>
			<p>You're subscribed to the following mailing lists:</p>
			<ul>
				<% control Newsletters %>
					<li>$Title</li>
				<% end_control %>
			</ul>
		<% end_if %>
		
		<p>To unsubscribe any mailing list, click <a href="$UnsubscribeLink">here</a>

	</body>
</html>