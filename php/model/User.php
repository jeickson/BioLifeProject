<?php

require_once "EntityInterface.php";

class UserClass implements EntityInterface {


    private $id;
    private $nick;
    private $password;
    private $name;
    private $surname;
    private $email;
    private $age;
    private $birthdate;
    private $address;
    private $role;


    //----------Data base Values---------------------------------------;
    private static $tableName = "Users";
    private static $colNameId = "id";
    private static $colNameNick = "nick";
    private static $colNamePassword = "password";
    private static $colNameName = "name";
    private static $colNameSurname = "surname";
    private static $colNameEmail = "email";
    private static $colNameAge = "age";
    private static $colNameBirthdate = "birthdate";
    private static $colNameAddress = "address";
    private static $colNameRole = "role";

    function __construct() {}

    function getId() {
        return $this->id;
    }

    function getNick() {
        return $this->nick;
    }

    function getPassword() {
        return $this->password;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getEmail() {
        return $this->email;
    }

    function getAge() {
        return $this->age;
    }

    function getBirthdate() {
        return $this->birthdate;
    }

    function getAddress() {
        return $this->address;
    }

    function getRole() {
        return $this->role;
    }

    static function getTableName() {
        return self::$tableName;
    }

    static function getColNameId() {
        return self::$colNameId;
    }

    static function getColNameNick() {
        return self::$colNameNick;
    }

    static function getColNamePassword() {
        return self::$colNamePassword;
    }

    static function getColNameName() {
        return self::$colNameName;
    }

    static function getColNameSurname() {
        return self::$colNameSurname;
    }

    static function getColNameEmail() {
        return self::$colNameEmail;
    }

    static function getColNameAge() {
        return self::$colNameAge;
    }

    static function getColNameBirthdate() {
        return self::$colNameBirthdate;
    }

    static function getColNameAddress() {
        return self::$colNameAddress;
    }

    static function getColNameRole() {
        return self::$colNameRole;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setRole($role) {
        $this->role = $role;
    }

    static function setTableName($tableName) {
        self::$tableName = $tableName;
    }

    static function setColNameId($colNameId) {
        self::$colNameId = $colNameId;
    }

    static function setColNameNick($colNameNick) {
        self::$colNameNick = $colNameNick;
    }

    static function setColNamePassword($colNamePassword) {
        self::$colNamePassword = $colNamePassword;
    }

    static function setColNameName($colNameName) {
        self::$colNameName = $colNameName;
    }

    static function setColNameSurname($colNameSurname) {
        self::$colNameSurname = $colNameSurname;
    }

    static function setColNameEmail($colNameEmail) {
        self::$colNameEmail = $colNameEmail;
    }

    static function setColNameAge($colNameAge) {
        self::$colNameAge = $colNameAge;
    }

    static function setColNameBirthdate($colNameBirthdate) {
        self::$colNameBirthdate = $colNameBirthdate;
    }

    static function setColNameAddress($colNameAddress) {
        self::$colNameAddress = $colNameAddress;
    }

    static function setColNameRole($colNameRole) {
        self::$colNameRole = $colNameRole;
    }

    public function getAll() {
  	$data = array();

    $data["id"] = $this->id;
    $data["nick"] = $this->nick;
    $data["password"] = $this->password;
    $data["name"] = $this->name;
    $data["surname"] = $this->surname;
    $data["email"] = $this->email;
    $data["age"] = $this->age;
    $data["birthdate"] = $this->birthdate;
    $data["address"] = $this->address;
    $data["role"] = $this->role;

	return $data;
    }

    public function setAll($id, $nick, $password, $name, $surname, $email, $age, $birthdate, $address, $role) {
      $this->setId($id);
      $this->setNick($nick);
      $this->setPassword($password);
      $this->setName($name);
      $this->setSurname($surname);
      $this->setEmail($email);
      $this->setAge($age);
      $this->setBirthdate($birthdate);
      $this->setAddress($address);
      $this->setRole($role);
    }

    public function toString() {
        $toString = "User[id=" . $this->id . "][name=" . $this->getName(). "][surname=" . $this->getSurname() . "][age=" . $this->age . "][email=" . $this->mail . "][city=".$this->city."][state=".$this->state."][userType=".$this->userType."]";
		return $toString;
    }
}
?>
