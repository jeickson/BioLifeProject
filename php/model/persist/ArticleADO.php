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
    private static $colNameIdSpecie = "idSpecie";
    private static $colNameName = "name";
    private static $colNameDescCode = "description";
    private static $colNameTypeCode = "type";
    private static $colNameWeightCode = "weight";
    private static $colNameLength = "length";
    
    public function create($entity) {
        
    }

    public function delete($entity) {
        
    }

    public function update($entity) {
        
    }

    public static function findAll() {
        $cons = "select g.id as idCode,g.idSpecie,g.name,g.description,g.type,g.sequence,g.length,g.weight,"
                . "a.* from Contains c,Articles a, GeneticCode g where c.idArticle= a.id AND c.idGeneticCode = g.id";
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
        $idSpecie = $res[ ArticleADO::$colNameIdSpecie];
        $nameCode = $res[ ArticleADO::$colNameName];
        $descCode = $res[ ArticleADO::$colNameDescCode];
        $weightCode = $res[ ArticleADO::$colNameWeightCode];
        $typeCode = $res[ ArticleADO::$colNameTypeCode];
        $legthCode = $res[ ArticleADO::$colNameLength];
        
        $codeObj= new CodeClass();
        $codeObj->setAll($idCode,$idSpecie,$nameCode,$descCode,$typeCode,$legthCode,$weightCode);
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

}
?>
