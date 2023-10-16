app.controller("UserController", UserController);

function UserController($scope, $rootScope, $http) {
    this.prototype = new BaseController($scope, $http, $rootScope);
    $scope.users = [];
    $scope.total = 0;
    $scope.page_current = 1;
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
        var url = 'api/user' + encodeQuery($scope.params);
        url = $scope.buildUrl(url);
        $http.get(url).then(function mySuccess(response) {
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

    $scope.search = function () {
        $scope.params.email = $('input#search-email').val();
        $scope.params.full_name = $('input#search-full_name').val();
        $scope.params.status = $('select#UserStatus').val();
        $scope.params.gender = $('select#UserGender').val();
        $scope.find();
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
        $('input#search-email').val('');
        $('input#search-full_name').val('');
        $('select#UserStatus').val('');
        $('select#UserGender').val('');
        $scope.find();
    }

    $scope.showModalUser = function (user) {
        if (user !== undefined) {
            $scope.user = user;
        } else {
            $scope.user = undefined;
        }
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
            'full_name': $('input#nameBasic').val(),
            'email': $('input#emailBasic').val(),
            'location': $('input#locationBasic').val(),
            'gender': $('select#genderBasic').val(),
        };
        postData(url, data);
    }

    $scope.createUser = function () {
        var url = 'api/user';
        var data = {
            'full_name': $('input#nameBasic').val(),
            'email': $('input#emailBasic').val(),
            'location': $('input#locationBasic').val(),
            'gender': $('select#genderBasic').val(),
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
