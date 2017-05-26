//JQuery code

 $(document).ready(function(){

});


//Angular code
(function () {
angular.module("BioLifeApp").controller("BioLifeController",['$scope', '$window', '$cookies','$filter',function ($scope, $window, $cookies,$filter){
      $scope.actionView='main';
      $scope.loginView=false;
      
        
       $scope.loginOpenClose=function(){
            
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
