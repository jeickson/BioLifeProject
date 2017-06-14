//Angular code
(function (){
	angular.module("BioLifeApp").controller("UserController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
                
		$scope.userOption=0;
		$scope.user = new User();
		$scope.errorLogIn;
                $scope.registrationMSSG='';
                $scope.registrationSuccss=false;
                 $scope.registrationErr=false;
		//Variables for ng-pattern
		$scope.areChars = /^[a-zA-Z\s]*$/;
		$scope.emailFormat = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
		$scope.phoneFormat= /^[0-9]{9,9}$/;
		$scope.onlyNumbers = /[\u0030-\u0039]+/g;

		

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
                /**
		 *@name connection
		 *@desc if useris correct then create a session in the server
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
            */
		this.connection = function ()
		{
			//copy
			$scope.user = angular.copy($scope.user);

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10000,jsonData:JSON.stringify($scope.user)});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true)
				{
                                    $scope.user = new User();
                                    var user = new User();
                                    user.construct(outPutData[1].nick, outPutData[1].password, outPutData[1].name, outPutData[1].surname,outPutData[1].email,outPutData[1].age,outPutData[1].birthdate,outPutData[1].address,outPutData[1].role);
                                    userConnected.user=user;
                                    
                                    $scope.$parent.userlogged=1;
                                     location.reload();
				}
				else
				{
                                    
					if(angular.isArray(outPutData[1]))
					{
						$scope.errorLogIn = outPutData[1][0]	;
					}
					else {$scope.errorLogIn = "There has been an error in the server, try later";}
				}
			});
		}
                    /**
		 *@name Register
		 *@desc insert a user in the DB
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
            */
		this.Register = function ()
		{
			

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10010,jsonData:JSON.stringify($scope.user)});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true)
				{           $scope.registrationErr=false;
                                            $scope.registrationSuccss=true;
                                            $scope.registrationMSSG=outPutData[1];	
                                            $scope.user = new User();
                                            $scope.confirmPass="";
                                            $scope.registerForm.$setPristine();
					
				}
				else
				{
					if(angular.isArray(outPutData[1]))
					{
                                            $scope.registrationSuccss=false;
                                            $scope.registrationErr=true;
						$scope.registrationMSSG=outPutData[1][0];
					}
					else {alert("There has been an error in the server, try later");}
				}
			});
		}
                /**
			 *@name logOut
			 *@desc destroies the the session
			 *@author Luis Jeickson
			 *@version 1.0
			 *@date 25/05/2017
			 *@param <none>
			 *@return <none>
		*/
		this.logOut = function ()
		{

			//Server conenction to verify user's data
			var promise = accessService.getData( "php/controllers/MainController.php", true, "POST", {controllerType:0,action:10040,jsonData:JSON.stringify("")});

			promise.then(function (outPutData) {
				if(outPutData[0] === true)
				{
					if (typeof(Storage) !== "undefined") {
                                                $scope.errorLogIn=undefined;
                                                $scope.$parent.actionView="main";
						$scope.$parent.userlogged=0;
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
        //TEMPLATES
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
