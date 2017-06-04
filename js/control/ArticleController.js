//JQuery code

 $(document).ready(function(){
     
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("ArticleController",['$scope', '$window', '$cookies','$filter','accessService',function ($scope, $window, $cookies,$filter,accessService){
      
      //Scope
      $scope.articleArray=new Array();
      $scope.articleSelected=new Article();
        //pagination
        $scope.filteredData
	$scope.pageSize = 6;
	$scope.currentPage = 1;
        
        this.loadArticles=function(){
            var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10000,jsonData:JSON.stringify("")});

            this.articleDetailsView=function(article){
               $scope.articleSelected=article;
               $scope.$parent.actionView="articleDetails";
            }
            promise.then(function (outPutData) {
                    if(outPutData[0]=== true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {
                            
                            var code = new Code();
                            code.construct(outPutData[1][i].code.id,outPutData[1][i].code.specie,outPutData[1][i].code.name,
                            outPutData[1][i].code.type,outPutData[1][i].code.length,outPutData[1][i].code.weight);
                            
                            var article = new Article();
                            article.construct(outPutData[1][i].id, outPutData[1][i].title,outPutData[1][i].abstract,
                           outPutData[1][i].status,outPutData[1][i].nickUser,outPutData[1][i].date,code);

                            $scope.articleArray.push(article);
                            
                         }
                         
                         $scope.filteredData = $scope.articleArray;
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
