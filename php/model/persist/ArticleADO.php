<?php
/** ArticleADO.php
 * Entity articleClass
 * @author  Luis Jeickson Frias Marte
 * @version version 2017
 */
require_once "BDDawBio.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Article.php";
require_once "../model/Code.php";
require_once "../model/Specie.php";
require_once "../model/Animal.php";
require_once "../model/Plant.php";

class ArticleADO implements EntityInterfaceADO {

    //----------Data base Values Article---------------------------------------
    private static $tableNameArticles = "Articles";
    private static $colNameId = "id";
    private static $colNameTitle = "title";
    private static $colNameAbstract = "abstract";
    private static $colNameNickUser = "nickUser";
    private static $colNameStatus = "status";
    private static $colNameDate = "date";
    //----------Data base Values Contains---------------------------------------
    private static $tableNameContains = "Contains";
    private static $colNameIdArticleContains = "idArticle";
    private static $colNameIdGenCodeContains = "idGeneticCode";
     //----------Data base Values Code---------------------------------------
    
    private static $tableNameCode = "GeneticCode";
    private static $tableNameIdCode = "idCode";    
    private static $colNameName = "name";
    private static $colNameDescCode = "descCode";
    private static $colNameTypeCode = "typeCode";
    private static $colNameWeightCode = "weight";
    private static $colNameLength = "length";
    private static $colNameSeq = "sequence";
    
     //----------Data base Values Specie---------------------------------------
    private static $tableNameSpecie = "Specie";
    private static $colNameIdSpecie = "idSpecie";
    private static $colNameNameSpecie = "nameSpecie";
    private static $colNameDesSpecie = "description";
    private static $colNameImgSpecie = "img";
    //----------Data base Values LivingBeings-------------------------------------
    private static $tableNameLiving = "LivingBeings";
    private static $colNameIdLiving = "idLivingBeing";
    private static $colNameNameLiving = "nameLivingBeing";
    private static $colNameTypeLiving = "type";
    private static $colNameClasseLiving = "classe";
    private static $colNameFamilyLiving = "family";
    private static $colNameOrderLiving = "order";
    private static $colNameKingdomLiving = "kingdom";
    
    //----------Data base Values Animals-------------------------------------
     private static $tableNameAnimal = "Animals";
     private static $colNameSuperKingdomAnimal = "superKingdom";
     private static $colNameSubKingdomAnimal = "subKingdom";
     private static $colNameSuperEdgeAnimal = "superEdge";
     private static $colNameEdgeAnimal = "edge";
     private static $colNameSubEdgeAnimal = "subEdge";
     private static $colNameSubClasseAnimal = "subClasse";
     private static $colNameSubOrderAnimal = "subOrder";
     private static $colNameBranchAnimal = "branch";
     //----------Data base Values Plants-------------------------------------
     private static $tableNamePlant = "Plants";
     private static $colNameDivitionPlant= "divition";
     private static $colNameSubFamilyPlant = "subFamily";
     private static $colNameTribePlant = "tribe";
     private static $colNameGenderPlant = "gender";
     
     //Methods
     /**Create a new regiter in table Article and Contains
      * @name create
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param  $articleObj objecto article to insert
      * @return $ids ids creates
      */
    public function create($articleObj) {
        //Connection with the database
        try {
          $conn = DBConnect::getInstance();
        }
        catch (PDOException $e) {
          echo "Error connecting database: " . $e->getMessage() . " ";
          error_log("Error in create in ArticleADO: " . $e->getMessage() . " ");
          die();
        }
        $ids=array();
        
        $cons="insert into ".ArticleADO::$tableNameArticles." (`title`,`nickUser`,`abstract`,`status`,`date`) values (?, ?, ?, ?, ?)" ;
        $arrayValues= [$articleObj->getTitle(),$articleObj->getUser()->getNick(), $articleObj->getAbstract(), $articleObj->getStatus(),$articleObj->getDate()];

        $id1 = $conn->executionInsert($cons, $arrayValues);

        $cons2="insert into ".ArticleADO::$tableNameContains." (`idArticle`,`idGeneticCode`) values (?, ?)" ;
        $arrayValues2= [$id1,$articleObj->getCode()->getId()];
        
        $id2 = $conn->executionInsert($cons2, $arrayValues2);
        
        $ids[]=$id1;
        $ids[]=$id2;
        
        return $ids;
    }
    /**deletesregiter in table Article and Contains
     *  @name delete
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param  $articleObj objecto article(id) to delete
      * @return  <none>
      */
    public function delete($articleObj) {
        //Connection with the database
        try {
          $conn = DBConnect::getInstance();
        }
        catch (PDOException $e) {
          echo "Error connecting database: " . $e->getMessage() . " ";
          error_log("Error in delete in ArticleADO: " . $e->getMessage() . " ");
          die();
        }
        $cons="delete from `".ArticleADO::$tableNameContains."` where ".ArticleADO::$colNameIdArticleContains." = ?";
        $arrayValues= [$articleObj->getId()];
        $conn->execution($cons, $arrayValues);
        
        $cons2="delete from `".ArticleADO::$tableNameArticles."` where ".ArticleADO::$colNameId." = ?";
        $arrayValues2= [$articleObj->getId()];

        $conn->execution($cons2, $arrayValues2);
    }

    public function update($entity) {
        
    }
     /**updates necessary rows for an article to be published
     *  @name updatePub
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param  $articleObj objecto article to insert
      * @return <none>
      */
     public function updatePub($articleObj) {
        //Connection with the database
            try {
              $conn = DBConnect::getInstance();
            }
            catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
            }

            $cons="update `".ArticleADO::$tableNameArticles."` set ".ArticleADO::$colNameStatus." = ? where ".ArticleADO::$colNameId." = ?";
            $arrayValues= [1, $articleObj->getId()];

            $conn->execution($cons, $arrayValues);
    }
    /**find alls articles published of plant species 
     *  @name findByPlants
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>
      * @return <none>
      */
    public static function findByPlants() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "p.divition,p.subFamily,p.tribe,p.gender from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Plants p where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND  l.id=p.idLivingBeing AND a.status=1" ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }
     /**find alls articles published of animals specie  
     *  @name findByAnimals
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>
      * @return <none>
      */
     public static function findByAnimals() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "t.superKingdom,t.subKingdom,t.superEdge,t.edge,t.subEdge,t.subClasse,t.subOrder,t.branch from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Animals t where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND l.id=t.idLivingBeings AND a.status=1" ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }
    /**find alls articles no published of plants specie  
     *  @name findByPlantsNoPub
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>
      * @return <none>
      */
    public static function findByPlantsNoPub() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "p.divition,p.subFamily,p.tribe,p.gender from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Plants p where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND  l.id=p.idLivingBeing AND a.status=0" ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }
     /**find alls articles no published of animals specie  
     *  @name findByAnimalsNoPub
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param <none>
      * @return <none>
      */
     public static function findByAnimalsNoPub() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "t.superKingdom,t.subKingdom,t.superEdge,t.edge,t.subEdge,t.subClasse,t.subOrder,t.branch from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Animals t where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND l.id=t.idLivingBeings AND a.status=0" ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }
    /**finds in data base from a query  
     *  @name findByQuery
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param 
        * <cons> query that we want to do in DB
        *<vector> array with values of the prepareStatement 
      * @return <none>
      */
    public static function findByQuery($cons, $vector) {
        try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			echo "Error executing query.";
			error_log("Error executing query in UserADO: " . $e->getMessage() . " ");
			die();
		}

		$res = $conn->execution($cons, $vector);

		return ArticleADO::fromResultSetList( $res );
    }
    /**Create a Object by result of the query previously execute
     *  @name fromResultSet
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param 
        * <res> result of execution of query
      * @return <$articleObj> Object article builded 
      */
    public static function fromResultSet($res) {
        //article
        $id = $res[ ArticleADO::$colNameId];
        $title = $res[ ArticleADO::$colNameTitle];
        $abstract=$res[ArticleADO::$colNameAbstract];
        $status=$res[ArticleADO::$colNameStatus];
        $date=$res[ArticleADO::$colNameDate];
        $nickUser=$res[ArticleADO::$colNameNickUser];
        //code
        $idCode = $res[ ArticleADO::$tableNameIdCode];        
        $nameCode = $res[ ArticleADO::$colNameName];
        $descCode = $res[ ArticleADO::$colNameDescCode];
        $weightCode = $res[ ArticleADO::$colNameWeightCode];
        $typeCode = $res[ ArticleADO::$colNameTypeCode];
        $legthCode = $res[ ArticleADO::$colNameLength];
        $sequence=$res[ArticleADO::$colNameSeq];
        //Specie
        $idSpecie = $res[ ArticleADO::$colNameIdSpecie];
        $nameSpecie = $res[ArticleADO::$colNameNameSpecie];
        $descSpecie = $res[ArticleADO::$colNameDesSpecie];
        $img=$res[ArticleADO::$colNameImgSpecie];
        //LivingBeing
        $idLiving = $res[ ArticleADO::$colNameIdLiving];
        $nameLiving = $res[ArticleADO::$colNameNameLiving];
        $TypeLiving = $res[ArticleADO::$colNameTypeLiving];
        $classeLiving = $res[ArticleADO::$colNameClasseLiving];
        $familyLiving = $res[ArticleADO::$colNameFamilyLiving];
        $orderLiving = $res[ ArticleADO::$colNameOrderLiving];
        $kingdomLiving = $res[ArticleADO::$colNameKingdomLiving];
        
         $animal=new Animal();
         $plant=new Plant();
         if (!strcmp($TypeLiving,"animal")){
             //Animal
             
             $superKingdomAnimal = $res[ArticleADO::$colNameSuperKingdomAnimal];
             $subKingdomAnimal = $res[ArticleADO::$colNameSubKingdomAnimal];
             $superEdgeAnimal = $res[ArticleADO::$colNameSuperEdgeAnimal];
             $edgeAnimal = $res[ArticleADO::$colNameEdgeAnimal];
             $subEdgeAnimal = $res[ArticleADO::$colNameSubEdgeAnimal];
             $subClasseAnimal = $res[ArticleADO::$colNameSubClasseAnimal];
             $subOrderAnimal = $res[ArticleADO::$colNameSubOrderAnimal];
             $branchAnimal = $res[ArticleADO::$colNameBranchAnimal];
             
            
             $animal->setAll($idLiving, $nameLiving, $TypeLiving, $classeLiving, $familyLiving, $orderLiving, $kingdomLiving,
                     $superKingdomAnimal, $subKingdomAnimal, $superEdgeAnimal, $edgeAnimal,$subEdgeAnimal,$subClasseAnimal, $subOrderAnimal, $branchAnimal);
              
         }else{
             //Plant
             $divitionPlant = $res[ ArticleADO::$colNameDivitionPlant];
             $subFamilyPlant = $res[ ArticleADO::$colNameSubFamilyPlant];
             $tribePlant = $res[ ArticleADO::$colNameTribePlant];
             $genderPlant = $res[ ArticleADO::$colNameGenderPlant];
             
             
             $plant->setAll($idLiving, $nameLiving, $TypeLiving, $classeLiving, $familyLiving, $orderLiving, $kingdomLiving,
                     $divitionPlant, $subFamilyPlant, $tribePlant, $genderPlant);
         }
         $specie= new SpecieClass();
         if (!strcmp($TypeLiving,"animal")){
             
             $specie->setAll($idSpecie, $nameSpecie, $descSpecie, $animal,$img);
         }else{
             $specie->setAll($idSpecie, $nameSpecie, $descSpecie, $plant,$img);
         }
        $codeObj= new CodeClass();
        $codeObj->setAll($idCode,$specie,$nameCode,$descCode,$typeCode,$legthCode,$weightCode,$sequence);
        
        $articleObj= new ArticleClass();
        $articleObj->setAll($id, $title, $abstract, $status, $date, $nickUser, $codeObj);
        return $articleObj;
    }
    /**Create a Object by result array of the query previously execute
     *  @name fromResultSetList
      * @author Luis Jeickson Frias Marte
      * @version 1.1
      * @param 
        * <res> result of execution of query
      * @return <$articleObj> Object article builded 
      */
    public static function fromResultSetList($res) {
             $entityList = array();
		$i=0;
		foreach ( $res as $row)
		{
			//We get all the values an add into the array
			$entity = ArticleADO::fromResultSet( $row );

			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    public static function findAll() {
        
    }

}
?>
