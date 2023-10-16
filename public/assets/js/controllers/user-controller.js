app.controller("UserController", UserController);

function UserController($scope, $rootScope, $http) {
    this.prototype = new BaseController($scope, $http, $rootScope);
    $scope.users = [];
    $scope.total = 0;
    $scope.page_current = 1;
    $scope.user = {
        full_name: '',
        email: '',
        gender: '',
        address: ''
    };
    $scope.params = {
        id: 0,
        full_name: '',
        email: '',
        gender: '',
        status: '',
        page_id: 1,
        page_size: 10
    };

    $scope.find = function () {
        $scope.isLoading = true;
        var url = 'api/user';
        $http.get(url, {params: $scope.params}).then(function mySuccess(response) {
            if (response.data && response.data.status == 'successful') {
                $scope.users = response.data.result;
                $scope.total = response.data.total;
                $scope.pageList = [];
                for (var i = 1; i <= Math.ceil($scope.total/ $scope.params.page_size); i++) {
                    $scope.pageList.push(i);
                }
                $scope.isLoading = false;
            }
        })
    }

    $scope.reset = function () {
        $scope.params = {
            id: 0,
            full_name: '',
            email: '',
            gender: '',
            status: '',
            page_id: 1,
            page_size: 10
        };
        $scope.find();
    }

    $scope.showModalUser = function (data) {
        if (data !== undefined) {
            $scope.user = data;
        } else {
            $scope.user = {
                full_name: '',
                email: '',
                gender: '',
                address: ''
            };
        }
        $('#btnShowModal').click();
    }

    function postData(url, data) {
        $http.post(url, data).then(() => {
            $scope.find();
        });
        $('#basicModal .btn-close').click();
    }

    $scope.editUser = function (id) {
        var url = 'api/user/' + id;
        var data = {
            'full_name': $scope.user.full_name,
            'email': $scope.user.email,
            'location': $scope.user.address,
            'gender': $scope.user.gender,
        };
        postData(url, data);
    }

    $scope.createUser = function () {
        var url = 'api/user';
        var data = {
            'full_name': $scope.user.full_name,
            'email': $scope.user.email,
            'location': $scope.user.address,
            'gender': $scope.user.gender,
        };
        postData(url, data);
    }


    this.init = function () {
        $scope.find();
    }

    function encodeQuery(data){
        let query = "?"
        for (let d in data)
            query += encodeURIComponent(d) + '=' + encodeURIComponent(data[d]) + '&'
        return query.slice(0, -1)
    }

    this.init();
}
