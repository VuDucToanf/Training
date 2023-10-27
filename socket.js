var socketIO = require("socket.io");

socketIOServer = socketIO.listen(82);
console.log("Server started.");

socketIOServer.on("connection", onClientConnection);

function onClientConnection(connection) {
    connection.on('disconnect', function() {
        console.log("Client disconnected.");
    })
    connection.on('add-user', function (user) {
        user = JSON.parse(user);
        console.log(user);
        connection.join(user.group_id);
        // socketIOServer.to(user.group_id, function (conn) {
        //     conn.emit('message', JSON.stringify(user.group_id), JSON.stringify({
        //         'created_time': new Date(),
        //         'user_id': user.id,
        //         'content': user.id + ' joined'
        //     }));
        // });
    })
    connection.on('message', function(group_id, params) {
        console.log('check', 1);
        connection.emit('message', group_id, params);
    })
}
