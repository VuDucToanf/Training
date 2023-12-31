var socketIO = require("socket.io");
var Group = require("./public/assets/js/nodejs/group");

socketIOServer = socketIO.listen(82);
console.log("Server started.");

socketIOServer.on("connection", onClientConnection);

function onClientConnection(connection) {
    connection.on('disconnect', function () {
        console.log("Client disconnected.");
    });
    connection.on('user-join', async function (user) {
        user = JSON.parse(user);
        Group.addUser(user, connection);
        sendMessageToGroup(user.group_id, JSON.stringify({
            'created_time': new Date(),
            'user_id': user.id,
            'group_id': user.group_id,
            'content': user.id + ' joined ' + user.group_id
        }));
    })
    connection.on('client-message', function (group_id, params) {
        sendMessageToGroup(group_id, params);
    })
}

function sendMessageToGroup(group_id, data) {
    var group = Group.getUserByGroup(group_id);
    group.forEach((conn) => {
        conn.emit('server-message', data);
    })
}
