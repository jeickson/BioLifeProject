<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plant
 *
 * @author Frias Marte Jeickson
 */

require_once "LivingBeingsAbstract.php";
class Plant extends  LivingBeingsAbstract{
    //Propierties
    private $divition;
    private $subFamily;
    private $tribe;
    private $gender;
    
    function __construct() {
        parent::__construct();
        
    }
    function getDivition() {
        return $this->divition;
    }

    function getSubFamily() {
        return $this->subFamily;
    }

    function getTribe() {
        return $this->tribe;
    }

    function getGender() {
        return $this->gender;
    }

    function setDivition($divition) {
        $this->divition = $divition;
    }

    function setSubFamily($subFamily) {
        $this->subFamily = $subFamily;
    }

    function setTribe($tribe) {
        $this->tribe = $tribe;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

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
        $data["divition"] = $this->divition;
        $data["subFamily"] = $this->subFamily;
        $data["tribe"] = $this->tribe;
        $data["gender"] = $this->gender;
        return $data;
    }
    public function setAll($id,$name,$type,$classe,$family,$order,$kingdom,$divition,$subFamily,$tribe,$gender) {
        $this->setId($id);
        $this->setName($name);
        $this->setType($type);
        $this->setClasse($classe);
        $this->setFamily($family);
        $this->setOrder($order);
        $this->setKingdom($kingdom);
        $this->setDivition($divition);
        $this->setSubFamily($subFamily);
        $this->setTribe($tribe);
        $this->setGender($gender);
    }
}
