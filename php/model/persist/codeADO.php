<?php
/** codeADO.php
 * Entity articleClass
 * author
 * version 2012/09
 */
require_once "BDDawBio.php";
require_once "EntityInterfaceADO.php";

require_once "../model/Code.php";
require_once "../model/Specie.php";
require_once "../model/Animal.php";
require_once "../model/Plant.php";

class codeADO implements EntityInterfaceADO {

    
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
     
    public function create($entity) {
        
    }

    public function delete($entity) {
        
    }

    public function update($entity) {
        
    }

    public static function findByPlants() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "p.divition,p.subFamily,p.tribe,p.gender from  GeneticCode g,Specie s,LivingBeings l,Plants p where "
                . "g.idSpecie = s.id AND s.idLivingBeing = l.id AND  l.id=p.idLivingBeing" ;
		$arrayValues = [];

         return codeADO::findByQuery( $cons, $arrayValues );
    }
     public static function findByAnimals() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description as descCode,g.type as typeCode,g.sequence,g.length,g.weight,"
                . "s.name as nameSpecie,s.description,s.img,l.id as idLivingBeing,l.name as nameLivingBeing,l.type,l.classe,l.family,l.order,l.kingdom,"
                . "t.superKingdom,t.subKingdom,t.superEdge,t.edge,t.subEdge,t.subClasse,t.subOrder,t.branch from GeneticCode g,Specie s,LivingBeings l,Animals t where "
                . "g.idSpecie = s.id AND s.idLivingBeing = l.id AND l.id=t.idLivingBeings " ;
		$arrayValues = [];

         return codeADO::findByQuery( $cons, $arrayValues );
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

		return codeADO::fromResultSetList( $res );
    }

    public static function fromResultSet($res) {
       
        //code
        $idCode = $res[ codeADO::$tableNameIdCode];        
        $nameCode = $res[codeADO::$colNameName];
        $descCode = $res[codeADO::$colNameDescCode];
        $weightCode = $res[codeADO::$colNameWeightCode];
        $typeCode = $res[codeADO::$colNameTypeCode];
        $legthCode = $res[codeADO::$colNameLength];
        $sequence=$res[codeADO::$colNameSeq];
        //Specie
        $idSpecie = $res[ codeADO::$colNameIdSpecie];
        $nameSpecie = $res[codeADO::$colNameNameSpecie];
        $descSpecie = $res[codeADO::$colNameDesSpecie];
        $img=$res[codeADO::$colNameImgSpecie];
        //LivingBeing
        $idLiving = $res[ codeADO::$colNameIdLiving];
        $nameLiving = $res[codeADO::$colNameNameLiving];
        $TypeLiving = $res[codeADO::$colNameTypeLiving];
        $classeLiving = $res[codeADO::$colNameClasseLiving];
        $familyLiving = $res[codeADO::$colNameFamilyLiving];
        $orderLiving = $res[ codeADO::$colNameOrderLiving];
        $kingdomLiving = $res[codeADO::$colNameKingdomLiving];
        
         $animal=new Animal();
         $plant=new Plant();
         if (!strcmp($TypeLiving,"animal")){
             //Animal
             
             $superKingdomAnimal = $res[codeADO::$colNameSuperKingdomAnimal];
             $subKingdomAnimal = $res[codeADO::$colNameSubKingdomAnimal];
             $superEdgeAnimal = $res[codeADO::$colNameSuperEdgeAnimal];
             $edgeAnimal = $res[codeADO::$colNameEdgeAnimal];
             $subEdgeAnimal = $res[codeADO::$colNameSubEdgeAnimal];
             $subClasseAnimal = $res[codeADO::$colNameSubClasseAnimal];
             $subOrderAnimal = $res[codeADO::$colNameSubOrderAnimal];
             $branchAnimal = $res[codeADO::$colNameBranchAnimal];
             
            
             $animal->setAll($idLiving, $nameLiving, $TypeLiving, $classeLiving, $familyLiving, $orderLiving, $kingdomLiving,
                     $superKingdomAnimal, $subKingdomAnimal, $superEdgeAnimal, $edgeAnimal,$subEdgeAnimal,$subClasseAnimal, $subOrderAnimal, $branchAnimal);
              
         }else{
             //Plant
             $divitionPlant = $res[ codeADO::$colNameDivitionPlant];
             $subFamilyPlant = $res[ codeADO::$colNameSubFamilyPlant];
             $tribePlant = $res[ codeADO::$colNameTribePlant];
             $genderPlant = $res[ codeADO::$colNameGenderPlant];
             
             
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
        
        
        return $codeObj;
    }

    public static function fromResultSetList($res) {
             $entityList = array();
		$i=0;
		foreach ( $res as $row)
		{
			//We get all the values an add into the array
			$entity = codeADO::fromResultSet( $row );

			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    public static function findAll() {
        
    }

}
?>
