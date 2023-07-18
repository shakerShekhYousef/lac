<div class= "chat-private">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.js" integrity="sha512-z8IfZLl5ZASsWvr1syw5rkpo2HKBexjwzYDaUkIfoWo0aEqL/MgGKniDouh5DmsD9YrisbM+pihyCKIHL9VucQ==" crossorigin="anonymous"></script>
	<script>
    sender = "";
    receiver="";
    idSender="";
    idReceiver ="";
    RoleSenderId ="";
    RoleReceiverId= "";
    type = "";
    bool = false;
     //var io = io("http://127.0.0.1:3000");
     var io = io("lac.alifouad91.com:3000");
    var time = moment().format('h:mm a');

    function enterName() {
        // get username
        var name = '{{auth()->user()->name}}';
        var idSender = '{{auth()->user()->id}}';
        var RoleSenderId = '{{auth()->user()->role->id}}';
        // send it to server
        io.emit("user_connected",{
            username: name,
            idSender: idSender,
            RoleSenderId: RoleSenderId
        });
        // save my name in global variable
        sender = name;
        idSender = idSender;
        RoleSenderId = RoleSenderId;
        // prevent the form from submitting
        return false;
    }
    enterName();
    io.on("user_connected", function (data) {
        // هنا يمكن ان نضع عنصر حالة انه متصل الان واضافة نفس العنصر في الاعلى بلون اخر غير متصل
    });
    function onUserSelected(username,id,role) {
        // save selected user in global variable
          receiver: username;
          idReceiver: id;
          RoleReceiverId: role;
      }
      $(document).ready(function(){
    const arr = []; // List of users
    $(document).on('click', '.msg_head', function() {
    var chatbox = $(this).parents().attr("rel") ;
    $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
    return false;
});
// <!---================================================--->
     io.on('new_message' , function (data) {
     if (bool == false){
  bool = true;
  var userID = data.idSender;
  var n = data.sender;
  var username = data.sender ;
  var RoleReceiverId = data.RoleReceiverId;
    if ($.inArray(userID, arr) != -1)
  {
      arr.splice($.inArray(userID, arr), 1);
     }
arr.unshift(userID);
 getOldMessages(n , userID , RoleReceiverId);
    chatPopup = '<div class="msg_box" n="'+n+'" style="right:270px" RoleReceiverId="'+RoleReceiverId+'" rel="'+ userID+'">'+
     '<div class="msg_head" >'+username +
     '<div class="close1">x</div> </div>'+
     '<div class="msg_wrap"> <div class="msg_body" id="msg_body"> <div class="msg_push"></div> </div>'+
     '<div class="msg_footer"><input type="text" class="msg_input" id="msg_input"/>'+
     '<div class="chat-input-toolbar">'+
     '<form id="form" >'+
     '<button id="btnFile" class="btn btn-light btn-sm btn-file-upload">'+
            '<i class="fa fa-paperclip"></i>'+
        '</button>'+
        '<input type="file" id="file" style="display:none;" />'+
    '</form>'+
        '</div></div>  </div>  </div>';
     $("body").append(  chatPopup  );
  displayChatBox();
     }
     var chatbox2 =  data.idSender;
     if (data.type == 'img'){
    $('<div id="img-content">'+
    '<a href="'+data.message+'"><img src="'+data.message+'" alt="Download Image ..." id="img-msg-left"></a>'+
    '<div id="btn-images">'+
    '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
    '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
    '</div>'+
    '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'msg'){
        $('<div class="msg-left">'+data.message+'</div><div class="time-left">'+data.time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
      }else if (data.type == 'zip'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-file-archive" style="font-size: 134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'pdf'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-file-pdf" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'doc'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-file-word" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'txt'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-file-alt" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'exe'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="far fa-save" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'iso'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-compact-disc" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'srt'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fas fa-closed-captioning" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'vid'){
        $('<div class="img-content"><video width="128" height="128" controls><source src="'+data.message+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video><div class="time-vid-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
      }else if (data.type == 'xls'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="far fa-file-excel" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'apk'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fab fa-android" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'ipa'){
        $('<div id="img-content">'+
        '<a href="'+data.message+'"><i class="fab fa-apple" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+data.message+'" download="'+data.filename+'"><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div>'+
        '<div class="time-file-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
      }else if (data.type == 'vic'){
            $('<div class="msg-left"><audio id="voice" controls><source src="'+data.message+'" type="audio/mpeg"><div class="time-vic-left">'+data.time+'</div></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
      }
    });
// <!---================================================--->
//   <!---================================================--->
//    <!---================================================--->
//     <!---================================================--->
//      <!---================================================--->


 $(document).on('click', '.close1', function() {
 bool = false;
  var chatbox = $(this).parents().parents().attr("rel") ;
  $('[rel="'+chatbox+'"]').remove();
  arr.splice($.inArray(chatbox, arr), 1);
  displayChatBox();
  $('#sidebar-user-box.'+chatbox).attr("clicked","0");
  return false;
 });

 $(document).on('click', '#sidebar-user-box', function () {
  const clicked = $(this).attr("clicked");
  var userID = $(this).attr("class");
  var n = $(this).attr("data-input");
  var username = n ;
  var RoleReceiverId = $(this).attr("RoleReceiverId");
  if ($(this).attr('clicked') == "0"){

	   getOldMessages(n , userID , RoleReceiverId);

bool = true;
  if ($.inArray(userID, arr) != -1)
  {
      arr.splice($.inArray(userID, arr), 1);
     }

  arr.unshift(userID);
    chatPopup = '<div class="msg_box" n="'+n+'" style="right:270px" RoleReceiverId="'+RoleReceiverId+'" rel="'+ userID+'">'+
     '<div class="msg_head" >'+username +
     '<div class="close1" >x</div> </div>'+
     '<div class="msg_wrap"> <div class="msg_body" id="msg_body"> <div class="msg_push"></div> </div>'+
     '<div class="msg_footer"><input type="text" class="msg_input" id="msg_input"/>'+
     '<div class="chat-input-toolbar">'+
     '<form id="form" >'+
     '<div id="myProgress" style="float: right;"><div id="myBar"></div></div>'+
     '<button id="btnFile" class="btn btn-light btn-sm btn-file-upload">'+
            '<i class="fa fa-paperclip"></i>'+
        '</button>'+
        '<input type="file" id="file" style="display:none;" />'+
    '</form>'+
        '</div></div>  </div>  </div>';
     $("body").append(  chatPopup  );
  displayChatBox();
  $(this).attr("clicked", "1");
}
 });

 $(document).on('keypress', 'input' , function(e) {
        if (e.keyCode == 13 ) {
            const msg = $(this).val();
   $(this).val('')
   if(msg.trim().length != 0){
   var chatbox = $(this).parents().parents().parents().attr("rel") ;
   $('<div class="msg-right">'+msg+'</div><div class="time-right">'+time+'</div>').insertBefore('[rel="'+chatbox+'"] .msg_push');
   $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        var username = $(this).parents().parents().parents().attr('n') ;
        RoleReceiverId = $(this).parents().parents().parents().attr('RoleReceiverId') ;
        onUserSelected(username,chatbox,RoleReceiverId)
        type="msg";
   io.emit("send_message", {
          sender: sender,
          idSender: '{{auth()->user()->id}}',
          RoleSenderId: '{{auth()->user()->role->id}}',
          receiver: username,
          idReceiver:chatbox,
          RoleReceiverId : RoleReceiverId,
          message: msg,
          type:type,
    });
   return false;
   }
        }
    });

 function displayChatBox(){
     i = 80 ; // start position
  j = 260;  //next position

  $.each( arr, function( index, value ) {
     if(index < 4){
          $('[rel="'+value+'"]').css("right",i);
    $('[rel="'+value+'"]').show();
       i = i+j;
     }
     else{
    $('[rel="'+value+'"]').hide();
     }
        });
 }

});

function getOldMessages(receiver , idReceiver , RoleReceiverId){
        onUserSelected(receiver , idReceiver , RoleReceiverId);
//        <!---================================================--->
            idSender = '{{auth()->user()->id}}';
		    // call an ajax
		$.ajax({
          url: "http://lac.alifouad91.com:3000/get_messages",
          //   url: "http://127.0.0.1:3000/get_messages",
//              url: "http://192.168.1.34:3000/get_messages",
			  method: "POST",
			  data: {
				idSender: idSender,
				idReceiver: idReceiver
			  },
            success: function (response) {
//		console.log(response);
                var messages = JSON.parse(response);
                //$(this).val('');
                var chatbox2 = idReceiver;
                for (var a = 0; a < messages.length; a++) {
                    if (messages[a].sender == "{{auth()->user()->name}}"){
			if (messages[a].type == 'img'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><img src="'+messages[a].message+'" alt="Download Image ..." id="img-msg-left"></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'msg'){
                            $('<div class="msg-right">'+messages[a].message+'</div><div class="time-right">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'zip'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-archive" style="font-size: 134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'pdf'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-pdf" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'doc'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-word" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'txt'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-alt" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'exe'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="far fa-save" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'iso'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-compact-disc" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'srt'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-closed-captioning" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'vid'){
                            $('<div class="time-vid-right">'+messages[a].time+'</div><div class="msg-right"><video width="128" height="128" controls><source src="'+messages[a].message+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
			}else if (messages[a].type == 'xls'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="far fa-file-excel" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'apk'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fab fa-android" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'ipa'){
                            $('<div class="time-file-right">'+messages[a].time+'</div><div id="img-content" class="msg-right">'+
                            '<a href="'+messages[a].message+'"><i class="fab fa-apple" style="font-size:134;"></i></a>'+
                            '</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'vic'){
                            $('<div class="time-vic-right">'+messages[a].time+'</div><div class="msg-right"><audio id="voice" controls><source src="'+messages[a].message+'" ></div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                          }
                    }else{
			if (messages[a].type == 'img'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><img src="'+messages[a].message+'" alt="Download Image ..." id="img-msg-left"></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
                            '</div>'+
                            '</div><div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'msg'){
                            $('<div class="msg-left">'+messages[a].message+'</div><div class="time-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'zip'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-archive" style="font-size: 134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'pdf'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-pdf" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'doc'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-word" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'txt'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-file-alt" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'exe'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="far fa-save" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'iso'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-compact-disc" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'srt'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fas fa-closed-captioning" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'vid'){
                            $('<div class="msg-left"><video width="128" height="128" controls><source src="'+messages[a].message+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video></div><div class="time-vid-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
			}else if (messages[a].type == 'xls'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="far fa-file-excel" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'apk'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fab fa-android" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'ipa'){
                            $('<div id="img-content" class="msg-left">'+
                            '<a href="'+messages[a].message+'"><i class="fab fa-apple" style="font-size:134;"></i></a>'+
                            '<div id="btn-images">'+
                            '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+messages[a].message+'" download="'+messages[a].filename+'"><i class="fas fa-download url-img"></i></a></buttom>'+
                            '</div></div>'+
                            '<div class="time-file-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
			}else if (messages[a].type == 'vic'){
                            $('<div class="msg-left"><audio id="voice" controls><source src="'+messages[a].message+'" ></audio></div><div class="time-vic-left">'+messages[a].time+'</div>').insertBefore('[rel="'+chatbox2+'"] .msg_push');
                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                          }
                    }
                }
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
	});
//		<!---================================================--->
}

$(document).on('click','#btnFile',function(e){
e.preventDefault();
    var src='';
    $('#file').click();
    src= $('#file').val();
    var chatbox3 =  $(this).parents().parents().parents().parents().parents().attr("rel") ;
var control = document.getElementById('file');
if (control){
    control.addEventListener('change', function(event) {
        // When the control has changed, there are new files
        var files = control.files;
        var blob;
        myfile= $( '#file' ).val();
        var ext = myfile.split('.').pop();
            blob = files[0];
            control='';
            files[0]='';
            if ((blob.type == 'image/jpeg')||(blob.type == 'image/gif')||(blob.type == 'image/png')||(blob.type == 'image/jpg')){
                type = "img";
            }else if(blob.type == 'application/pdf'){
                type= "pdf";
            }else if (blob.type == 'text/plain'){
                type = "txt";
            }else if((ext=="docx")||(ext=="doc")){
                type = "doc";
            }else if ((blob.type == 'application/zip')||(ext == 'rar')){
                type = "zip";
            }else if (blob.type == 'application/x-msdownload'){
                type = "exe";
            }else if (ext == 'iso'){
                type = "iso";
            }else if ((blob.type == 'video/mp4')||(blob.type == 'video/quicktime')||(blob.type == 'bideo/rgp')){
                type = "vid";
            }else if (ext == 'srt'){
                type = "srt";
            }else if (ext == 'xlsx'){
                type = "xls";
            }else if (blob.type =='application/vnd.android.package-archive'){
                type = "apk";
            }else if (ext =='ipa'){
                type = "ipa";
            }else if ((ext =='m4a')||(ext =='ogg')||(ext =='mp3')){
                type = "vic";
            }
            $(this).val();
uploader.on('complete', function(fileInfo) {
    // var msg = "http://127.0.0.1:8000/storage/files/"+blob.name;
   var msg = "http://lac.alifouad91.com/storage/files/"+blob.name;
  // alert(msg);

   if(msg.trim().length != 0){
     if (type == 'img'){
    $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
    '<a href="'+msg+'"><img src="'+msg+'" alt="Download Image ..." id="img-msg-left"></a>'+
    '<div id="btn-images">'+
    '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
    '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
    '</div>'+
    '</div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'zip'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-file-archive" style="font-size: 134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'pdf'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-file-pdf" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'doc'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-file-word" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'txt'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-file-alt" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'exe'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="far fa-save" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'iso'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-compact-disc" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'srt'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fas fa-closed-captioning" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'vid'){
        $('<div class="time-vid-right">'+time+'</div><div class="msg-right"><video width="128" height="128" controls><source src="'+msg+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
      }else if (type == 'xls'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="far fa-file-excel" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'apk'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fab fa-android" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'ipa'){
        $('<div class="time-file-right">'+time+'</div><div id="img-content" class="msg-right">'+
        '<a href="'+msg+'"><i class="fab fa-apple" style="font-size:134;"></i></a>'+
        '<div id="btn-images">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload"><a href="'+msg+'" download="'+blob.name+'"><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
      }else if (type == 'vic'){
        $('<div class="msg-right"><audio id="voice" controls><source src="'+msg+'" ><div class="time-vic-right">'+time+'</div></div>').insertBefore('[rel="'+chatbox3+'"] .msg_push');
        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
      }
        var username = $(this).parents().parents().parents().parents().parents().attr('n') ;
        RoleReceiverId = $(this).parents().parents().parents().parents().parents().attr('RoleReceiverId') ;
        onUserSelected(username,chatbox3,RoleReceiverId)
   io.emit("send_message", {
          sender: sender,
          idSender: '{{auth()->user()->id}}',
          RoleSenderId: '{{auth()->user()->role->id}}',
          receiver: username,
          idReceiver:chatbox3,
          RoleReceiverId : RoleReceiverId,
          message: msg,
          type:type,
          filename:blob.name,
    });

   return false;
   }
    }, false);

});
}
});

//$('#btn-save').click(function() {
//    //put this button inside the <a> tag
//    var a = $("<a>").attr("href" ).attr("download").appendTo("body");
//    a[0].click();
//    a.remove();
//});

//$(document).on('click','#btn-save',function(){
//    var a = document.getElementById('#img-url');
//});
//$(document).on('click', '#btn-open' ,function() {
//    var win = window.open('http://stackoverflow.com/', '_blank');
//    if (win) {
//        //Browser has allowed it to be opened
//        win.focus();
//    } else {
//        //Browser has blocked it
//        alert('Please allow popups for this website');
//    }
//});

</script>
<script type="text/javascript">
var uploader = new SocketIOFileClient(io);
var form = document.getElementById('form');

uploader.on('start', function(fileInfo) {
	console.log('Start uploading', fileInfo);
});
uploader.on('stream', function(fileInfo) {
    document.getElementById('myBar').innerText = "Sending now ....";
	// console.log('Streaming... sent ' + fileInfo.sent + ' bytes.');
});
uploader.on('complete', function(fileInfo) {
    document.getElementById('myBar').innerText = "Sending complated";
	console.log('Upload Complete', fileInfo);
});
uploader.on('error', function(err) {
	console.log('Error!', err);
});
uploader.on('abort', function(fileInfo) {
	console.log('Aborted: ', fileInfo);
});

$(document).on('change','#file',function(event){
event.preventDefault();
	var fileEl = document.getElementById('file');
	var uploadIds = uploader.upload(fileEl, {
		data: { /* Arbitrary data... */ }
	});
});



</script>



