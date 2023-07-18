@extends('layouts.app', ['title' => __('Show Room')])

@section('content')
    @include('users.partials.header', [
        'name' => "Student name: ". $student->name,
        'class' => 'col-lg-12'
    ])
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/qs/6.6.0/qs.min.js"></script>
<script src="{{ asset('chatcord') }}/public/js/socket.io.js"></script>
<link rel="stylesheet" href="{{ asset('chatcord') }}/public/css/style.css" />
<title>Admin Conversation</title>
    <div class="container-fluid mt--7" >
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __($student->name) }}</h3>

                        </div>
                    </div>
                    <div class="card-body">
<header class="chat-header">
        <h1><i class="fas fa-user-graduate"></i> Chat</h1>
        <a href="/messages" class="btn">Leave Conversation</a>
</header>
      <main class="chat-main">
        <div class="chat-sidebar">
          <h3><i class="fas fa-comments"></i> Student: </h3>
          <h2 id="room-name"></h2>
          <h3><i class="fas fa-users"></i> Admins</h3>
          <ul id="users"></ul>
        </div>
        <div class="chat-messages" rel="this"></div>
      </main>
      <div class="chat-form-container">
          <form id="chat-form" >
          <input
            id="msg"
            type="text"
            placeholder="Enter Message"
            required
            autocomplete="off"
          />
          <button class="btn"><i class="fas fa-paper-plane"></i> Send</button>
        </form>
        <div class="chat-input-toolbar">
            <form id="form" class="toolBarChatGroup">
                <button id="btnFile1" class="btn btn-light btn-sm btn-file-upload">
                <i class="fa fa-paperclip"></i>
                </button> |
                <input type="file" id="file1" style="display:none;" />
            </form>
        </div>
      </div>
<script src="{{ asset('chatcord') }}/public/js/socket.io-file-client.js"></script>
<script>
// var socket = io("http://localhost:4000");
var socket = io("lac.alifouad91.com:4000");
//var socket = io("http://192.168.1.34:4000");
var userId = "{{auth()->user()->id }}";
var username = "{{ auth()->user()->name }}";
var RoleId = '{{auth()->user()->role->id}}';
var userImage = "/storage/images/users/{{auth()->user()->image}}";
var room ="{{$student->name}}";
var roomId ="{{$student->id}}000000";
const chatForm = document.getElementById('chat-form');
const chatMessages = document.querySelector('.chat-messages');
const roomName = document.getElementById('room-name');
const userList = document.getElementById('users');
getOldMessages(roomId);
// Join chatroom
socket.emit('joinRoom', {
    'userId':userId,
    'roleId':RoleId,
    'username':username,
    'userImage':userImage,
    'room':room,
    'roomId':roomId
    });
// Get room and users
socket.on('roomUsers', (data) => {
  outputRoomName(data.room);
  outputUsers(data.users);
});


$(document).on('click','#btnFile1',function(e){
e.preventDefault();
    $('#file1').click();
});

var uploader = new SocketIOFileClient(socket);
var form = document.getElementById('form');

uploader.on('start', function(fileInfo) {
	console.log('Start uploading', fileInfo);
});
uploader.on('stream', function(fileInfo) {
	console.log('Streaming... sent ' + fileInfo.sent + ' bytes.');
});
uploader.on('complete', function(fileInfo) {
	console.log('Upload Complete', fileInfo);
        var type;
            if ((fileInfo.mime == 'image/jpeg')||(fileInfo.mime == 'image/gif')||(fileInfo.mime == 'image/png')||(fileInfo.mime == 'image/jpg')){
                type = "img";
            }else if(fileInfo.mime == 'application/pdf'){
                type= "pdf";
            }else if (fileInfo.mime == 'text/plain'){
                type = "txt";
            }else if((fileInfo.mime=="docx")||(fileInfo.mime=="doc")){
                type = "doc";
            }else if ((fileInfo.mime == 'application/zip')||(fileInfo.mime == 'rar')){
                type = "zip";
            }else if (fileInfo.mime == 'application/x-msdownload'){
                type = "exe";
            }else if (fileInfo.mime == 'iso'){
                type = "iso";
            }else if ((fileInfo.mime == 'video/mp4')||(fileInfo.mime == 'video/quicktime')||(fileInfo.mime == 'bideo/rgp')){
                type = "vid";
            }else if (fileInfo.mime == 'srt'){
                type = "srt";
            }else if (fileInfo.mime == 'xlsx'){
                type = "xls";
            }else if (fileInfo.mime =='application/vnd.android.package-archive'){
                type = "apk";
            }else if (fileInfo.mime =='ipa'){
                type = "ipa";
            }else if ((fileInfo.mime =='audio/mp4')||(fileInfo.mime =='audio/ogg')||(fileInfo.mime == 'audio/mpeg')){
                type = "vic";
            }

//    var msg = "http://127.0.0.1:8000/storage/files/"+fileInfo.name;
  var msg = "http://lac.alifouad91.com/storage/files/"+fileInfo.name;


        socket.emit('chatMessage', {
        msg:msg,
        type:type,
        filename:fileInfo.name
    });
});
uploader.on('error', function(err) {
	console.log('Error!', err);
});
uploader.on('abort', function(fileInfo) {
	console.log('Aborted: ', fileInfo);
});

$(document).on('change','#file1',function(event){
event.preventDefault();
	var fileEl = document.getElementById('file1');
	var uploadIds = uploader.upload(fileEl, {
		data: { /* Arbitrary data... */ }
	});
});


// Message from server
socket.on('message', message => {
  outputMessage(message);

  // Scroll down
  chatMessages.scrollTop = chatMessages.scrollHeight;
});

// Message submit
chatForm.addEventListener('submit', e => {
  e.preventDefault();

  // Get message text
  let msg = e.target.elements.msg.value;
  msg = msg.trim();
  type='msg';
  if (!msg){
    return false;
  }

  // Emit message to server
    socket.emit('chatMessage', {
      msg:msg,
      type:type
  });

  // Clear input
  e.target.elements.msg.value = '';
  e.target.elements.msg.focus();

//    $.ajax({
//        url: "http://127.0.0.1:8000/api/notify",
//	type: "POST",
//	data: {
//            msg:msg,
//            typeIs:type,
//            userId:userId,
//            roleId:RoleId,
//            username:username,
//            userImage:userImage,
//            room:room,
//            roomId:roomId
//	},
//        datatype: 'json',
//        success: function () {alert('success');},
//        error: function (jqXHR, textStatus, errorThrown) { alert("error"); }
//    });





});

// Output message to DOM
function outputMessage(message) {
  const div = document.createElement('div');
  div.classList.add('message');

  const p = document.createElement('p');
  p.classList.add('meta');
  p.innerText = message.username;
  p.innerHTML += `<span>${message.time}</span>`;
  div.appendChild(p);
  if (message.type == 'img' ){
        div.innerHTML+='<div id="img-content">'+
        '<a href="'+message.text+'"><img src="'+message.text+'" alt="Download Image ..." id="img-msg-left"></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn-file-upload btn btn-light btn-sm" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if(message.type == 'msg'){
        const para = document.createElement('p');
        para.classList.add('text');
        para.innerText = message.text;
        div.appendChild(para);
  }else if (message.type == 'zip'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-file-archive" style="font-size: 134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'pdf'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-file-pdf" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'doc'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-file-word" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'txt'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-file-alt" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'exe'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="far fa-save" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'iso'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-compact-disc" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'srt'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fas fa-closed-captioning" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
 }else if (message.type == 'vid'){
        div.innerHTML+='<div class="msg-left-g"><video width="128" height="128" controls><source src="'+message.text+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video></div>';
 }else if (message.type == 'xls'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="far fa-file-excel" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
 }else if (message.type == 'apk'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fab fa-android" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'ipa'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+message.text+'"><i class="fab fa-apple" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+message.text+'" download="'+message.fileName+'"><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (message.type == 'vic'){
        div.innerHTML+='<div class="msg-left-g"><audio id="voic" controls><source src="'+message.text+'" ></audio></div>';
  }
  document.querySelector('.chat-messages').appendChild(div);
}

// Add room name to DOM
function outputRoomName(room) {
  roomName.innerText = room;
}

// Add users to ROM
function outputUsers(users) {
  userList.innerHTML = '';
  users.forEach(user=>{
    const li = document.createElement('li');
    li.innerText = user.username;
    userList.appendChild(li);
  });
 }

//#################################################3

function getOldMessages(roomId){
    $.ajax({
             url: "http://lac.alifouad91.com:4000/get_messages",
            //   url: "http://127.0.0.1:4000/get_messages",
			  method: "POST",
			  data: {
				roomId:roomId
			  },
            success: function (response) {
                var messages = JSON.parse(response);
                for (var a = 0; a < messages.length; a++) {
                    const div = document.createElement('div');
  div.classList.add('message');

  const p = document.createElement('p');
  p.classList.add('meta');
  p.innerText = messages[a].sender;
  p.innerHTML += `<span>${messages[a].time}</span>`;
  div.appendChild(p);
  if (messages[a].type == 'img' ){
        div.innerHTML+='<div id="img-content">'+
        '<a href="'+messages[a].msg+'"><img src="'+messages[a].msg+'" alt="Download Image ..." id="img-msg-left"></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn-file-upload btn btn-light btn-sm" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].filename+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if(messages[a].type == 'msg'){
        const para = document.createElement('p');
        para.classList.add('text');
        para.innerText = messages[a].msg;
        div.appendChild(para);
  }else if (messages[a].type == 'zip'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-file-archive" style="font-size: 134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'pdf'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-file-pdf" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'doc'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-file-word" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'txt'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-file-alt" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'exe'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="far fa-save" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'iso'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-compact-disc" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'srt'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fas fa-closed-captioning" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '<button id="btn-open" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" target="_blank"><i class="far fa-folder-open url-img"></i></a></buttom>'+
        '</div></div>';
 }else if (messages[a].type == 'vid'){
        div.innerHTML+='<div class="msg-left-g"><video width="128" height="128" controls><source src="'+messages[a].msg+'" type="video/mp4"><source src="movie.ogg" type="video/ogg"></video></div>';
 }else if (messages[a].type == 'xls'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="far fa-file-excel" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
 }else if (messages[a].type == 'apk'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fab fa-android" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'" ><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'ipa'){
        div.innerHTML+='<div id="img-content" class="msg-left-g">'+
        '<a href="'+messages[a].msg+'"><i class="fab fa-apple" style="font-size:134px;"></i></a>'+
        '<div id="btn-imaeges">'+
        '<button id="btn-save" class="btn btn-light btn-sm btn-file-upload" style="background: #B89925;"><a href="'+messages[a].msg+'" download="'+messages[a].fileName+'"><i class="fas fa-download url-img"></i></a></buttom>'+
        '</div></div>';
  }else if (messages[a].type == 'vic'){
        div.innerHTML+='<div class="msg-left-g"><audio id="voic" controls><source src="'+messages[a].msg+'" ></audio></div>';
  }
  document.querySelector('.chat-messages').appendChild(div);
                }
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
	});
//		<!---================================================--->
}
</script>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
