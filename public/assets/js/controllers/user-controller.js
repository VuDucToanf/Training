app.controller("UserController", UserController);

function UserController($scope, $rootScope, $http) {
    this.prototype = new BaseController($scope, $http, $rootScope);
    $scope.users = [];
    $scope.page_id = 1;
    $scope.page_size = 10;
    $scope.params = {
        id: 0,
        full_name: '',
        email: '',
        gender: '',
        status: ''
    };

    $scope.getUser = function () {
        var url = 'api/user' + encodeQuery($scope.params);
        url = $scope.buildUrl(url);
        $http.get(url).then(function mySuccess(response) {
            if (response.data && response.data.status == 'successful') {
                $scope.users = response.data.result;
            }
        })
    }

    this.init = function () {
        $scope.getUser();
    }

    function encodeQuery(data){
        let query = "?"
        for (let d in data)
            query += encodeURIComponent(d) + '=' + encodeURIComponent(data[d]) + '&'
        return query.slice(0, -1)
    }

    this.init();
}
