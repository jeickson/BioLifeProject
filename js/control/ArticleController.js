//JQuery code

 $(document).ready(function(){
    
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("ArticleController",['$scope', '$window', '$cookies','$filter','accessService', 'userConnected','codeCookies',function ($scope, $window, $cookies,$filter,accessService,userConnected,codeCookies){
      
    //Scope
    this.user;
    $scope.articleArray=new Array();
    $scope.articleSelected=new Article();
    $scope.specieSelected;
    $scope.codeArray=new Array();  
    $scope.articleNameFilter;
    
    //pagination variables
    $scope.filteredDataArticle;
    $scope.filteredDataCodes;
    $scope.pageSize = 6;
    $scope.currentPage = 1;
    $scope.currentPage2 = 1;
    $scope.pageSize2 = 10;
    
    //datepicker variables
    $scope.myDateFilter;
    this.isOpen = false;
    $scope.myDateFilterFormated;
    
    //Cookie variables      
    $scope.path = "/";
    $scope.domain;
    $scope.expires;
    $scope.secure;  

    $scope.codeCookiesArray=[];
        
        this.loadCodesFromFactory=function(){
            $scope.codeCookiesArray=codeCookies.codes;
        }
        
        this.addCookieCode=function(code){
            
            var find = false;
            
            for(var i=0;i<$scope.$parent.codeCookiesArray.length;i++){
                if($scope.$parent.codeCookiesArray[i].id===code.id){
                    find=true;
                    break;
                }
            }
            if(!find){
                var numberCookies = $cookies.get($scope.$parent.generalName,{path:$scope.path});

			if(isNaN(numberCookies))
			{
				numberCookies = 0;
			}

                $cookies.putObject($scope.$parent.generalName+numberCookies,code,{path:$scope.path});

		$cookies.put($scope.$parent.generalName,++numberCookies,{path:$scope.path});
                $scope.$parent.codeCookiesArray.push(code);
               
            }else{
                alert("this code is already added");
            }
            
        }
        this.delCookieCode=function(index){
           
                //Cookies management
		var numberCookies = $cookies.get($scope.$parent.generalName,{path:$scope.path});

                for (var i = index; i < numberCookies-1; i++)
                {
                        $cookies.putObject($scope.$parent.generalName+i,$cookies.getObject($scope.$parent.generalName+(i+1),{path:$scope.path}),{path:$scope.path});
                }
                //Remove the last cookie
		$cookies.remove($scope.$parent.generalName+(numberCookies-1),{path:$scope.path}); 
                //Update general cookie
                $scope.$parent.codeCookiesArray.splice(index,1);
                if($scope.$parent.codeCookiesArray.length-1==0) {
                        $cookies.remove($scope.$parent.generalName,{path:$scope.path});
                        
                }
                else {
                        numberCookies -= 1;
                        $cookies.put($scope.$parent.generalName,numberCookies,{path:$scope.path});
                }
                
            
        }
        this.articleDetailsView=function(article){
               $scope.articleSelected=article;
               $scope.$parent.actionView="articleDetails";
            }
            
        this.specieDetailsView=function(specie){
                $scope.specieSelected=specie;
               $scope.$parent.actionView="specieDetails";
               

            }
        this.filter=function(){
                    $('.filterable .btn-filter').click(function(){
                var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });

            $('.filterable .filters input').keyup(function(e){
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });
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
                         
                         $scope.filteredDataArticle = $scope.articleArray;
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
            
            $scope.$watch("articleNameFilter+myDateFilterFormated+specieNameFilter+categoryFilter",function () {
                    $scope.filteredDataArticle = $filter('filter')($scope.articleArray,{code:{specie:{name:$scope.specieNameFilter,livingBeing:{type:$scope.categoryFilter}}},date:$scope.myDateFilterFormated,title:$scope.articleNameFilter});
            });
        }
        this.loadCodes=function(){
            $scope.codeArray=[];
           var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10020,jsonData:JSON.stringify("")});

            
            promise.then(function (outPutData) {
                    if(outPutData[0]=== true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {
                            
                            
                            var livingBeingObj;
                            
                            if(outPutData[1][i].specie.livingBeing.type=='animal'){
                                //if animal
                                var animalObj=new Animal();
                                    animalObj.construct(outPutData[1][i].specie.livingBeing.id,outPutData[1][i].specie.livingBeing.name,
                                    outPutData[1][i].specie.livingBeing.type,outPutData[1][i].specie.livingBeing.classe,
                                    outPutData[1][i].specie.livingBeing.family,outPutData[1][i].specie.livingBeing.order,
                                    outPutData[1][i].specie.livingBeing.kingdom,outPutData[1][i].specie.livingBeing.superKingdom,
                                    outPutData[1][i].specie.livingBeing.subKingdom,outPutData[1][i].specie.livingBeing.superEdge,
                                    outPutData[1][i].specie.livingBeing.edge,outPutData[1][i].specie.livingBeing.subEdge,
                                    outPutData[1][i].specie.livingBeing.subClasse,outPutData[1][i].specie.livingBeing.subOrder,
                                    outPutData[1][i].specie.livingBeing.branch);
                                livingBeingObj=animalObj;
                                
                            }else{
                                //if plant
                                    var plantObj=new Plant();
                                    plantObj.construct(outPutData[1][i].specie.livingBeing.id,outPutData[1][i].specie.livingBeing.name,
                                    outPutData[1][i].specie.livingBeing.type,outPutData[1][i].specie.livingBeing.classe,
                                    outPutData[1][i].specie.livingBeing.family,outPutData[1][i].specie.livingBeing.order,
                                    outPutData[1][i].specie.livingBeing.kingdom,outPutData[1][i].specie.livingBeing.divition,
                                    outPutData[1][i].specie.livingBeing.subFamily,outPutData[1][i].specie.livingBeing.tribe,
                                    outPutData[1][i].specie.livingBeing.gender);
                                    livingBeingObj=plantObj;
                            } 
                            var specieObj= new Specie();
                                specieObj.construct(outPutData[1][i].specie.id,outPutData[1][i].specie.name,outPutData[1][i].specie.description,livingBeingObj,outPutData[1][i].specie.img);

                            var codeObj = new Code();
                                codeObj.construct(outPutData[1][i].id,specieObj,outPutData[1][i].name,
                                outPutData[1][i].type,outPutData[1][i].length,outPutData[1][i].weight,outPutData[1][i].description);


                              

                                $scope.codeArray.push(codeObj);
                            
                         }
                         
                         $scope.filteredDataCodes =  $scope.codeArray;
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
        
        this.formateDate=function(){
            if($scope.myDateFilter!=undefined){
                    var dd = $scope.myDateFilter.getDate();
                var mm = $scope.myDateFilter.getMonth()+1; //January is 0!

                var yyyy = $scope.myDateFilter.getFullYear();
                if(dd<10){
                    dd='0'+dd;
                } 
                if(mm<10){
                    mm='0'+mm;
                } 
                $scope.myDateFilterFormated = dd+'-'+mm+'-'+yyyy;
            }else{
                $scope.myDateFilterFormated="";
            }
            
        }
}]);

//TEMPLATES
    angular.module("BioLifeApp").directive("codesView", function (){
        return {
          restrict: 'E',
          templateUrl:"view/templates/article-views/codes-view.html",
          controller:function(){

          },
          controllerAs: 'codesView'
        };
      });
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
