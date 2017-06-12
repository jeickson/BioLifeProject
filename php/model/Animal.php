<?php


/**
 * Description of Animal
 *
 * @author Luis Jeickson Frias Marte
 */

require_once "LivingBeingsAbstract.php";

class Animal extends LivingBeingsAbstract{
    //Propiesties
    
    private $superKingdom;
    private $subKingdom;
    private $superEdge;
    private $edge;
    private $subEdge;
    private $subClasse;
    private $subOrder;
    private $branch;
    
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
    
    //construct
    function __construct() {
        parent::__construct();
    }

   //Getters And Setters
   function getSuperKingdom() {
       return $this->superKingdom;
   }

   function getSubKingdom() {
       return $this->subKingdom;
   }

   function getSuperEdge() {
       return $this->superEdge;
   }

   function getEdge() {
       return $this->edge;
   }

   function getSubEdge() {
       return $this->subEdge;
   }

   function getSubClasse() {
       return $this->subClasse;
   }

   function getSubOrder() {
       return $this->subOrder;
   }

   function getBranch() {
       return $this->branch;
   }

   static function getTableNameAnimal() {
       return self::$tableNameAnimal;
   }

   static function getColNameSuperKingdomAnimal() {
       return self::$colNameSuperKingdomAnimal;
   }

   static function getColNameSubKingdomAnimal() {
       return self::$colNameSubKingdomAnimal;
   }

   static function getColNameSuperEdgeAnimal() {
       return self::$colNameSuperEdgeAnimal;
   }

   static function getColNameEdgeAnimal() {
       return self::$colNameEdgeAnimal;
   }

   static function getColNameSubEdgeAnimal() {
       return self::$colNameSubEdgeAnimal;
   }

   static function getColNameSubClasseAnimal() {
       return self::$colNameSubClasseAnimal;
   }

   static function getColNameSubOrderAnimal() {
       return self::$colNameSubOrderAnimal;
   }

   static function getColNameBranchAnimal() {
       return self::$colNameBranchAnimal;
   }

   function setSuperKingdom($superKingdom) {
       $this->superKingdom = $superKingdom;
   }

   function setSubKingdom($subKingdom) {
       $this->subKingdom = $subKingdom;
   }

   function setSuperEdge($superEdge) {
       $this->superEdge = $superEdge;
   }

   function setEdge($edge) {
       $this->edge = $edge;
   }

   function setSubEdge($subEdge) {
       $this->subEdge = $subEdge;
   }

   function setSubClasse($subClasse) {
       $this->subClasse = $subClasse;
   }

   function setSubOrder($subOrder) {
       $this->subOrder = $subOrder;
   }

   function setBranch($branch) {
       $this->branch = $branch;
   }
   static function setTableNameAnimal($tableNameAnimal) {
       self::$tableNameAnimal = $tableNameAnimal;
   }

   static function setColNameSuperKingdomAnimal($colNameSuperKingdomAnimal) {
       self::$colNameSuperKingdomAnimal = $colNameSuperKingdomAnimal;
   }

   static function setColNameSubKingdomAnimal($colNameSubKingdomAnimal) {
       self::$colNameSubKingdomAnimal = $colNameSubKingdomAnimal;
   }

   static function setColNameSuperEdgeAnimal($colNameSuperEdgeAnimal) {
       self::$colNameSuperEdgeAnimal = $colNameSuperEdgeAnimal;
   }

   static function setColNameEdgeAnimal($colNameEdgeAnimal) {
       self::$colNameEdgeAnimal = $colNameEdgeAnimal;
   }

   static function setColNameSubEdgeAnimal($colNameSubEdgeAnimal) {
       self::$colNameSubEdgeAnimal = $colNameSubEdgeAnimal;
   }

   static function setColNameSubClasseAnimal($colNameSubClasseAnimal) {
       self::$colNameSubClasseAnimal = $colNameSubClasseAnimal;
   }

   static function setColNameSubOrderAnimal($colNameSubOrderAnimal) {
       self::$colNameSubOrderAnimal = $colNameSubOrderAnimal;
   }

   static function setColNameBranchAnimal($colNameBranchAnimal) {
       self::$colNameBranchAnimal = $colNameBranchAnimal;
   }

    //Methods
   //Methods
    public function getAll() {
        $data = array();

        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["type"] = $this->type;
        $data["classe"] = $this->classe;
        $data["family"] = $this->family;
        $data["order"] = $this->order;
        $data["kingdom"] = $this->kingdom;
        $data["superKingdom"] = $this->superKingdom;
        $data["subKingdom"] = $this->subKingdom;
        $data["superEdge"] = $this->superEdge;
        $data["edge"] = $this->edge;
        $data["subEdge"] = $this->subEdge;
        $data["subClasse"] = $this->subClasse;
        $data["subOrder"] = $this->subOrder;
        $data["branch"] = $this->branch;
        
        return $data;
    }
    public function setAll($id,$name,$type,$classe,$family,$order,$kingdom,$superKingdom,$subKingdom,$superEdge,$edge,$subEdge,$subClasse,$subOrder,$branch) {
        $this->setId($id);
        $this->setName($name);
        $this->setType($type);
        $this->setClasse($classe);
        $this->setFamily($family);
        $this->setOrder($order);
        $this->setKingdom($kingdom);
        $this->setSuperKingdom($superKingdom);
        $this->setSubKingdom($subKingdom);
        $this->setSuperEdge($superEdge);
        $this->setSubEdge($subEdge);
        $this->setEdge($edge);
        $this->setSubClasse($subClasse);
        $this->setSubOrder($subOrder);
        $this->setBranch($branch);
    }

}
