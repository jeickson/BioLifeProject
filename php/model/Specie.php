<?php

require_once "EntityInterface.php";


class SpecieClass implements EntityInterface {


    private $id;
    private $name;
    private $description;
    private $idLivingBeing;





    //----------Data base Values Articles---------------------------------------;
    private static $tableNameCode = "Specie";
    private static $colNameId = "id";
    private static $colNameName = "name";
    private static $colNameDesc = "description";
    private static $colNameIdLivingBeing = "idLivingBeing";

    

    function __construct() {}

   
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getIdLivingBeing() {
        return $this->idLivingBeing;
    }

    static function getTableNameCode() {
        return self::$tableNameCode;
    }

    static function getColNameId() {
        return self::$colNameId;
    }

    static function getColNameName() {
        return self::$colNameName;
    }

    static function getColNameDesc() {
        return self::$colNameDesc;
    }

    static function getColNameIdLivingBeing() {
        return self::$colNameIdLivingBeing;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setIdLivingBeing($idLivingBeing) {
        $this->idLivingBeing = $idLivingBeing;
    }

    static function setTableNameCode($tableNameCode) {
        self::$tableNameCode = $tableNameCode;
    }

    static function setColNameId($colNameId) {
        self::$colNameId = $colNameId;
    }

    static function setColNameName($colNameName) {
        self::$colNameName = $colNameName;
    }

    static function setColNameDesc($colNameDesc) {
        self::$colNameDesc = $colNameDesc;
    }

    static function setColNameIdLivingBeing($colNameIdLivingBeing) {
        self::$colNameIdLivingBeing = $colNameIdLivingBeing;
    }



    public function getAll() {
  	$data = array();

        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["description"] = $this->description;
        $data["idLivingBeing"] = $this->idLivingBeing;

	return $data;
    }

    public function setAll($id) {
      $this->setId($id);
      $this->setName($name);
      $this->setDescription($description);
      $this->setIdLivingBeing($idLivingBeing);
    }

    public function toString() {
      
    }
}
?>
