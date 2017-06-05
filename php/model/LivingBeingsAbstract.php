<?php
abstract class LivingBeingsAbstract
{
    //abstract propierties
   public $id;
   public $name;
   public $type;
   
   public $classe;
   public $family;
   public $order;
   public $kingdom;
   
   //----------Data base Values LivingBeings-------------------------------------
    private static $tableNameLiving = "LivingBeings";
    private static $colNameIdLiving = "id";
    private static $colNameNameLiving = "name";
    private static $colNameTypeLiving = "type";
    private static $colNameClasseLiving = "classe";
    private static $colNameFamilyLiving = "family";
    private static $colNameOrderLiving = "order";
    private static $colNameKingdomLiving = "kingdom";
    
   function __construct() {
       
   }

   //Getters and Setters
   function getId() {
       return $this->id;
   }

   function getName() {
       return $this->name;
   }

   function getType() {
       return $this->type;
   }

   

   function getClasse() {
       return $this->classe;
   }

   function getFamily() {
       return $this->family;
   }

   function getOrder() {
       return $this->order;
   }

   function getKingdom() {
       return $this->kingdom;
   }
   
   static function getTableNameLiving() {
       return self::$tableNameLiving;
   }

   static function getColNameIdLiving() {
       return self::$colNameIdLiving;
   }

   static function getColNameNameLiving() {
       return self::$colNameNameLiving;
   }

   static function getColNameTypeLiving() {
       return self::$colNameTypeLiving;
   }

   static function getColNameClasseLiving() {
       return self::$colNameClasseLiving;
   }

   static function getColNameFamilyLiving() {
       return self::$colNameFamilyLiving;
   }

   static function getColNameOrderLiving() {
       return self::$colNameOrderLiving;
   }

   static function getColNameKingdomLiving() {
       return self::$colNameKingdomLiving;
   }

    
   function setId($id) {
       $this->id = $id;
   }

   function setName($name) {
       $this->name = $name;
   }

   function setType($type) {
       $this->type = $type;
   }

 

   function setClasse($classe) {
       $this->classe = $classe;
   }

   function setFamily($family) {
       $this->family = $family;
   }

   function setOrder($order) {
       $this->order = $order;
   }

   function setKingdom($kingdom) {
       $this->kingdom = $kingdom;
   }
   static function setTableNameLiving($tableNameLiving) {
       self::$tableNameLiving = $tableNameLiving;
   }

   static function setColNameIdLiving($colNameIdLiving) {
       self::$colNameIdLiving = $colNameIdLiving;
   }

   static function setColNameNameLiving($colNameNameLiving) {
       self::$colNameNameLiving = $colNameNameLiving;
   }

   static function setColNameTypeLiving($colNameTypeLiving) {
       self::$colNameTypeLiving = $colNameTypeLiving;
   }

   static function setColNameClasseLiving($colNameClasseLiving) {
       self::$colNameClasseLiving = $colNameClasseLiving;
   }

   static function setColNameFamilyLiving($colNameFamilyLiving) {
       self::$colNameFamilyLiving = $colNameFamilyLiving;
   }

   static function setColNameOrderLiving($colNameOrderLiving) {
       self::$colNameOrderLiving = $colNameOrderLiving;
   }

   static function setColNameKingdomLiving($colNameKingdomLiving) {
       self::$colNameKingdomLiving = $colNameKingdomLiving;
   }


   
   
}
?>
