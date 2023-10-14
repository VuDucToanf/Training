const STATUS_SUCCESSFUL = 'successful';
const STATUS_FAIL = 'fail';

function BaseController($scope, $http, $rootScope) {

    $scope.isLoading = false;

    $scope.hideLoading = function () {
        Pace.stop();
    }

    $scope.checkEnterKey = function(event) {
        if (event.keyCode === 13) {
            var element = angular.element(event.target);
            var searchBtn = element.parent().find('button');
            if (searchBtn) {
                searchBtn.triggerHandler('click');
            }
        }
    };

    $scope.buildUrl = function (url, has_app = false) {
        return API_URL + '/' +url;
    }

    $scope.addTokenInUrl = function(url) {
        return url;
    }


    $scope.showNotification = function (title, text, type, icon) {

        new PNotify({
            title: title,
            text: text,
            type: type,
            icon: 'glyphicon ' + icon,
            addclass: 'snotify',
            closer: true,
            delay: 1200
        });
    }

    $scope.buildFilter = function () {
        var query = '';
        if ($scope.filter) {
            for (const [key, value] of Object.entries($scope.filter)) {
                if (query == '') {
                    query += '?'
                } else {
                    query += '&';
                }
                if (typeof value === "object") {
                    if (value != null && value.code) {
                        query += key + '=' +  value.code
                    }
                } else {
                    query += key + '=' +  value
                }
            }
        }
        return query;
    }

    $scope.isJsonString = function (str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    $scope.htmlDecodeEntities = function (input){
        var e = document.createElement('div');
        e.innerHTML = input;
        return e.childNodes[0].nodeValue;
    }

    $scope.isValidLink = function (link) {
        var regex = /(^|\s)((https?:\/\/)[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
        return regex.test(link);
    }

    $scope.isValidEmail = function (email) {
        var regex = /^[\w\.-]+@[\w\.-]+\.\w{2,5}$/;
        var retVal = email != null && email.match(regex) != null;
        return retVal;
    }

    $scope.isValidPhone = function(phone) {
        if (phone == null) {
            return false;
        }
        //ELSE:
        var stdPhone = $scope.standardizePhone(phone);
        var regex = /^0(9\d{8}|1\d{9}|[2345678]\d{7,14})$/;
        return stdPhone.match(regex) != null;
    }

    $scope.bytesToSize = function (bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    $scope.standardizePhone = function (phone) {
        if (phone == null) {
            return phone;
        }
        if (!isNaN(phone)) {
            phone = phone.toString();
        }
        //ELSE:
        return phone.replace(/[^0-9]/g, "");
    }

    $scope.getByCode = function (list, code) {
        var retVal = null;
        list.forEach(function (item) {
            if (item.code == code) {
                retVal = item;
            }
        });
        return retVal;
    };

    $scope.getByField = function (list, fieldName, value) {
        var retVal = null;
        list.forEach(function (item) {
            if (item[fieldName] == value) {
                retVal = item;
            }
        });
        return retVal;
    };

    $scope.moneyToString = function (price) {
        if (price == null || price.toString().match(/^\-?[0-9]+(\.[0-9]+)?$/) == null) {
            return "NA";
        }
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
}
