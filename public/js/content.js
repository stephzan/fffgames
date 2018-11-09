$(document).ready(function(){	
	var testAjax = ajaxQuery("test", "tutu", showTestAjax);

	initPlayerList();

})

function initPlayerList(){
	var playerList = ajaxQuery("getPlayerList", "void", loadPlayerList);
	setTimeout("initPlayerList()", 10000);
}

/* AJAX callback functions */
showTestAjax = function (result){
	console.log("Test Ajax: "+result.data);
}

loadPlayerList = function (result){
	var pll = result.data;
	if(pll !== undefined){
		$("#player_list").empty();
		$.each(pll, function(){
			var content = "<li class='border-bottom'>"+this.username+" (Lobby)<br />level: "+this.level+" | Points: "+this.score+"</li>";
			$("#player_list").append(content);
		})

		$("#info_nbplayer").html(pll.length);//Update info server
	}

	return true;	
}