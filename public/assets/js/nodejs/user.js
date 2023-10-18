module.exports = new User();

var users = {};

function User() {
    this.addUser = function (user) {
        user = JSON.parse(user);
        users[user.group_id] = user;
    }

    this.removeUser = function (user, connection) {
    }
}
