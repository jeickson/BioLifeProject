//Angular code
(function (){
	angular.module("BioLifeApp").controller("UserController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
                $scope.userlogged=1;
		$scope.userOption=0;
		$scope.user = new User();
		$scope.errorLogIn;

		//Variables for ng-pattern
		$scope.areChars = /^[a-zA-Z\s]*$/;
		$scope.emailFormat = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
		$scope.phoneFormat= /^[0-9]{9,9}$/;
		$scope.onlyNumbers = /[\u0030-\u0039]+/g;

		if (typeof (Storage) == "undefined")
		{
			alert("Your browser is not compatible with sessions, upgrade your browser");
		} else
		{
			if (sessionStorage.length > 0)
			{
				var objAux = JSON.parse(sessionStorage.getItem("userConnected"));

				if (!isNaN(objAux.id))
				{
					$scope.user.construct(objAux.id, objAux.nick, objAux.password, objAux.name, objAux.surname, objAux.email, objAux.age, objAux.birthdate, objAux.address, objAux.role);
				}
			}
		}

		$scope.passwordValid = true;
		$scope.nickValid = true;

		$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
		$scope.format = $scope.formats[0];
		$scope.dateOptions = {
			dateDisabled: "",
			formatYear: 'yyyy',
			maxDate: new Date(),
			minDate: "",
			startingDay: 1
		};

		$scope.birthDate = {
			opened: false
		};

		$scope.openBirthDate = function() {
			$scope.birthDate.opened = true;
		};

		//Methods

		this.connection = function ()
		{
			//copy
			$scope.user = angular.copy($scope.user);

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10000,jsonData:JSON.stringify($scope.user)});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true)
				{
					if (typeof(Storage) !== "undefined") {
						sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
						$scope.user = outPutData[1][0];
						$scope.userlogged=1;
					} else {
						alert("Your browser is not compatible with this application, upgrade it plase!");
					}
				}
				else
				{
					if(angular.isArray(outPutData[1]))
					{
						$scope.errorLogIn = JSON.stringify(outPutData[1])	;
					}
					else {$scope.errorLogIn = "There has been an error in the server, try later";}
				}
			});
		}

		this.Register = function ()
		{
			//copy
			$scope.user = angular.copy($scope.user);
			alert($scope.user);

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10010,jsonData:JSON.stringify($scope.user)});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true)
				{
					if (typeof(Storage) !== "undefined") {
						sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
						$scope.user = outPutData[1][0];
						$scope.userlogged=1;
					} else {
						alert("Your browser is not compatible with this application, upgrade it plase!");
					}
				}
				else
				{
					if(angular.isArray(outPutData[1]))
					{
						alert(outPutData[1]);
					}
					else {alert("There has been an error in the server, try later");}
				}
			});
		}

		this.logOut = function ()
		{

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10040,jsonData:JSON.stringify("")});

			promise.then(function (outPutData) {
				if(outPutData[0] === true)
				{
					if (typeof(Storage) !== "undefined") {
						$scope.userlogged=0;
					} else {
						alert("Your browser is not compatible with this application, upgrade it plase!");
					}
				}
				else
				{
					if(angular.isArray(outPutData[1]))
					{
						alert(outPutData[1]);
					}
					else {alert("There has been an error in the server, try later");}
				}
			});
		}

	}]);

	angular.module('BioLifeApp').directive("userDataManagement", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/user-data-management.html",
			controller:function(){

			},
			controllerAs: 'userDataManagement'
		};
	});

	angular.module('BioLifeApp').directive("registerModal", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/user-views/register-modal.html",
			controller:function(){

			},
			controllerAs: 'registerModal'
		};
	});
})();
