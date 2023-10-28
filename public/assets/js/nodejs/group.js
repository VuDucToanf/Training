module.exports = new Group();

var groups = {};

function Group() {
    this.addUser = function (user, conn) {
        if (groups[user.group_id] === undefined) {
            groups[user.group_id] = [];
        }
        groups[user.group_id].push(conn);
        return user.group_id;
    }
    this.removeUser = function (user) {
        user = JSON.parse(user);
        const index = groups[user.group_id].indexOf(user.id);
        if (index > -1) {
            groups[user.group_id].splice(index, 1);
        }
    }
    this.getUserByGroup = function (group_id) {
        return groups[group_id];
    }
}
