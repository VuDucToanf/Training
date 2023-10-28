module.exports = new Group();

var groups = {};

function Group() {
    this.addUser = function (user) {
        user = JSON.parse(user);
        groups[user.group_id].push(user.id);
    }
    this.removeUser = function (user) {
        user = JSON.parse(user);
        const index = groups[user.group_id].indexOf(user.id);
        if (index > -1) {
            groups[user.group_id].splice(index, 1);
        }
    }
}
