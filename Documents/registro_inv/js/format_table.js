function formato(tabla_nom){
	var tableOffset = $("#"+tabla_nom).offset().top;
	var $header = $("#"+tabla_nom+" > thead").clone();	
	var paddT = $("#"+tabla_nom).css('margin-left') 
	$("#header-fixed").remove();
	$("body").append('<table id="header-fixed"  width="98%" align="center" border="1" cellspacing="0" cellpadding="0"></table>');
		var $fixedHeader = $("#header-fixed").append($header);

		/*
		var $childs = $("#"+tabla_nom+" > thead > tr:second").children().each(function(index, element) {
			$("#header-fixed > thead > tr:second").children().eq(index).width($(this).width());
			
		});
		*/
		$("#header-fixed ").css("margin-left",paddT)
		$(window).bind("scroll", function() {
			var offset = $(this).scrollTop();		
			if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
				$fixedHeader.show();	
				var $childs = $("#"+tabla_nom+" > thead > tr:first").children().each(function(index, element) {
					$("#header-fixed > thead > tr:first").children().eq(index).width($(this).width());
					console.log($("#header-fixed > thead > tr:first").children().eq(index).width()+' '+$(this).width())
				});		
			}
			else if (offset < tableOffset) {
				$fixedHeader.hide();
			}
	});
}