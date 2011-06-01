<div id="browse-links">
	<div class="list">
	<h3>Browse New Equipment</h3>
	<% control ChildrenOf(new-equipment) %>
	<div class="content_block" style="width:45%;"><a href="$Link">$Title</a></div>
	<% end_control %>
	</div>
	
	<div class="list">
	<h3>Browse Used Equipment</h3>
	<% control ChildrenOf(used-equipment) %>
	<div class="content_block" style="width:45%;"><a href="$Link">$Title</a></div>
	<% end_control %>
	</div>

</div>	