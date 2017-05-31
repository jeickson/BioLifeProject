//JQuery code

 $(document).ready(function(){
     
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("ArticleController",['$scope', '$window', '$cookies','$filter',function ($scope, $window, $cookies,$filter){
                      
}]);

//TEMPLATES
  angular.module("BioLifeApp").directive("articlesView", function (){
    return {
      restrict: 'E',
      templateUrl:"view/templates/article-views/articles-view.html",
      controller:function(){

      },
      controllerAs: 'articlesView'
    };
  });
  angular.module("BioLifeApp").directive("articleDetailsView", function (){
        return {
          restrict: 'E',
          templateUrl:"view/templates/article-views/articleDetails-view.html",
          controller:function(){

          },
          controllerAs: 'articleDetailsView'
        };
   });
   angular.module("BioLifeApp").directive("articleCreateView", function (){
        return {
          restrict: 'E',
          templateUrl:"view/templates/article-views/articleCreate-view.html",
          controller:function(){

          },
          controllerAs: 'articleCreateView'
        };
    });
      
})();
