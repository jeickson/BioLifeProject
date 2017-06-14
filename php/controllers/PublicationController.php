<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Article.php";
require_once "../model/persist/ArticleADO.php";
require_once "../model/persist/codeADO.php";

class PublicationControllerClass implements ControllerInterface {
	private $action;
	private $jsonData;

   //Contructs
    function __construct($action, $jsonData) {
		$this->setAction($action);
		$this->setJsonData($jsonData);
    }
    
    //Getters And Setters
    public function getAction() {
        return $this->action;
    }

    public function getJsonData() {
        return $this->jsonData;
    }

    public function setAction($action) {
        $this->action = $action;
    }
    public function setJsonData($jsonData) {
        $this->jsonData = $jsonData;
    }

    //Methods
    
    public function doAction()
	{
		$outPutData = array();

		switch ( $this->getAction() )
        {
			case 10000:
                            $outPutData = $this->getAllArticles();
			   break;
				
			case 10010:
                            if (isset($_SESSION['connectedUser'])) {
					 $outPutData = $this->entryArticle();
				}
                           
                            break;
                         case 10020:
                            $outPutData = $this->getAllCodes();
                            break; 
                         case 10030:
                             if ($_SESSION['connectedUser']->getRole()=="moderator") {
                                $outPutData = $this->getAllArticlesNoPub();
                             }
                            break;
                        case 10040:
                             if ($_SESSION['connectedUser']->getRole()=="moderator") {
                                $outPutData = $this->pubArticle();
                             }
                            break;
                        case 10050:
                             if ($_SESSION['connectedUser']->getRole()=="moderator") {
                                $outPutData = $this->delArticle();
                             }
                            break;
			default:
				$errors = array();
				$outPutData[0]=false;
				$errors[]="Sorry, there has been an error. Try later";
				$outPutData[]=$errors;
				error_log("Action not correct in ArticleControllerClass, value: ".$this->getAction());
				break;
		}

		return $outPutData;
	}

    /**Entries a new register of article in the DB
     *  @name entryArticle
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
	private function entryArticle(){
            $articlesArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		
		$articleIds = array();
                $userObj=$_SESSION['connectedUser'];
		foreach ($articlesArray as $article) {
                         $codeObj = new CodeClass();
                         $codeObj->setId($article->code->id);
                         
			$articleObj = new ArticleClass();
			$articleObj->setAll("", $article->title, $article->abstract,0, $article->date, $userObj,$codeObj);
			$articleIds[] =ArticleADO::create($articleObj);

		}
                $outPutData[]= true;
		$outPutData[] = "Article create correctly, now when a moderator approval it this will be publicate, Thanks You!";
		return $outPutData;
	}
         /**Gets all published article from DB
     *  @name getAllArticles
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
	private function getAllArticles() {
		$outPutData = array();
                
                $artAnimals=ArticleADO::findByAnimals();
                $artPlants=ArticleADO::findByPlants();
                $artArray = array_merge($artAnimals,$artPlants);

		if(count($artArray) == 0) {
			$outPutData[]= false;
			$errors = array();
			$errors[]="No articles found in the database";
			$outPutData[] = $errors;
		} else {
			$outPutData[]= true;
			$arToLocal = array();
			foreach ($artArray as $art) {
				$arToLocal[] = $art->getAll();
			}
			$outPutData[] = $arToLocal;
		}

		return $outPutData;
	}
        /**Gets all no published article from DB
     *  @name getAllArticlesNoPub
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
        private function getAllArticlesNoPub() {
		$outPutData = array();
                
                $artAnimals=ArticleADO::findByAnimalsNoPub();
                $artPlants=ArticleADO::findByPlantsNoPub();
                $artArray = array_merge($artAnimals,$artPlants);

		if(count($artArray) == 0) {
			$outPutData[]= false;
			$errors = array();
			$errors[]="No articles to publicate";
			$outPutData[] = $errors;
		} else {
			$outPutData[]= true;
			$arToLocal = array();
			foreach ($artArray as $art) {
				$arToLocal[] = $art->getAll();
			}
			$outPutData[] = $arToLocal;
		}

		return $outPutData;
	}
        /**Gets all codes article from DB
     *  @name getAllCodes
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
        private function getAllCodes() {
		$outPutData = array();
                
                $codeAnimals=codeADO::findByAnimals();
                $codePlants=codeADO::findByPlants();
                $codeArray = array_merge($codeAnimals,$codePlants);

		if(count($codeArray) == 0) {
			$outPutData[]= false;
			$errors = array();
			$errors[]="No Codes found in the database";
			$outPutData[] = $errors;
		} else {
			$outPutData[]= true;
			$codeToLocal = array();
			foreach ($codeArray as $code) {
				$codeToLocal[] = $code->getAll();
			}
			$outPutData[] = $codeToLocal;
		}

		return $outPutData;
	}
        /**Update rows of aarticle to be published
        *  @name pubArticle
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
        private function pubArticle(){
                $articlesArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		
		$articleIds = array();
                $articleObj= new ArticleClass();
                $articleObj->setId($articlesArray[0]->id);
                ArticleADO::updatePub($articleObj);
                
                 $outPutData[]= true;
		$outPutData[] = "Article published correctly";
		return $outPutData;
        }
         /** Delete article of DB
        *  @name delArticle
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>     
      * @return <$outPutData> array with result to be encode
      */
        private function delArticle(){
                $articlesArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		
		$articleIds = array();
                $articleObj= new ArticleClass();
                $articleObj->setId($articlesArray[0]->id);
                ArticleADO::delete($articleObj);
                
                 $outPutData[]= true;
		$outPutData[] = "Article deleted correctly";
		return $outPutData;
        }
}
?>
