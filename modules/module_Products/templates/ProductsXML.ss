<products>
<% control Products %>
<product>
<name>$Name</name>
<manufacture>$Manufacture</manufacture>
<category>$ProductCategory.Category</category>
<description>$ProductDescription</description>
<link>$VisitSite</link>
<imgurl><% control MainImage %>$AbsoluteURL<% end_control %></imgurl>
<models>
<% control ProductModels %>
<model number="$ModelNumber">
<featrues><![CDATA[$Features]]></featrues>
</model>
<% end_control %>
</models>
</product>
<% end_control %>
</products>