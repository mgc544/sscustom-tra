<% require css(modules/module_googleanalytics/css/GooglePerformanceChart.css) %>
<% require javascript(sapphire/thirdparty/jquery-livequery/jquery.livequery.js) %>
<% require javascript(modules/module_googleanalytics/thirdparty/jquery.flot/jquery.flot.js) %>
<% require javascript(modules/module_googleanalytics/thirdparty/jquery.flot/jquery.flot.selection.js) %>
<% require javascript(modules/module_googleanalytics/javascript/GooglePerformanceChart.js) %>
<div id="GooglePerformanceChartOverview"></div>
<div id="GooglePerformanceChartOptions"><p id="choices">Show: </p><p id="loading">loading...</p></div>
<div id="GooglePerformanceChart" rel="$PageID">Choose metrics to display</div>