app.controller("ChatController", ChatController);

function ChatController($scope) {
    var connection = io('ws://127.0.0.1:82', {
        "transports": ["websocket"]
    });

    $scope.defaultValue = {
        id: '',
        group_id: '',
        content: '',
        show_join: true
    }

    $scope.user = {
        id: '',
        group_id: ''
    };

    // add user
    $scope.joinGroup = function () {
        if ($scope.defaultValue.id && $scope.defaultValue.group_id) {
            $scope.user.id = $scope.defaultValue.id;
            $scope.user.group_id = $scope.defaultValue.group_id;
            $scope.defaultValue.show_join = false;
            connection.emit('add-user', JSON.stringify($scope.user));
            connection.emit('message', JSON.stringify({
                'created_time': new Date(),
                'user_id': $scope.user.id,
                'group_id': $scope.user.group_id,
                'content': $scope.user.id + ' joined'
            }));
        }
    }

    // messages
    $scope.messages = {};
    $scope.giveMessage = function (group_id, params) {
        $scope.$apply(function() {
            if (!$scope.messages[JSON.parse(group_id)]) {
                $scope.messages[JSON.parse(group_id)] = [];
            }
            $scope.messages[JSON.parse(group_id)].push(JSON.parse(params));
        })
    }

    $scope.sendMessage = function () {
        connection.emit('message', JSON.stringify($scope.user.group_id), JSON.stringify({
            'created_time': new Date(),
            'user_id': $scope.user.id,
            'content': $scope.defaultValue.content
        }));
        $scope.defaultValue.content = '';
    }

    this.init = function () {
    };
    connection.on('message', $scope.giveMessage);

    this.init();
}
