$j = jQuery.noConflict();

$j.fn.ColorField = function() {
	this.each(function() {
		$j.fn.ColorField.init(this);
	});
};

$j.fn.ColorField.init = function(obj) {
	$j(obj).ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			var mid = (rgb.r + rgb.g + rgb.b) / 3;
			var col = mid > 127 ? '#000000' : '#ffffff';
			$j(obj).val(hex).css({color:col, backgroundColor:'#' + hex});
		},
		onBeforeShow: function () {
			$j(this).ColorPickerSetColor(this.value);
		}
	}).bind('keyup', function(){
		$j(this).ColorPickerSetColor(this.value);
	});
}

if(typeof Behaviour === "object"){
	Behaviour.register({
		'.ColorPickerInput' : {
			initialize : function() {$j(this).ColorField();}
		}
	});
} else {
	$j('.ColorPickerInput').ColorField();
}