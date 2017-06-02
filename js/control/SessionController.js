//Angular code
(function (){

	angular.module('BioLifeApp').controller("SessionController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
		$scope.user = new User();
		$scope.userAction=0;
		$scope.sessionOpened;

		this.sessionControl = function ()
		{

			switch ($scope.userAction)
			{
				//Index.html is executed
				case 0:
					var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:0,action:10030,jsonData:JSON.stringify("")});

					promise.then(function (outPutData) {
						if(outPutData[0]=== true)
						{
								window.open("mainWindow.html", "_self")
						}
						else
						{
							if(!angular.isArray(outPutData[1]))
							{
								alert("There has been an error in the server, try later");
							}
						}
					});
					break;
				//mainWindow.html is executed
				case 1:
					var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:0,action:10030,jsonData:JSON.stringify("")});

					promise.then(function (outPutData) {
						if(outPutData[0]=== true)
						{
								$scope.user.construct(outPutData[1].id, outPutData[1].nick, outPutData[1].password, outPutData[1].name,
									outPutData[1].surname, outPutData[1].email, outPutData[1].age, outPutData[1].birthdate,
									outPutData[1].address, outPutData[1].role);
								$scope.sessionOpened = true;

								userConnected.user = $scope.user;

								var a=1;
						}
						else
						{
							if(angular.isArray(outPutData[1]))
							{
								window.open("index.html", "_self")
							}
							else {alert("There has been an error in the server, try later");}
						}
					});
					break;
				default:
					alert("There has been an error, try later");
					console.log("user action not correcte: "+$scope.userAction);
					break;
			}
			console.log(sessionStorage.userConnected);
		}

		this.logOut = function ()
		{
			//Local session destroy
			var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:0,action:10040,jsonData:JSON.stringify("")});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true) {
					sessionStorage.removeItem("userConnected");
					window.open("index.html", "_self");
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
})();
