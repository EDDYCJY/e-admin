$(function() {
	$(".js-delete-all").on("click", function () {
	    var keys = $("#grid").yiiGridView("getSelectedRows");
	    var url  = $("input[name=js-delete-all-url]").val();
	    if(keys.length > 0 && url) {
	        if(confirm("确定删除吗？")) {
	            window.location.href = url + '&ids=' + keys.join(",");
	        }
	    }
	});
})