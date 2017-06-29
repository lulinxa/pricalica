var onlineTimer;
var popUpTimer;
var noOfUsers;
var username;
var enroll;
var chatRefreshTimer;
var newmsg="yes";
var browserTitle = "Pričalica";

$(document).ready(function(){
  $(window).load(showOnline(),popUpChat());
  $(window).focus(function(){
 	  document.title = browserTitle;
  });
});

function showOnline() {
  setOnlineStatus("yes");
	var str = "action=checkMyOnlineStatus";
	$.ajax({url:"processRequest.php", type:"POST", dataType:"xml", data:""+str+"", success:function(result) {
		var onlineStatus = $(result).find("root").attr("online");
		if(onlineStatus=="yes") {
			$("div#online_users_box").html("Loading...");
      refreshOnline();
      onlineTimer = setInterval("refreshOnline()",2500);
		}
	}});
}

function refreshOnline() {
  $.ajax({url:"show_online.php", success:function(result){
    $("#users-list").html(result);
    noOfUsers = $(".list-group-item").toArray();
    $("#onlinetitle").html("Spojeni korisnici ("+noOfUsers.length+")");
  }});
}

function setOnlineStatus(onlineStatus) {
	var str = "action=setOnlineStatus&status="+onlineStatus;
	$.ajax({url:"processRequest.php", type:"POST", data:""+str+""});
}

function chatWith(username,enroll) {

	closeAllChat();
	if($("div#chatbox_"+enroll).length==0) {
    constructChatbox(enroll,username);
    startChatSession(enroll);
    clearInterval(chatRefreshTimer);
    newmsg="yes";
    getChat(enroll,username);
    chatRefreshTimer = setInterval("getChat("+enroll+","+username+")",1500);
	} else {
    restructChatbox(enroll,username);
	}
  
  $("div#chatbox_"+enroll+" div.chatbox_title").text(username);

}

function closeAllChat() {
  $("div.chatbox_text").hide();
  $("div.chatbox_msg").hide();
  $("div.chatbox_user").hide();
}

function closeChat(roll) {
	$("div#chatbox_"+roll).hide();
}

function constructChatbox(enroll,username) {

		$("div#chatbox").append("<div id='chatbox_"+enroll+"' class='chatbox_user' ></div>");
		$("div#chatbox_"+enroll).append("<div><div class='chatbox_title' onclick='javascript:restructChatbox("+enroll+",&#39;"+username+"&#39;)'>"+username+"</div><div id='closeChat' class='opt close_chat' onClick='javascript:closeChat("+enroll+")'>X</div></div>");
		$("div#chatbox_"+enroll).append("<div class='chatbox_msg'></div>");
		$("div#chatbox_"+enroll).append("<div class='chatbox_text' ><form onSubmit='return sendChat("+enroll+",&#39;"+username+"&#39;)'><input type='text' name='msg' autocomplete='off' /></form></div>");
		$("div#chatbox_"+enroll+" div.chatbox_text input").focus();
		$("div#chatbox_"+enroll+" div.chatbox_msg").html("<div class='err_msg'>Učitavanje prijašnjih poruka...</div>");

}

function restructChatbox(roll,name) {

	$("div#chatbox_"+roll).show();
	$("div#chatbox_"+roll+" div.chatbox_title").css("background-color","#2196F3");
  $("div#chatbox_"+roll+" div.chatbox_title").text(name);
	$("div#chatbox_"+roll+" div.chatbox_msg").show();
	$("div#chatbox_"+roll+" div.chatbox_text").show();
	$("div#chatbox_"+roll).css({"position":"relative","top":"0px"});
	$("div#chatbox_"+roll+" div.chatbox_text input").focus();
	clearInterval(chatRefreshTimer);
	newmsg="yes";
	getChat(roll,name);
	chatRefershTimer = setInterval("getChat("+roll+","+name+")",1500);

}

function startChatSession(roll) {
	var str = "action=startChatSession&roll="+roll;
	$.ajax({url:"processRequest.php", type:"POST", data:""+str+""});
}

function sendChat(roll,name) {

	var msg = $("div#chatbox_"+roll+" div.chatbox_text input").val();
	var str = "action=sendChat&msg="+msg+"&roll="+roll+"&name="+name;
	if(msg.length!=0) {
		$.ajax({url:"processRequest.php", type:"POST", data:""+str+"", dataType:"xml", success:function(result) {
			var check = $(result).find("root").attr("success");
			if(check=="no") {
				clearInterval(chatRefreshTimer);
				$("div#chatbox_"+roll+" div.chatbox_msg").empty();
				$("div#chatbox_"+roll+" div.chatbox_msg").html("<div class='err_msg'>"+name+" is unavailable</div>");
			} else {
				newmsg="yes";
				getChat(roll,name);
			}
		}});
	}
	$("div#chatbox_"+roll+" div.chatbox_text input").val("");

	return false;
}

function getChat(roll,name) {

	var str = "action=getChat&roll="+roll;
	var user;

	$.ajax({url:"processRequest.php", type:"POST", data:""+str+"", dataType:"xml",success:function(result) {

		var count = $(result).find("root").attr("count");
		if(count!=0) {
			$("div#chatbox_"+roll+" div.chatbox_msg").empty();
			$(result).find("messages").each(function(){
				user = $(this).find("user").text();
				msg = $(this).find("msg").text();

				$("div#chatbox_"+roll+" div.chatbox_msg").prepend("<div class='msg_container'><div id='sender'><b>"+user+"</b>: "+msg+"</div><br>");

			});

			if(newmsg=="yes") {
				$("div#chatbox_"+roll+" div.chatbox_msg").scrollTop($("div#chatbox_"+roll+" div.chatbox_msg")[0].scrollHeight);
				if($("div#chatbox_"+roll+" div.chatbox_text input").is(":focus")==false) {
					setBrowserTitle(name);
	        $("div#chatbox_"+roll+" div.chatbox_text input").focus();
				}
				newmsg="no";
			}
		}

		else {
			$("div#chatbox_"+roll+" div.chatbox_msg").empty();
			$("div#chatbox_"+roll+" div.chatbox_msg").html("<div class='err_msg'>Započni razgovor</div>");
		}

	}});

}

function popUpChat() {
	refreshPopUpChat();
	popUpTimer = setInterval("refreshPopUpChat()",3000);
}

function refreshPopUpChat() {
	var str = "action=popUpChat";
	$.ajax({url:"processRequest.php", type:"POST", data:""+str+"", dataType:"xml", success:function(result){
		var c = $(result).find("root").attr("count");
		if(c>0) {
			$(result).find("users").each(function(){
				var name = $(this).find("name").text();
				var roll = $(this).find("roll").text();

				if($("div#chatbox_"+roll).length==0) {
					setBrowserTitle(name);
					chatWith(name,roll);
				}
				else
				if($("div#chatbox_"+roll).css("top")=="205px"){
					setBrowserTitle(name);
					//playSound();
					$("div#chatbox_"+roll).show();
					$("div#chatbox_"+roll+" div.chatbox_title").css("background-color","#99C");
					$("div#chatbox_"+roll+" div.chatbox_title").text(name+" says...");
				}
				else{
					$("div#chatbox_"+roll).show();
					newmsg="yes";
					getChat(roll,name);
					chatRefreshTimer = setInterval("getChat("+roll+","+name+")",1500);
				}

			});
		}
		else
			newmsg="no";
		}
	});
}

function setBrowserTitle(name) {
	document.title=name+" kaze...";
}
