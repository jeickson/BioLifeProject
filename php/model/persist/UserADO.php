<?php
/** userClass.php
 * Entity userClass
 * author Luis Jeickson Frias Marte
 * version 2017
 */
require_once "BDDawBio.php";
require_once "EntityInterfaceADO.php";
require_once "../model/User.php";

class UserADO implements EntityInterfaceADO {

    //----------Data base Values---------------------------------------
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

    //---Database management section-----------------------
    /**
	 * fromResultSetList()
	 * this function runs a query and returns an array with all the result transformed into an object
	 * @param res query to execute
	 * @return objects collection
    */
    public static function fromResultSetList( $res ) {
		$entityList = array();
		$i=0;
		foreach ( $res as $row)
		{
			//We get all the values an add into the array
			$entity = UserADO::fromResultSet( $row );

			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    /**
	* fromResultSet()
	* the query result is transformed into an object
	* @param res ResultSet del qual obtenir dades
	* @return object
    */
    public static function fromResultSet( $res ) {
	//We get all the values form the query
		
    $nick = $res[UserADO::$colNameNick];
    $password = $res[UserADO::$colNamePassword];
    $name = $res[UserADO::$colNameName];
    $surname = $res[UserADO::$colNameSurname];
    $email = $res[UserADO::$colNameEmail];
    $age = $res[UserADO::$colNameAge];
    $birthdate = $res[UserADO::$colNameBirthdate];
    $address = $res[UserADO::$colNameAddress];
    $role = $res[UserADO::$colNameRole];

    //Object construction
    $entity = new userClass();
    
    $entity->setNick($nick);
    $entity->setPassword($password);
    $entity->setName($name);
    $entity->setSurname($surname);
    $entity->setEmail($email);
    $entity->setAge($age);
    $entity->setBirthdate($birthdate);
    $entity->setAddress($address);
    $entity->setRole($role);

		return $entity;
    }

    /**
	 * findByQuery()
	 * It runs a particular query and returns the result
	 * @param cons query to run
	 * @return objects collection
    */
    public static function findByQuery( $cons, $vector ) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			echo "Error executing query.";
			error_log("Error executing query in UserADO: " . $e->getMessage() . " ");
			die();
		}

		$res = $conn->execution($cons, $vector);

		return UserADO::fromResultSetList( $res );
    }

    /**
	 * findById()
	 * It runs a query and returns an object array
	 * @param id
	 * @return object with the query results
    */
    public static function findById( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameId." = ?";
		$arrayValues = [$user->getId()];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	 * findlikeName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeName( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameName." like ?";
		$arrayValues = ["%".$user->getName()."%"];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	* findByName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByName( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameName." = ?";
		$arrayValues = [$user->getName()];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	* findByNick()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByNick( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = ?";
		$arrayValues = [$user->getNick()];

		return UserADO::findByQuery($cons,$arrayValues);
    }
    /**
	* findByEmail()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByEmail( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameEmail." = ?";
		$arrayValues = [$user->getEmail()];

		return UserADO::findByQuery($cons,$arrayValues);
    }
    /**
	* findByNickAndPass()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByNickAndPass( $user ) {
		//$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = \"".$user->getNick()."\" and ".UserADO::$colNamePassword." = \"".$user->getPassword()."\"";
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = ? and ".UserADO::$colNamePassword." = ?";
		$arrayValues = [$user->getNick(),$user->getPassword()];

		return UserADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findAll()
	 * It runs a query and returns an object array
	 * @param none
	 * @return object with the query results
    */
    public static function findAll( ) {
    	$cons = "select * from `".UserADO::$tableName."`";
		$arrayValues = [];

		return UserADO::findByQuery( $cons, $arrayValues );
    }


    /**
	 * create()
	 * insert a new row into the database
    */
    public function create($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}
		$cons="insert into ".UserADO::$tableName." (`nick`, `password`, `name`, `surname`, `email`, `age`, `birthdate`, `address`, `role`) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$arrayValues= [$user->getNick(),
                $user->getPassword(),
                $user->getName(),
                $user->getSurname(),
                $user->getEmail(),
                $user->getAge(),
                $user->getBirthdate(),
                $user->getAddress(),
                $user->getRole()];

		$id = $conn->executionInsert($cons, $arrayValues);

		
	   
	}

    /**
	 * delete()
	 * it deletes a row from the database
    */
    public function delete($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}


		$cons="delete from `".UserADO::$tableName."` where ".UserADO::$colNameId." = ?";
		$arrayValues= [$user->getId()];

		$conn->execution($cons, $arrayValues);
    }

    /**
	 * update()
	 * it updates a row of the database
    */
	 public function update($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="update `".UserADO::$tableName."` set ".UserADO::$colNameName." = ?, ".UserADO::$colNameSurname." = ?, ".UserADO::$colNameNick." = ?, ".UserADO::$colNamePassword." = ?, ".UserADO::$colNameAddress." = ?, ".UserADO::$colNameTelephone." = ?, ".UserADO::$colNameMail." = ?, ".UserADO::$colNameBirthDate." = ?, ".UserADO::$colNameEntryDate." = ?, ".UserADO::$colNameDropOutDate." = ?, ".UserADO::$colNameActive." = ?, ".UserADO::$colNameImage." = ?, ".UserADO::$colNameCity." = ?, ".UserADO::$colNameState." = ?, ".UserADO::$colNameUserType." = ?
		where ".UserADO::$colNameId." = ?" ;
		$arrayValues= [$user->getName(),$user->getsurname(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage(),$user->getId(), $user->getCity(), $user->getState(), $user->getUserType()];

		$conn->execution($cons, $arrayValues);
    }
}
?>
