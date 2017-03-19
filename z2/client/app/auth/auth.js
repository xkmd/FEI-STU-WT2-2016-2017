var myApp = angular.module('auth',[]);

myApp.controller('mainCtrl',function($scope, $http,$sce){
    $scope.formType = 'myLogin';
    $http({
        method: "get",
        url: "../server/checksessions.php"
    }).then(function(resp){
        if(resp.data == "home"){
            $scope.loggedOut = 'true';
        }
        else{
            $scope.login = resp.data.username;
            $scope.formType = resp.data.loginType;
            $scope.loggedOut = false;
        }
    });
    
    $scope.email = "";
    $scope.password = "";
    
    $scope.login = "";
    $scope.firstName = "";
    $scope.lastName = "";
    
    $scope.registered = "";
    $scope.history = false;
     
    $scope.stat = {};
    
    $scope.logOut = function(){
        $http({
            method: "get",
            url: "../server/logout.php"
        }).then(function(resp){
            $scope.loggedOut = true;
            $scope.history = false;
            $scope.formType = 'myLogin';
        });
    }
    
    $scope.showHistory = function(){
        $scope.history = true;
        $http({
            method: "post",
            url: "../server/get-history.php",
            data: {login: $scope.login, type: $scope.formType},
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(resp){ 
            if($scope.formType == "myLogin"){
                var temp1 = _.where(resp.data, {login: $scope.login, type: "myRegister"});
                var temp2 = _.where(resp.data, {login: $scope.login, type: $scope.formType});
                $scope.historyRecords = _.union(temp1,temp2);
            }
            else
                $scope.historyRecords = _.where(resp.data, {login: $scope.login, type: $scope.formType});
            $scope.stat = _.groupBy(resp.data, 'type');
        });
    }
    
    $scope.formTypeChange = function(type){
        $scope.formType = type;
        if(type == 'googleLogin')
            $scope.submit(type);
    }
    
    function setPage(resp){
        if(resp.data == "wrongLogin"){
            $scope.loginState = "wrongLogin";
        }
        else if(resp.data == "wrongPass"){
            $scope.loginState = "wrongPass";
        }
        else if(resp.data == "loginOK" || resp.data == "alreadyLoggedIn"){
            $scope.loggedOut = false;
        }
    }
    $scope.submit = function(type){
        var API = type;
        if(type == 'myLogin'){
            $http({
                method: "post",
                url: "../server/" + API + ".php",
                data: {login: $scope.login, password: $scope.password, type: $scope.formType}, 
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            }).then(function(resp){
                setPage(resp);
            });
        }
        else if(type == 'myRegister'){
            $http({
                method: "post",
                url: "../server/" + API + ".php",
                data: {login: $scope.login, password: $scope.password, email: $scope.email, firstName: $scope.firstName, lastName: $scope.lastName, type: $scope.formType},
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            }).then(function(resp){
                if(!resp.data){
                    $scope.formTypeChange('registeredOK');
                }
                else{
                    $scope.formTypeChange('registeredNO');
                }
            });
        } 
        else if(type == 'ldapLogin'){
            $http({
                method: "post",
                url: "../server/" + API + ".php",
                data: {login: $scope.login, password: $scope.password, type: $scope.formType},
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            }).then(function(resp){
                setPage(resp);
            });
        }
        else if(type == 'googleLogin'){
            $http({
                method: "post",
                url: "../server/login_with_google_using_php/index.php",
                data: {type: $scope.formType},
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            }).then(function(resp){
                console.log(resp.data);
                document.getElementById('google').setAttribute('href',resp.data);
                //$scope.google = resp.data;
//                setPage(resp);
            });
        }
    }
});