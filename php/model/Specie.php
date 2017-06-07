<?php

require_once "EntityInterface.php";


class SpecieClass implements EntityInterface {


    private $id;
    private $name;
    private $description;
    private $LivingBeing;
    private $img;




    //----------Data base Values Articles---------------------------------------;
    private static $tableNameCode = "Specie";
    private static $colNameId = "id";
    private static $colNameName = "name";
    private static $colNameDesc = "description";
    private static $colNameIdLivingBeing = "idLivingBeing";
    private static $colNameImg = "img";

    

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

    function getLivingBeing() {
        return $this->LivingBeing;
    }
    function getImg() {
        return $this->img;
    }

    static function getColNameImg() {
        return self::$colNameImg;
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

    function setLivingBeing($LivingBeing) {
        $this->LivingBeing = $LivingBeing;
    }
    function setImg($img) {
        $this->img = $img;
    }

    static function setColNameImg($colNameImg) {
        self::$colNameImg = $colNameImg;
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
        $data["livingBeing"] = $this->LivingBeing->getAll();
        $data["img"]= $this->getImg();
	return $data;
    }

    public function setAll($id,$name,$description,$livingBeing,$img) {
      $this->setId($id);
      $this->setName($name);
      $this->setDescription($description);
      $this->setLivingBeing($livingBeing);
      $this->setImg($img);
    }

    public function toString() {
      
    }
}
?>
