//Angular code
(function (){
	angular.module("BioLifeApp").controller("BioToolsController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

                //scope variables
                $scope.actionSelected="fasta";
                
                //Methods
                 /**
		 *@name actionController
		 *@desc according the action user has selected  call diferents functions
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
                this.actionController=function(){
                    switch($scope.actionSelected) {
                         case "fasta":
                              this.createFasta();
                             break;
                         case "alignment":
                             alert("No implemented yet");
                             
                             break;
                         default:
                             alert("invalid option");
                     }
                }
               /**
		 *@name createFasta
		 *@desc sends an array of codes to php and later this return URL of the FASTA just created for downloading
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
            */
                this.createFasta=function(){
                    var jsonData = new Array();
                        var arrayCodes=new Array();
                            arrayCodes=angular.copy($scope.$parent.codeCookiesArray);
                            
                         jsonData.push(arrayCodes);
                         var promise = accessService.getData("../Perl/controller/MainController.pl", true, "GET", {controllerType:0,action:10000,jsonData:JSON.stringify(jsonData)});

                         promise.then(function (outPutData) {
                                 if(outPutData[0]== "1")
                                 {
                                         window.open(window.location.href+outPutData[1],"_blank","width=600,height=500");
                                   
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
