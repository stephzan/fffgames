$(document).ready(function(){	
	var testAjax = ajaxQuery("test", "tutu", showTestAjax);

	var playerList = ajaxQuery("getPlayerList", "void", loadPlayerList);

})

/* AJAX callback functions */
showTestAjax = function (result){
	console.log("Test Ajax: "+result.data);
}

loadPlayerList = function (result){
	var pll = result.data;
	if(pll !== undefined){
		$("#player_list").empty();
		$.each(pll, function(){
			var content = "<li class='border-bottom'>"+this.username+" (Lobby)<br />level: 8 | Points: 20598</li>";
			$("#player_list").append(content);
		})
	}

	return true;
}