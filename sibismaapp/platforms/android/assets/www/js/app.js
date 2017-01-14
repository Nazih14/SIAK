(function() {

    'use strict';
    var module = angular.module('app', ['onsen', 'ngSanitize']);
    var base_url = 'http://sibismaapi.rumahcg.com/';

    module.controller('homeCtrl', function($scope, $http) {
        angular.element(document).ready(function() {
            if (window.localStorage.getItem('is_logged') === 'true') {
                myNavigator.pushPage('start.html', {animation: 'slide'});
            } else {
                myNavigator.pushPage('login.html', {animation: 'slide'});
            }
        });
    });


    module.controller('listCtrl', function($scope, $http) {
        $scope.logout = function() {

            var postData = $.param({
                id: window.localStorage.getItem('id'),
                name: window.localStorage.getItem('name'),
                email: window.localStorage.getItem('email')
            });
            var url = base_url + 'auth/logout';
            $http({
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                url: url,
                data: postData,
            }).
                    success(function(response) {
                myNavigator.pushPage('login.html', {animation: 'slide'});
            }).
                    error(function() {
            });
            window.localStorage.removeItem('id');
            window.localStorage.removeItem('name');
            window.localStorage.removeItem('email');
            window.localStorage.setItem('is_logged', false);
        };
    });

//halaman start
    module.controller('startCtrl', function($scope, $http, $filter) {
        angular.element(document).ready(function() {
            if (window.localStorage.getItem('is_logged') === 'false') {
                myNavigator.pushPage('login.html', {animation: 'slide'});
            }
            $scope.Start = function() {
                myNavigator.pushPage('page.html', {animation: 'lift'});
            }

        });
         $scope.foto = 'https://info.nurulfikri.ac.id/'+window.localStorage.getItem('foto');
    });


    module.controller('pageCtrl', function($scope, $http, $filter) {
        angular.element(document).ready(function() {
            if (window.localStorage.getItem('is_logged') === 'false') {
                myNavigator.pushPage('login.html', {animation: 'slide'});
            }
            $scope.Start = function() {
                myNavigator.pushPage('page.html', {animation: 'lift'});
            }
        });
        $scope.id = window.localStorage.getItem('id');
        $scope.name = window.localStorage.getItem('name');
        $scope.foto = 'https://info.nurulfikri.ac.id/'+window.localStorage.getItem('foto');
        $scope.pob = window.localStorage.getItem('pob');
        $scope.dob = window.localStorage.getItem('dob');
        $scope.statusid = window.localStorage.getItem('statusid');
        $scope.status = window.localStorage.getItem('status');
        $scope.program = window.localStorage.getItem('program');
        $scope.angkatan = window.localStorage.getItem('angkatan');
        $scope.batasstudi = window.localStorage.getItem('batasstudi');
        $scope.email = window.localStorage.getItem('email');
        $scope.prodi = window.localStorage.getItem('prodi');
        $scope.pembimbing = window.localStorage.getItem('pembimbing');
        $scope.agama = window.localStorage.getItem('agama');
        $scope.kelamin = window.localStorage.getItem('kelamin');
        $scope.phone = window.localStorage.getItem('phone');
        $scope.alamat = window.localStorage.getItem('alamat');
        $scope.rt = window.localStorage.getItem('rt');
        $scope.rw = window.localStorage.getItem('rw');
        $scope.pos = window.localStorage.getItem('pos');
        $scope.propinsi = window.localStorage.getItem('propinsi');
        $scope.kota = window.localStorage.getItem('kota');
        $scope.ayah = window.localStorage.getItem('ayah');
        $scope.ibu = window.localStorage.getItem('ibu');
        $scope.hp = window.localStorage.getItem('hp');
    });


    module.controller('LoginCtrl', function($scope, $http) {
        $scope.SignIn = function(user) {
            $scope.hiddenAnimate = true;
            $scope.loginState = false;

            var postData = $.param(user);
            var url = base_url + 'auth/login';
            $http({
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                url: url,
                data: postData,
            }).
                    success(function(response) {
                $scope.hiddenAnimate = false;
                if (response.success === 1) {
                    $scope.contens = response.data;
                    $scope.login.$invalid = false;
                    var contens = response.data;
                    window.localStorage.setItem('is_logged', true);
                    window.localStorage.setItem('id', contens.id);
                    window.localStorage.setItem('name', contens.name);
                    window.localStorage.setItem('email', contens.email);
                    window.localStorage.setItem('foto', contens.foto);
                    window.localStorage.setItem('pob', contens.pob);
                    window.localStorage.setItem('dob', contens.dob);
                    window.localStorage.setItem('statusid', contens.statusid);
                    window.localStorage.setItem('status', contens.status);
                    window.localStorage.setItem('program', contens.program);
                    window.localStorage.setItem('prodi', contens.prodi);
                    window.localStorage.setItem('agama', contens.agama);
                    window.localStorage.setItem('angkatan', contens.angkatan);
                    window.localStorage.setItem('batasstudi', contens.batasstudi);
                    window.localStorage.setItem('pembimbing', contens.pembimbing);
                    window.localStorage.setItem('kelamin', contens.kelamin);
                    window.localStorage.setItem('phone', contens.phone);
                    window.localStorage.setItem('alamat', contens.alamat);
                    window.localStorage.setItem('rt', contens.rt);
                    window.localStorage.setItem('rw', contens.rw);
                    window.localStorage.setItem('pos', contens.pos);
                    window.localStorage.setItem('propinsi', contens.propinsi);
                    window.localStorage.setItem('kota', contens.kota);
                    window.localStorage.setItem('ayah', contens.ayah);
                    window.localStorage.setItem('ibu', contens.ibu);
                    window.localStorage.setItem('hp', contens.hp);
                    myNavigator.pushPage('start.html', {animation: 'slide'});

                } else {
                    $scope.loginState = true;
                }
            }).
                    error(function() {
                $scope.errorState = true;
                $scope.hiddenAnimate = false;
            });
        };
        if (window.localStorage.getItem('is_logged') === 'true') {
            myNavigator.pushPage('start.html', {animation: 'slide'});
        }
        $scope.hiddenError = false;
    });

    document.addEventListener("deviceready", onDeviceReady, false);
    function onDeviceReady() {
        document.addEventListener("backbutton", function(e) {
            navigator.app.exitApp();
        }, false);
    }

    module.filter('htmlToPlaintext', function() {
        return function(text) {
            return text ? String(text).replace(/<[^>]+>/gm, '') : '';
        };
    });

    //Slide navigasi in profile Mahasiswa
     app.controller('slide', function($scope, $http) {

        $('#btn_0').addClass('activebtn');
        setTimeout(function(){
            abc.on('postchange', function(){
                $('.ng-scope ').removeClass('activebtn');
                $('#btn_' + abc.getActiveCarouselItemIndex()).addClass('activebtn');
            });
        }, 400);
    });

     //Modal dialog 
     module.controller('portfoliosController', function($scope){
        $scope.dialogs = {};

        $scope.show = function() {
            ons.createDialog('managePort.html',{parentScope: $scope}).then(function(dialog) {
                dialog.show();
            });
        };
    });

})();

