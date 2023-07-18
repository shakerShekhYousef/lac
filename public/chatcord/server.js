const path = require('path');
const http = require('http');
const express = require('express');
const socketio = require('socket.io');
const SocketIOFile = require('socket.io-file');
const formatMessage = require('./utils/messages');
const moment = require('moment');
var request_lib = require('request');
const {
  userJoin,
  getCurrentUser,
  userLeave,
  getRoomUsers
} = require('./utils/users');

const app = express();
const server = http.createServer(app);
const io = socketio(server);
var bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({ extended: true }));
// Set static folder
//app.use(express.static(path.join(__dirname, 'public')));

const botName = 'Admin: ';
//===========================================================
// Create instance of mysql
var mysql = require("mysql");

// make a connection

// var connection = mysql.createConnection({
//     "host": "localhost",
//     "user": "root",
//     "password": "",
//     "database": "laravel"
// });
// make a connection
var connection = mysql.createConnection({
    "host": "127.0.0.1",
    "user": "alifouad91_lac",
    "password": "lacP@$$word",
    "database": "alifouad91_lac",
    "charset": "utf8mb4"
});
// connect
connection.connect(function (error) {
  if (error) throw error;
console.log("Connected!");
});
//===================================
app.use(function (request, result, next) {
    result.setHeader("Access-Control-Allow-Origin", "*");
    next();
});
//===================================
app.post("/get_messages", function (request, result) {
    // get all messages from database
	console.log (' request.body.roomId ', request.body.roomId );
    connection.query("SELECT * FROM msggrops WHERE (roomId = '" + request.body.roomId + "')", function (error, messages) {
        // response will be in JSON
        result.end(JSON.stringify(messages));
    });
    connection.query("UPDATE msggrops SET `reading`=0 WHERE (roomId = '" + request.body.roomId + "' AND reading = 1)", function (err, result) {
        // response will be in JSON
        if (err) throw err;
        console.log ('all messages are readed');
        console.log(result.affectedRows + " record(s) updated");

    });
});
app.post("/getUnReadMessages",function(request, result){
    connection.query("SELECT * ,COUNT(*) FROM msggrops WHERE (roomId = '" + request.body.roomId + "' AND reading = 1 )GROUP BY `reading` ", function (error, messages) {
        result.end(JSON.stringify(messages));
        console.log (' request.body.roomId ', request.body.roomId );
        console.log(messages);

    });
});
//===================================
// Run when client connects
io.on('connection', socket => {
  socket.on('joinRoom', (data) => {
    const user = userJoin(socket.id, data.username, data.room, data.userId, data.roleId, data.userImage, data.roomId);
	console.log ('socketid ',socket.id,' userid ',data.userId,' room id  ', data.roomId);
    socket.join(user.room);
    // Welcome current user
//    socket.emit('message', formatMessage(botName, 'Welcome to Class','msg',data.userId,data.roleId));

    // Broadcast when a user connects
//    socket.broadcast
//      .to(user.room)
//      .emit(
//        'message',
//        formatMessage(botName, `${user.username} has joined the class`,'msg',data.userId,data.roleId)
//      );

    // Send users and room info
    io.to(user.room).emit('roomUsers', {
      'room': user.room,
      'users': getRoomUsers(user.room)
    });
    var uploader = new SocketIOFile(socket, {
		// uploadDir: {			// multiple directories
		// 	music: 'data/music',
		// 	document: 'data/document'
	// 	// },
       uploadDir:  '/home/alifouad91/lac.alifouad91.com/storage/app/public/files/',
		// uploadDir: '../../storage/app/public/files',		// simple directory
                maxFileSize: 111114194304, 						// 4 MB. default is undefined(no limit)
		chunkSize: 10240,							// default is 10240(1KB)
		transmissionDelay: 0,						// delay of each transmission, higher value saves more cpu resources, lower upload speed. default is 0(no delay)
		overwrite: true 							// overwrite file if exists, default is true.
	});
	uploader.on('start', (fileInfo) => {
		console.log('Start uploading');
		console.log(fileInfo);
	});
	uploader.on('stream', (fileInfo) => {
		console.log(`${fileInfo.wrote} / ${fileInfo.size} byte(s)`);
	});
	uploader.on('complete', (fileInfo) => {
		console.log('Upload Complete.');
		console.log(fileInfo);
	});
	uploader.on('error', (err) => {
		console.log('Error!', err);
	});
	uploader.on('abort', (fileInfo) => {
		console.log('Aborted: ', fileInfo);
	});
  });

  // Listen for chatMessage
  socket.on('chatMessage',data=> {
    const user = getCurrentUser(socket.id);
    console.log('xxxxxxxxxxxxxxx');
	console.log (' data chatmessage ',data);
	console.log (' user  chatmessage ',user);


  //       connection.query("INSERT INTO msgGrops (content) VALUES ('" + user.room + "')", function (error, result) {
  //             //
  //         });
  // });//type,data.userId,data.roleId
  io.to(user.room).emit('message', formatMessage(user.username, data.msg , data.type ,user.userId,user.roleId, data.fileName));
time =  moment().format('h:mm a');
data.reading = 1;
      console.log('hello');
console.log(' user room  ',user.roomId);

    request_lib('http://www.google.com', function (error, response, body) {
  console.error('error:', error); // Print the error if one occurred
  console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
  console.log('body:', body); // Print the HTML for the Google homepage.
});

    request_lib.post({url:'http://lac.alifouad91.com/api/send_notification_to_group', form: {group_id:user.roomId, sender_id: user.userId}}, function(err,httpResponse,body){})
    
    // request_lib({
    //               method: 'POST',
    //               // url: 'http://127.0.0.1:8000/api/send_notification',
    //               url: 'http://lac.alifouad91.com/api/send_notification_to_group',
    //               data: {
    //                   group_id: 3,
    //                   sender_id: 6,
    //               }, function (error, response, body) {
    //                   console.log(response);
    //                   if (!error && response.statusCode == 200) {
    //                       console.log(body);
    //                   }
    //                   else {
    //                       console.log(body);
    //                   }
    //               },
    //           });
              
  var s = connection.query("INSERT INTO msggrops (msg,type, time, groupName, sender, userId, roleId, roomId, userImage, filename, reading)"+
  "VALUES"+
  "('" + data.msg + "' ,'" + data.type + "' ,'"+ time +"', '"+ user.room +"' , '"+ user.username +"', '"+ user.userId +"' , '"+ user.roleId +"'," +
      " '"+ user.roomId +"' , '"+ user.userImage +"', '"+data.filename+"' , '"+data.reading+"' )", function (error, result) {
        //   console.log(user.roomId);
          
      //
      // connection.query("SELECT * FROM msgGrops WHERE (id = '" + s._results[0].insertId + "' ) ", function (error, messages) {
      //     //console.log('messages',messages[0].reading);
      //
      //     if (messages[0].reading == 1 ){
      //
      //
      //         request_lib({
      //             method: 'POST',
      //             // url: 'http://127.0.0.1:8000/api/send_notification',
      //             url: 'http://lac.alifouad91.com/api/send_notification',
      //             data: {
      //                 receiver_id:s._results[0].idReceiver,
      //                 sender_id:s._results[0].idSender,
      //             }, function (error, response, body) {
      //                 if (!error && response.statusCode == 200) {
      //                     console.log(body)
      //                 }
      //             },
      //         });
      //
      //
      //
      //     }
      // });
        // request_lib({
        //     method: 'POST',
        //     // url: 'http://127.0.0.1:8000/api/send_notification',
        //     url: 'http://lac.alifouad91.com/api/send_notification',
        //     data: {
        //         // receiver_id:s._results[0].idReceiver,
        //         sender_id:s._results[0].idSender,
        //     }, function (error, response, body) {
        //         if (!error && response.statusCode == 200) {
        //             console.log(body)
        //         }
        //     },
        // });

    });
});

  // Runs when client disconnects
  socket.on('disconnect', () => {
    const user = userLeave(socket.id);

    if (user) {
//      io.to(user.room).emit(
//        'message',
//        formatMessage(botName, `${user.username} has left the class`)
//      );

      // Send users and room info
      io.to(user.room).emit('roomUsers', {
        'room': user.room,
        'users': getRoomUsers(user.room)
      });
    }
  });
});

const PORT = process.env.PORT || 4000;

server.listen(PORT, () => console.log(`Server running on port ${PORT}`));
