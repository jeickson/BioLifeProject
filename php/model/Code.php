<?php

require_once "EntityInterface.php";
require_once "Specie.php";

class CodeClass implements EntityInterface {

    //variables
    private $id;
    private $specie;
    private $name;
    private $description;
    private $sequence;
    private $type;
    private $length;
    private $weight;




    //----------Data base Values Code---------------------------------------;
    private static $tableNameCode = "GeneticCode";
    private static $colNameSpecie = "specie";
    private static $colNameSeq = "sequence";
    private static $colNameName = "name";
    private static $colNameDesc = "description";
    private static $colNameType = "type";
    private static $colNameWeight = "weight";
    private static $colNameLength = "length";
    
    //Construct
    function __construct() {
        $this->specie= new SpecieClass();
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
    function getSequence() {
        return $this->sequence;
    }

    static function getColNameSeq() {
        return self::$colNameSeq;
    }

    static function getColNameLength() {
        return self::$colNameLength;
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
    function setSequence($sequence) {
        $this->sequence = $sequence;
    }

    static function setColNameSeq($colNameSeq) {
        self::$colNameSeq = $colNameSeq;
    }

    static function setColNameLength($colNameLength) {
        self::$colNameLength = $colNameLength;
    }

    

    public function getAll() {
  	$data = array();

        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["description"] = $this->description;
        $data["length"] = $this->length;
        $data["weight"] = $this->weight;
        $data["specie"]= $this->specie->getAll();
        $data["type"]= $this->type;
        $data["sequence"]= $this->sequence;
	return $data;
    }

    public function setAll($id,$specie,$name,$description,$type,$length,$weight,$sequence) {
      $this->setId($id);
       $this->setSpecie($specie);
       $this->setName($name);
       $this->setDescription($description) ;
       $this->setType($type);
       $this->setLength($length);
       $this->setWeight($weight);
       $this->setSequence($sequence);
    }

    public function toString() {
      
    }
}
?>
