var socketIO = require("socket.io");

socketIOServer = socketIO.listen(82);
console.log("Server started.");

socketIOServer.on("connection", onClientConnection);

function onClientConnection(connection) {
    connection.on('add-user', async function (user) {
        user = JSON.parse(user);
        connection.join(user.group_id);
        await socketIOServer.to(user.group_id, function (conn) {
            conn.emit('message', JSON.stringify(user.group_id), JSON.stringify({
                'created_time': new Date(),
                'user_id': user.id,
                'content': user.id + ' joined'
            }));
        });
    })
    connection.on('message', function(group_id, params) {
        connection.emit('message', group_id, params);
    })
}

// function removeUser(userId, connection) {
// }
//
// function onClientMessage(message) {
//     var message = JSON.parse(message);
//     console.log("client message", message);
// }
//
// function sendMessageTo(userId, message) {
//     var user = getUser(userId);
//     user.emit("client-msg", message);
// }
//
// function getUser(userId) {
//     var retval = null;
//     for (let index = 0; index < users.length; index++) {
//         const user = users[index];
//         if (user.userId == userId) {
//             retval = user;
//             break;
//         }
//     }
//     return retval;
// }
