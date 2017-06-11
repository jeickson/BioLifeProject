//Angular code
(function (){
	angular.module("BioLifeApp").controller("BioToolsController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
                

	}]);
        //TEMPLATES
	 angular.module("BioLifeApp").directive("cartView", function (){
            return {
              restrict: 'E',
              templateUrl:"view/templates/cart-view.html",
              controller:function(){

              },
              controllerAs: 'cartView'
            };
         });
})();
