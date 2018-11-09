function callbackResult(result){
	return result;
}

function ajaxQuery(action, data, callback){
	var url = $("#js_ajax_url").val();
	var data = {action: action, data: data};
	var dataString = JSON.stringify(data);

	var req = $.ajax({
	    method: "post",
	    url: url,
	    data: {params: dataString},
	    dataType: "json",
	}).done( function(response) {
	    callback(response);
	}).fail(function(jxh,textmsg,errorThrown){
	    console.log(errorThrown+": "+jxh.responseText);
	});
}