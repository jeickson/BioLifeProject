//JQuery code

 $(document).ready(function(){
     
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("ArticleController",['$scope', '$window', '$cookies','$filter','accessService',function ($scope, $window, $cookies,$filter,accessService){
      
      //Scope
      $scope.articleArray=new Array();
      $scope.articleSelected=new Article();
      $scope.specieSelected;
        //pagination
        $scope.filteredData
	$scope.pageSize = 6;
	$scope.currentPage = 1;
        
        this.articleDetailsView=function(article){
               $scope.articleSelected=article;
               $scope.$parent.actionView="articleDetails";
            }
            
        this.specieDetailsView=function(specie){
                $scope.specieSelected=specie;
               $scope.$parent.actionView="specieDetails";

            }    
            
        this.loadArticles=function(){
            var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10000,jsonData:JSON.stringify("")});

            
            promise.then(function (outPutData) {
                    if(outPutData[0]=== true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {
                            
                            
                            var livingBeingObj;
                            
                            if(outPutData[1][i].code.specie.livingBeing.type=='animal'){
                                //if animal
                                var animalObj=new Animal();
                                    animalObj.construct(outPutData[1][i].code.specie.livingBeing.id,outPutData[1][i].code.specie.livingBeing.name,
                                    outPutData[1][i].code.specie.livingBeing.type,outPutData[1][i].code.specie.livingBeing.classe,
                                    outPutData[1][i].code.specie.livingBeing.family,outPutData[1][i].code.specie.livingBeing.order,
                                    outPutData[1][i].code.specie.livingBeing.kingdom,outPutData[1][i].code.specie.livingBeing.superKingdom,
                                    outPutData[1][i].code.specie.livingBeing.subKingdom,outPutData[1][i].code.specie.livingBeing.superEdge,
                                    outPutData[1][i].code.specie.livingBeing.edge,outPutData[1][i].code.specie.livingBeing.subEdge,
                                    outPutData[1][i].code.specie.livingBeing.subClasse,outPutData[1][i].code.specie.livingBeing.subOrder,
                                    outPutData[1][i].code.specie.livingBeing.branch);
                                livingBeingObj=animalObj;
                                
                            }else{
                                //if plant
                                    var plantObj=new Plant();
                                    plantObj.construct(outPutData[1][i].code.specie.livingBeing.id,outPutData[1][i].code.specie.livingBeing.name,
                                    outPutData[1][i].code.specie.livingBeing.type,outPutData[1][i].code.specie.livingBeing.classe,
                                    outPutData[1][i].code.specie.livingBeing.family,outPutData[1][i].code.specie.livingBeing.order,
                                    outPutData[1][i].code.specie.livingBeing.kingdom,outPutData[1][i].code.specie.livingBeing.divition,
                                    outPutData[1][i].code.specie.livingBeing.subFamily,outPutData[1][i].code.specie.livingBeing.tribe,
                                    outPutData[1][i].code.specie.livingBeing.gender);
                                    livingBeingObj=plantObj;
                            } 
                            var specieObj= new Specie();
                                specieObj.construct(outPutData[1][i].code.specie.id,outPutData[1][i].code.specie.name,outPutData[1][i].code.specie.description,livingBeingObj,outPutData[1][i].code.specie.img);

                            var codeObj = new Code();
                                codeObj.construct(outPutData[1][i].code.id,specieObj,outPutData[1][i].code.name,
                                outPutData[1][i].code.type,outPutData[1][i].code.length,outPutData[1][i].code.weight,outPutData[1][i].code.description);


                                var article = new Article();
                                article.construct(outPutData[1][i].id, outPutData[1][i].title,outPutData[1][i].abstract,
                               outPutData[1][i].status,outPutData[1][i].nickUser,outPutData[1][i].date,codeObj);

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
    angular.module("BioLifeApp").directive("specieDetailsView", function (){
        return {
          restrict: 'E',
          templateUrl:"view/templates/article-views/specieDetails-view.html",
          controller:function(){

          },
          controllerAs: 'specieDetailsView'
        };
      });
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
