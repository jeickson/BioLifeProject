<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Article.php";
require_once "../model/persist/ArticleADO.php";


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
                            $outPutData = $this->entryArticle();
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


	private function entryArticle(){
	}

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
}
?>
