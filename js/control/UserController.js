//Angular code
(function (){
	angular.module("BioLifeApp").controller("UserController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
		$scope.userOption=0;
		$scope.user = new User();

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
					$scope.user.construct(objAux.id, objAux.name, objAux.surname1, objAux.nick, objAux.password, objAux.address, objAux.telephone, objAux.mail, new Date(objAux.birthDate), objAux.entryDate, objAux.dropOutDate, objAux.active, objAux.image);
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
		this.userManagement = function ()
		{
			switch ($scope.userOption)
			{
				//User entry: index.html
				case 1:
				var imageFile = $("#imageUser")[0].files[0];

				var imagesArrayToSend = new FormData();
				imagesArrayToSend.append('images[]', imageFile);
				//imagesArrayToSend['images[]']

				$http({
					method: 'POST',
					url: 'php/controller/MainController.php?controllerType=2&action=10010&jsonData=' + $scope.user.getNick(),
					headers: {'Content-Type': undefined},
					data: imagesArrayToSend,
					transformRequest: function (data, headersGetterFunction) {
						return data;
					}
				}).success(function (outPutData) {
					if (outPutData[0] === true) {
						//File uploaded
						$scope.user.setId(0);
						$scope.user.setActive(1);
						$scope.user.setImage(outPutData[1][0]);
						$scope.user = angular.copy($scope.user);

						//Server conenction to verify user's data
						var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:0,action:10010,jsonData:JSON.stringify($scope.user)});

						promise.then(function (outPutData) {
							if(outPutData[0]=== true)
							{
								console.log(outPutData[1]);
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

					} else {
						if (angular.isArray(outPutData[1]))
						{
							showErrors(outPutData[1]);
						} else {
							alert("There has been an error in the server, try later");
						}
					}
				});
				break;
				//user modification: mainWindow.html
				case 2:

				break;
				default:
				alert("There has been an error, try later");
				console.log("user action not correcte: "+$scope.userOption);
				break;
			}
		}


		this.connection = function ()
		{
			//copy
			$scope.user = angular.copy($scope.user);


			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:0,action:10000,jsonData:JSON.stringify($scope.user)});

			promise.then(function (outPutData) {
				console.log(outPutData);
				if(outPutData[0]=== true)
				{
					if (typeof(Storage) !== "undefined") {
						sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
						window.open("mainWindow.html", "_self");
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

		$scope.setFile = function(element) {
			$scope.currentFile = element.files[0];
			var reader = new FileReader();

			reader.onload = function(event) {
				$scope.userImage = event.target.result
				$scope.$apply();
			}

			// when the file is read it triggers the onload event above.
			reader.readAsDataURL(element.files[0]);
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
})();