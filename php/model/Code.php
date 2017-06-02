<?php

require_once "EntityInterface.php";
require_once "Specie.php";

class CodeClass implements EntityInterface {


    private $id;
    private $specie;
    private $name;
    private $description;
    private $type;
    private $length;
    private $weight;




    //----------Data base Values Code---------------------------------------;
    private static $tableNameCode = "GeneticCode";
    private static $colNameSpecie = "specie";
    private static $colNameName = "name";
    private static $colNameDesc = "description";
    private static $colNameType = "type";
    private static $colNameWeight = "weight";
    private static $colNameLength = "length";

    function __construct() {
       
    }

    function getId() {
        return $this->id;
    }

    function getSpecie() {
        return $this->specie;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getType() {
        return $this->type;
    }

    function getLength() {
        return $this->length;
    }

    function getWeight() {
        return $this->weight;
    }

    static function getTableNameCode() {
        return self::$tableNameCode;
    }

    static function getColNameSpecie() {
        return self::$colNameSpecie;
    }

    static function getColNameName() {
        return self::$colNameName;
    }

    static function getColNameDesc() {
        return self::$colNameDesc;
    }

    static function getColNameType() {
        return self::$colNameType;
    }

    static function getColNameWeight() {
        return self::$colNameWeight;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSpecie($specie) {
        $this->specie = $specie;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setLength($length) {
        $this->length = $length;
    }

    function setWeight($weight) {
        $this->weight = $weight;
    }

    static function setTableNameCode($tableNameCode) {
        self::$tableNameCode = $tableNameCode;
    }

    static function setColNameSpecie($colNameSpecie) {
        self::$colNameSpecie = $colNameSpecie;
    }

    static function setColNameName($colNameName) {
        self::$colNameName = $colNameName;
    }

    static function setColNameDesc($colNameDesc) {
        self::$colNameDesc = $colNameDesc;
    }

    static function setColNameType($colNameType) {
        self::$colNameType = $colNameType;
    }

    static function setColNameWeight($colNameWeight) {
        self::$colNameWeight = $colNameWeight;
    }



    public function getAll() {
  	$data = array();

        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["description"] = $this->description;
        $data["length"] = $this->length;
        $data["weight"] = $this->weight;
        $data["specie"]= $this->specie;
         $data["type"]= $this->type;
	return $data;
    }

    public function setAll($id,$specie,$name,$description,$type,$length,$weight) {
      $this->setId($id);
       $this->setSpecie($specie);
       $this->setName($name);
       $this->setDescription($description) ;
       $this->setType($type);
       $this->setLength($length);
       $this->setWeight($weight);
    }

    public function toString() {
      
    }
}
?>
