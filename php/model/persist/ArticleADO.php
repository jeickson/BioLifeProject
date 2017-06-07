<?php
/** ArticleADO.php
 * Entity articleClass
 * author
 * version 2012/09
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
    
     //----------Data base Values Code---------------------------------------
    
    private static $tableNameCode = "GeneticCode";
    private static $tableNameIdCode = "idCode";    
    private static $colNameName = "name";
    private static $colNameDescCode = "descCode";
    private static $colNameTypeCode = "type";
    private static $colNameWeightCode = "weight";
    private static $colNameLength = "length";
    
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
     
    public function create($entity) {
        
    }

    public function delete($entity) {
        
    }

    public function update($entity) {
        
    }

    public static function findByPlants() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "p.divition,p.subFamily,p.tribe,p.gender from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Plants p where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND  l.id=p.idLivingBeing" ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }
     public static function findByAnimals() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type,g.sequence,g.length,g.weight,"
                . "a.*,s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "t.superKingdom,t.subKingdom,t.superEdge,t.edge,t.subEdge,t.subClasse,t.subOrder,t.branch from Contains c,Articles a, GeneticCode g,Specie s,LivingBeings l,Animals t where c.idArticle= a.id AND c.idGeneticCode = g.id "
                . "AND g.idSpecie = s.id AND s.idLivingBeing = l.id AND l.id=t.idLivingBeings " ;
		$arrayValues = [];

         return ArticleADO::findByQuery( $cons, $arrayValues );
    }

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
        $codeObj->setAll($idCode,$specie,$nameCode,$descCode,$typeCode,$legthCode,$weightCode);
        
        $articleObj= new ArticleClass();
        $articleObj->setAll($id, $title, $abstract, $status, $date, $nickUser, $codeObj);
        return $articleObj;
    }

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
