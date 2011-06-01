function loadAjax(loadIntoElID, page) {
 var completeURL = jQuery('base').attr('href') + page; //NOTE THAT jQuery('base').attr('href') should work as the base tag should be included in your header.
 var imgHtml = '<img src="http://72.32.112.233/themes/lakeland/images/ajax-loader.gif" alt="loading . . ." />';
 jQuery("#" + loadIntoElID).html(imgHtml);
 jQuery("#" + loadIntoElID).load(URL, {}, function() {/* another function here that runs after content has been loaded */});
 return true;
}


