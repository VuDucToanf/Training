var socketIO = require("socket.io");

socketIOServer = socketIO.listen(82);
console.log("Server started.");

var userSocket = require("./public/assets/js/nodejs/user");
var chatSocket = require("./public/assets/js/nodejs/chat");

socketIOServer.on("connection", onClientConnection);
// socketIOServer.on("disconnection", onClientConnection);

function onClientConnection(connection) {
    connection.emit("server-msg", "Hello client");
    connection.on('add-user', function (user) {
        userSocket.addUser(user);
    })
    connection.on('message', function(group_id, params) {
        connection.emit('message', group_id, params);
    })
}

function removeUser(userId, connection) {
}

function onClientMessage(message) {
    var message = JSON.parse(message);
    console.log("client message", message);
}

function sendMessageTo(userId, message) {
    var user = getUser(userId);
    user.emit("client-msg", message);
}

function getUser(userId) {
    var retval = null;
    for (let index = 0; index < users.length; index++) {
        const user = users[index];
        if (user.userId == userId) {
            retval = user;
            break;
        }
    }
    return retval;
}

function getUsers(groupId) {
    var retval = null;
    //...
    return retval;
}
