//JQuery code

 $(document).ready(function(){
    
});


//Angular code
(function () {
angular.module("BioLifeApp").controller("ArticleController",['$scope', '$window', '$cookies','$filter','accessService', 'userConnected','codeCookies',function ($scope, $window, $cookies,$filter,accessService,userConnected,codeCookies){
      
    //Scope
    this.user;
    $scope.articleArray=new Array();
    $scope.articleArrayNoPub=new Array();
    $scope.articleSelected=new Article();
    $scope.specieSelected;
    $scope.codeArray=new Array();  
    $scope.articleNameFilter;
    $scope.articleNameFilter2;
    $scope.newArticle=new Article();
    
    //pagination variables and filters
     //Articles 
    $scope.filteredDataArticle;
    $scope.filteredDataArticleNoPub;
    $scope.filteredDataCodes;
    $scope.pageSize = 3
    $scope.currentPage = 1;
    $scope.userArticleFilter;
                //Codes
    $scope.currentPage2 = 1;
    $scope.pageSize2 = 10;
         //check
    $scope.pageSize3 = 6;
    $scope.currentPage3 = 1;
    
    
    //datepicker variables
    $scope.myDateFilter;
    $scope.myDateFilter2;
    this.isOpen = false;
    $scope.myDateFilterFormated;
    $scope.myDateFilterFormated2;
    
    
    //Cookie variables      
    $scope.path = "/";
    $scope.domain;
    $scope.expires;
    $scope.secure;  

    $scope.codeCookiesArray=[];
        
        //Methods
        
        /**
		 *@name loadCodesFromFactory
		 *@desc load codes from the factory
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 14/05/2017
		 *@param <none>
		 *@return <none>
	*/
        this.loadCodesFromFactory=function(){
            $scope.codeCookiesArray=codeCookies.codes;
        }
         /**
		 *@name addCookieCode
		 *@desc add a cookie of the code that the user want
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <Code> Obj Code that user want to save
		 *@return <none>
	*/
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
        /**
		 *@name delCookieCode
		 *@desc deletes a cookie from browser of the user
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <index> index in the array of this code
		 *@return <none>
	*/
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
                if($scope.$parent.codeCookiesArray.length==0) {
                        $cookies.remove($scope.$parent.generalName,{path:$scope.path});
                        
                }
                else {
                        numberCookies -= 1;
                        $cookies.put($scope.$parent.generalName,numberCookies,{path:$scope.path});
                }
                
            
        }
          /**
		 *@name articleDetailsView
		 *@desc change the main view and shows information of an article
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <article> object Article that we want to show
		 *@return <none>
	*/
        this.articleDetailsView=function(article){
               $scope.articleSelected=article;
               $scope.$parent.actionView="articleDetails";
            }
         /**
		 *@name specieDetailsView
		 *@desc change the main view and shows information of a Specie
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <specie> object Specie that we want to show
		 *@return <none>
	*/   
        this.specieDetailsView=function(specie){
                $scope.specieSelected=specie;
               $scope.$parent.actionView="specieDetails";
               
            }
            /**
		 *@name filter
		 *@desc disable/active filters (jquery methods) in code table and also filtered according user want
		 *@author Luis Jeickson Frias Marte
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <none> 
		 *@return <none>
	*/ 
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
         /**
		 *@name loadArticles
		 *@desc loads all publicated articles  of the data base  and also active $watch to filter array 
		 *@author Luis Jeickson Frias Marte
		 *@version 2.0
		 *@date 25/05/2017
		 *@param <none> 
		 *@return <none>
	*/
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
                                outPutData[1][i].code.type,outPutData[1][i].code.length,outPutData[1][i].code.weight,
                                outPutData[1][i].code.description,outPutData[1][i].code.sequence);


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
            
            $scope.$watch("userArticleFilter+articleNameFilter+myDateFilterFormated+specieNameFilter+categoryFilter",function () {
                    $scope.filteredDataArticle = $filter('filter')($scope.articleArray,{code:{specie:{name:$scope.specieNameFilter,livingBeing:{type:$scope.categoryFilter}}},date:$scope.myDateFilterFormated,title:$scope.articleNameFilter,user:$scope.userArticleFilter});
            });
        }
        /**
		 *@name loadArticlesNoPub
		 *@desc loads all articles that need approval  also active $watch to filter array 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
         this.loadArticlesNoPub=function(){
            $scope.articleArrayNoPub=new Array();
            var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10030,jsonData:JSON.stringify("")});

            
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
                                outPutData[1][i].code.type,outPutData[1][i].code.length,outPutData[1][i].code.weight,
                                outPutData[1][i].code.description,outPutData[1][i].code.sequence);


                                var article = new Article();
                                article.construct(outPutData[1][i].id, outPutData[1][i].title,outPutData[1][i].abstract,
                               outPutData[1][i].status,outPutData[1][i].nickUser,outPutData[1][i].date,codeObj);

                                $scope.articleArrayNoPub.push(article);
                            
                         }
                         
                         $scope.filteredDataArticleNoPub = $scope.articleArrayNoPub;
                    }
                    else
                    {
                            if(angular.isArray(outPutData[1]))
                            {
                                    
                            }
                            else {alert("There has been an error in the server, try later");}
                    }
            });
            
            $scope.$watch("articleNameFilter+myDateFilterFormated2+specieNameFilter2+categoryFilter2",function () {
                    $scope.filteredDataArticleNoPub = $filter('filter')($scope.articleArrayNoPub,{code:{specie:{name:$scope.specieNameFilter2,livingBeing:{type:$scope.categoryFilter2}}},date:$scope.myDateFilterFormated2,title:$scope.articleNameFilter});
            });
        }
        /**
		 *@name loadCodes
		 *@desc loads all codes 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
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
                                outPutData[1][i].type,outPutData[1][i].length,outPutData[1][i].weight,outPutData[1][i].description,
                                outPutData[1][i].sequence);


                              

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
          /**
		 *@name formateDate
		 *@desc convert in format of the datepicker filter to format use in publicated articles
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
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
        /**
		 *@name formateDate2
		 *@desc convert in format of the datepicker filter to format use in no publicated articles
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
         this.formateDate2=function(){
            if($scope.myDateFilter2!=undefined){
                    var dd = $scope.myDateFilter2.getDate();
                var mm = $scope.myDateFilter2.getMonth()+1; //January is 0!

                var yyyy = $scope.myDateFilter2.getFullYear();
                if(dd<10){
                    dd='0'+dd;
                } 
                if(mm<10){
                    mm='0'+mm;
                } 
                $scope.myDateFilterFormated2 = dd+'-'+mm+'-'+yyyy;
            }else{
                $scope.myDateFilterFormated2="";
            }
            
        }
        /**
		 *@name createArticle
		 *@desc sends a json date of a an article to save with php 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <none> 
		 *@return <none>
	*/
        this.createArticle=function(){
            var jsonData= new Array();
            $scope.newArticle.setDate(this.currentDate());
            if($scope.newArticle.code.id != undefined){
                jsonData.push($scope.newArticle);
                    var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10010,jsonData:JSON.stringify(jsonData)});

                    promise.then(function (outPutData) {
                            if(outPutData[0]=== true)
                            {

                                            $scope.createArtErr=false;
                                            $scope.createArtSuccss=true;
                                            $scope.createArtMSSG=outPutData[1];	
                                            $scope.newArticle = new User();
                                            $scope.articleCreateForm.$setPristine();
                                   


                            }
                            else
                            {
                                    if(angular.isArray(outPutData[1]))
                                    {
                                            $scope.createArtSuccss=false;
                                            $scope.createArtErr=true;
						$scope.createArtMSSG="Error introducing new article";
                                    }
                                    else {alert("There has been an error in the server, try later");}
                            }
                    });  
            }else{
                alert("this sequence is not available");
            }
            
           
        }
         /**
		 *@name approvalArticle
		 *@desc sends id of the article we want to publicate and later php updates rows to be publicate
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <id> id of the article we want to publicate 
		 *@return <none>
	*/
        this.approvalArticle=function(id){
            if(confirm("are you sure yo want to publicate this article?")){
                var ArticleToPub= new Article();
                ArticleToPub.setId(id);
                var jsonData= new Array();
                jsonData.push(ArticleToPub);
                    var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10040,jsonData:JSON.stringify(jsonData)});

                    promise.then(function (outPutData) {
                            if(outPutData[0]=== true)
                            {

                                 
                                $scope.optionArtErr=false;
                                $scope.optionArtSuccss=true;
                                $scope.optionArtMSSG=outPutData[1];	



                            }
                            else
                            {
                                    if(angular.isArray(outPutData[1]))
                                    {
                                            $scope.optionArtSuccss=false;
                                            $scope.optionArtErr=true;
						$scope.optionArtMSSG="Error publishing this article";
                                    }
                                    else {alert("There has been an error in the server, try later");}
                            }
                    });  
               
            }
        }
        /**
		 *@name delArticle
		 *@desc sends id of the article we want to delete 
		 *@author Luis Jeickson Frias Marte
		 *@version 1.5
		 *@date 30/05/2017
		 *@param <id> id of the article we want to delete 
		 *@return <none>
	*/
        this.delArticle=function(id){
            if(confirm("are you sure yo want to delete this article?")){
                var ArticleToDel= new Article();
                ArticleToDel.setId(id);
                var jsonData= new Array();
                jsonData.push(ArticleToDel);
                    var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1,action:10050,jsonData:JSON.stringify(jsonData)});

                    promise.then(function (outPutData) {
                            if(outPutData[0]=== true)
                            {

                                 
                               
                                alert("Delete successful");
                                    location.reload();


                            }
                            else
                            {
                                    if(angular.isArray(outPutData[1]))
                                    {
                                           
                                    }
                                    else {alert("There has been an error in the server, try later");}
                            }
                    });  
               
            }
        }
        /**
		 *@name currentDate
		 *@desc calculate current date
		 *@author Luis Jeickson
		 *@version 1.0
		 *@date 25/05/2017
		 *@param <none>
		 *@return current date
	*/
        this.currentDate=function(){
                 var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();

                if(dd<10) {
                    dd='0'+dd
                } 

                if(mm<10) {
                    mm='0'+mm
                } 

                today = dd+'-'+mm+'-'+yyyy;
                return today;
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
  angular.module("BioLifeApp").directive("articlesNoPubView", function (){
    return {
      restrict: 'E',
      templateUrl:"view/templates/article-views/articlesNoPub-view.html",
      controller:function(){

      },
      controllerAs: 'articlesNoPubView'
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
