//JQuery code

 $(document).ready(function(){
     
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("BioLifeController",['$scope', '$window', '$cookies','$filter','accessService', 'userConnected','codeCookies',function ($scope, $window, $cookies,$filter, accessService, userConnected,codeCookies){
      $scope.actionView='main';
      $scope.loginView=false;
      $scope.filterAction;
      $scope.user;
      $scope.userlogged=0;
       //Cookie variables 
     $scope.generalName;
        $scope.path = "/";
      $scope.domain;
      $scope.expires;
      $scope.secure;  
      $scope.codeCookiesArray=[];
      //Methods
      /**
		 *@name loadCookiesCode
		 *@desc load all cookies user save previously 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
       $scope.loadCookiesCode=function(){
             var numberCookies = $cookies.get($scope.generalName,{path:$scope.path});

			if(isNaN(numberCookies))
			{
				numberCookies = 0;
			}
             for (var i = 0; i < numberCookies; i++) {
                 
                 
				var cookieContent = $cookies.getObject($scope.generalName+i,{path:$scope.path});

				var codeCookieObj = new Code();
                                   
				codeCookieObj.cookieToObj(cookieContent);
                               
				$scope.codeCookiesArray.push(codeCookieObj);
                                
								
                }
                
                codeCookies.codes=$scope.codeCookiesArray;
         }
      
        /**
                 *@name sessionControl
                 *@desc control the session
                 *@author Luis Jeickson
                 *@version 1.0
                 *@date 25/05/2017
                 *@param <none>
                 *@return <none>
        */
             
        this.sessionControl = function ()
        {
                
            var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:0,action:10030,jsonData:JSON.stringify("")});

            promise.then(function (outPutData) {
                    if(outPutData[0]=== true)
                    {
                             $scope.user = new User();
                                    $scope.user.construct(outPutData[1].nick, outPutData[1].password, outPutData[1].name, outPutData[1].surname,outPutData[1].email,outPutData[1].age,outPutData[1].birthdate,outPutData[1].address,outPutData[1].role);
                                    userConnected.user=$scope.user;
                              $scope.generalName=$scope.user.nick;
                              
                        $scope.loadCookiesCode();
                            $scope.userlogged=1;
                    }
                    else
                    {
                      
                            if(!angular.isArray(outPutData[1]))
                            {
                                    alert("There has been an error in the server, try later");
                            }
                    }
            });


        }
        
        /**
		 *@name asideOpenClose
		 *@desc open/ close  user section 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
       $scope.asideOpenClose=function(){
            
            if(!$scope.loginView){
                $scope.loginView=true;
                $('#divFullContent').addClass('col-sm-9 col-md-9 col-lg-9');
                $('#logo').hide();
                $('#iconsHeaderDiv').removeClass('col-lg-4');
               
                
            }else{
                $scope.loginView=false;
                $('#divFullContent').removeClass('col-sm-9 col-md-9 col-lg-9');
                 $('#logo').show();
                 $('#iconsHeaderDiv').addClass('col-lg-4');
            }
        }
}]);

})();
