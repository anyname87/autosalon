$(function () {
	$("#main-slider").carousel();
	$("#main-slider a[data-img]").hover(function() {
		if($(this).hasClass("current-img")) return false;
		var text = $(this).text();
		var img = $(this).attr("data-img");
		var active = $("#main-slider .active");
		active.find("a").removeClass("current-img");
		$(this).addClass("current-img");
		active.find(".carousel-title").text(text);
		active.find(".current-photo").fadeTo(500, 0, function() {
			$(this).attr("src", img);
			$(this).fadeTo(500, 1);
		});
		
	});
	$("a[rel=photo_group]").fancybox();
	$(".eye").tooltip({ html: true, trigger: "hover", placement : "top"});
})


// Устанавливаем стоимость авто в детальной информации по онлайн-заявке 
// при выборе соответствующей комплектации
function SetPrice(op) {
	var price = $(op.options[op.selectedIndex]).attr("data-price");
	$("#request-model-price").text(price);
}