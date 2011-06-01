<products><% control Products %>
<product>
		<id>$ID</id>
		<name>$Name</name>
		<manufacture>$Manufacture.XML</manufacture>
		<url>$VisitSite.XML</url>
		<category>$ProductCategory.Category.XML</category>
			<models><% control ProductModels %>
			<model number="$ModelNumber.XML" <% control Photo %>url="$AbsoluteURL"<% end_control %>>
			<features><![CDATA[$Features]]></features>
			<specs><![CDATA[$Specs]]></specs>
			</model>
			<% end_control %></models>
</product>
<% end_control %></products>