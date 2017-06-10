// jQuery code
$(document).ready(function () {
     
    /*-----------------Search-------------------*/
 var submitIcon = $('.searchbox-icon');
            var inputBox = $('.searchbox-input');
            var searchBox = $('.searchbox');
            var isOpen = false;
            submitIcon.click(function(){
                if(isOpen == false){
                    searchBox.addClass('searchbox-open');
                    inputBox.focus();
                    isOpen = true;
                } else {
                    searchBox.removeClass('searchbox-open');
                    inputBox.focusout();
                    isOpen = false;
                }
            });
             submitIcon.mouseup(function(){
                    return false;
                });
            searchBox.mouseup(function(){
                    return false;
                });
            $(document).mouseup(function(){
                    if(isOpen == true){
                        $('.searchbox-icon').css('display','block');
                        submitIcon.click();
                    }
                });
      /*--------------------END------------------------*/
      

   
});
/*
    * @name: buttonUp()
    * @author: Jeicskon Frias Marte
    * @version: 1.0
    * @description: toggle input search
    * @date: 20/03/2017
*/
function buttonUp(){
                var inputVal = $('.searchbox-input').val();
                inputVal = $.trim(inputVal).length;
                if( inputVal !== 0){
                    $('.searchbox-icon').css('display','none');
                } else {
                    $('.searchbox-input').val('');
                    $('.searchbox-icon').css('display','block');
                }
}
/*
    * @name: toggleID()
    * @author: Jeicskon Frias Marte
    * @version: 1.0
    * @description: toggle a element by id
    * @date: 27/05/2017
*/
function toggleID(id){
    
    $('#'+id).toggle();
}

// Angular code
(function(){
  var BioLifeApp =angular.module ("BioLifeApp", ["ng-currency", "ui.bootstrap", "ngCookies",'angularUtils.directives.dirPagination','ngMessages','ngMaterial']);

    //Routes
/* BioLifeApp.config(function($routeProvider) {

    $routeProvider
        .when('/', {
            templateUrl : 'view/templates/main-view.html',
           
        })
        .when('/list/articles', {
            templateUrl : 'view/templates/article-views/articles-view.html',
            controller  : 'ArticleController',
            controllerAs:'ArtCtrl'
           
        })
        .when('/list/articles/:idArticle', {
            templateUrl : 'view/templates/article-views/articleDetails-view.html',
            controller  : 'ArticleController',
            controllerAs:'ArtCtrl'
           
        })
        .otherwise({
            redirectTo: '/'
        });
});*/
 
    //TEMPLATES

    BioLifeApp.directive("cartView", function (){
    return {
      restrict: 'E',
      templateUrl:"view/templates/cart-view.html",
      controller:function(){

      },
      controllerAs: 'cartView'
    };
  });
    BioLifeApp.directive("mainView", function (){
    return {
      restrict: 'E',
      templateUrl:"view/templates/main-view.html",
      controller:function(){

      },
      controllerAs: 'mainView'
    };
  });

   BioLifeApp.directive("contactView", function (){
    return {
      restrict: 'E',
      templateUrl:"view/templates/contact-view.html",
      controller:function(){

      },
      controllerAs: 'contactView'
    };
  });
  
  BioLifeApp.factory('userConnected', function(){

      var user = new User();
      return user;
  });

  BioLifeApp.directive('validFile',function(){
      return {
          require:'ngModel',
          link:function(scope,el,attrs,ctrl){
              ctrl.$setValidity('validFile', el.val() != '');
              //change event is fired when file is selected
              el.bind('change',function(){
                  ctrl.$setValidity('validFile', el.val() != '');
                  scope.$apply(function(){
                      ctrl.$setViewValue(el.val());
                      ctrl.$render();
                  });
              });
          }
      }
  });

  BioLifeApp.factory('accessService', function($http, $log, $q) {
  	return {
  		getData: function(url, async, method, params, data) {
  			var deferred = $q.defer();
  			$http({
  				url: url,
  				method: method,
  				asyn: async,
  				params: params,
  				data: data
  			})
  			.success(function(response, status, headers, config)  {
  				deferred.resolve(response);
  			})
  			.error(function(msg, code) {
  				deferred.reject(msg);
  				$log.error(msg, code);
  				alert("There has been an error in the server, try later");
  			});

  			return deferred.promise;
  		}
  	}
  });

})();
