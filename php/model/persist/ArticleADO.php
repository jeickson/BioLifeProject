<?php
/** ArticleADO.php
 * Entity articleClass
 * author
 * version 2012/09
 */
require_once "BDDawBio.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Article.php";

class ArticleADO implements EntityInterfaceADO {

    //----------Data base Values Article---------------------------------------
    private static $tableNameArticles = "Articles";
    private static $colNameId = "id";
    private static $colNameTitle = "title";
    private static $colNameAbstract = "abstract";
    private static $colNameStatus = "status";
    private static $colNameDate = "date";
    

    
    public function create($entity) {
        
    }

    public function delete($entity) {
        
    }

    public function update($entity) {
        
    }

    public static function findAll() {
        
    }

    public static function findByQuery($cons, $vector) {
        
    }

    public static function fromResultSet($res) {
        
    }

    public static function fromResultSetList($res) {
        
    }

}
?>
