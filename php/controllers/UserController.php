<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/User.php";
require_once "../model/persist/UserADO.php";


class UserControllerClass implements ControllerInterface {
	private $action;
	private $jsonData;

	function __construct($action, $jsonData) {
		$this->setAction($action);
		$this->setJsonData($jsonData);
    }

    public function getAction() {
        return $this->action;
    }

    public function getJsonData() {
        return $this->jsonData;
    }

    public function setAction($action) {
        $this->action = $action;
    }
    public function setJsonData($jsonData) {
        $this->jsonData = $jsonData;
    }

	public function doAction()
	{
		$outPutData = array();

		switch ( $this->getAction() )
        {
			case 10000:
				$outPutData = $this->userConnection();
				break;
			case 10010:
				$outPutData = $this->entryUser();
				break;
			case 10020:
				if (isset($_SESSION['connectedUser'])) {
					$outPutData = $this->modifyUser();
				}
				break;
			case 10030:
				$outPutData = $this->sessionControl();
				break;
			case 10040:
				//Closing session
				session_unset();
				session_destroy();
				$outPutData[0]=true;
				break;
			case 10050:
				$outPutData = $this->getAllUsers();
				break;
			default:
				$errors = array();
				$outPutData[0]=false;
				$errors[]="Sorry, there has been an error. Try later";
				$outPutData[]=$errors;
				error_log("Action not correct in UserControllerClass, value: ".$this->getAction());
				break;
		}

		return $outPutData;
	}


	private function entryUser()
	{
		$userObj = json_decode(stripslashes($this->getJsonData()));

		$user = new userClass();
		$user->setAll(0, $userObj->nick, $userObj->password, $userObj->name, $userObj->surname, $userObj->email, $userObj->age, $userObj->birthdate, $userObj->address, $userObj->role);

		$outPutData = array();
		$outPutData[]= true;
		$user->setId(UserADO::create($user));

		//the sentence returns de id of the user inserted
		$outPutData[]= array($user->getAll());

		return $outPutData;
	}

	private function modifyUser()
	{
		//Films modification
		$usersArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[]= true;

		foreach($usersArray as $userObj)
		{
		    $user = new userClass();
			$user->setAll($userObj->id, $userObj->name, $userObj->surname1, $userObj->nick, $userObj->password, $userObj->address, $userObj->telephone, $userObj->mail, $userObj->birthDate, $userObj->entryDate, $userObj->dropOutDate, $userObj->active, $userObj->image, $userObj->city, $userObj->state, $userObj->userType);
		    UserADO::update($user);
		}

		return $outPutData;
	}


	private function userConnection()
	{
		$userObj = json_decode(stripslashes($this->getJsonData()));

		$outPutData = array();
		$errors = array();
		$outPutData[0]=true;

		$user = new userClass();
		$user->setNick($userObj->nick);
		$user->setPassword($userObj->password);

		$userList = UserADO::findByNickAndPass($user);

		if (count($userList)==0) {
			$outPutData[0]=false;
			$errors[]="user or password incorrect, please try it again";
			$outPutData[1]=$errors;
		} else {
			$usersArray=array();

			foreach ($userList as $user) {
                           
				$usersArray[] = $user->getAll();
			}

			$_SESSION['connectedUser'] = $userList[0];

			$outPutData[1] = $usersArray[0];
		}

		return $outPutData;
	}

	private function sessionControl()
	{
		$outPutData = array();
		$outPutData[]= true;

		if(isset($_SESSION['connectedUser']))
		{
			$outPutData[]=$_SESSION['connectedUser']->getAll();
		}
		else
		{
			$outPutData[0]=false;
			$errors[]="No session opened";
			$outPutData[1]=$errors;
		}

		return 	$outPutData;
	}

	private function getAllUsers() {
		$outPutData = array();

		$usersArray = UserADO::findAll();

		if(count($usersArray) == 0) {
			$outPutData[]= false;
			$errors = array();
			$errors[]="No reviews found in the database";
			$outPutData[] = $errors;
		} else {
			$outPutData[]= true;
			$usersToLocal = array();
			foreach ($usersArray as $user) {
				$usersToLocal[] = $user->getAll();
			}
			$outPutData[] = $usersToLocal;
		}

		return $outPutData;
	}
}
?>
