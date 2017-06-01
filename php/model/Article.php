<?php

require_once "EntityInterface.php";
require_once "Code.php";
require_once "User.php";

class ArticleClass implements EntityInterface {

//select c.*,g.*,a.* from Contains c,Articles a, GeneticCode g where c.idArticle= a.id AND c.idGeneticCode = g.id
    private $id;
    private $title;
    private $abstract;
    private $status;
    private $user;
    private $date;
    private $code;




    //----------Data base Values Articles---------------------------------------;
    private static $tableNameArticles = "Articles";
    private static $colNameId = "id";
    private static $colNameTitle = "title";
    private static $colNameAbstract = "abstract";
    private static $colNameStatus = "status";
    private static $colNameDate = "date";
    

    function __construct() {
        $this->user= new UserClass();
        $this->code=new CodeClass();
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getAbstract() {
        return $this->abstract;
    }

    function getStatus() {
        return $this->status;
    }

    function getUser() {
        return $this->user;
    }

    function getDate() {
        return $this->date;
    }

    function getCode() {
        return $this->code;
    }

    static function getTableNameArticles() {
        return self::$tableNameArticles;
    }

    static function getColNameId() {
        return self::$colNameId;
    }

    static function getColNameTitle() {
        return self::$colNameTitle;
    }

    static function getColNameAbstract() {
        return self::$colNameAbstract;
    }

    static function getColNameStatus() {
        return self::$colNameStatus;
    }

    static function getColNameDate() {
        return self::$colNameDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setAbstract($abstract) {
        $this->abstract = $abstract;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setCode($code) {
        $this->code = $code;
    }

    static function setTableNameArticles($tableNameArticles) {
        self::$tableNameArticles = $tableNameArticles;
    }

    static function setColNameId($colNameId) {
        self::$colNameId = $colNameId;
    }

    static function setColNameTitle($colNameTitle) {
        self::$colNameTitle = $colNameTitle;
    }

    static function setColNameAbstract($colNameAbstract) {
        self::$colNameAbstract = $colNameAbstract;
    }

    static function setColNameStatus($colNameStatus) {
        self::$colNameStatus = $colNameStatus;
    }

    static function setColNameDate($colNameDate) {
        self::$colNameDate = $colNameDate;
    }

    


    public function getAll() {
  	$data = array();

        $data["id"] = $this->id;
        $data["title"] = $this->title;
        $data["abstract"] = $this->abstract;
        $data["status"] = $this->status;
        $data["date"] = $this->date;
        $data["user"]= $this->user->getAll();

	return $data;
    }

    public function setAll($id,$title,$abstract,$status,$date,$user,$code) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setAbstract($abstract);
        $this->setStatus();
        $this->setDate($date);
        $this->setUser($user);
        $this->setCode($code);
    }

    public function toString() {
      
    }
}
?>
