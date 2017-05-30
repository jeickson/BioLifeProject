<?php
/**
 * Description of MainController
 * @package    Pt4.1
 * @author     Manuel Molina
 * @version    1.0
 * @date: 2017-05-10
*/

require_once "UserController.php";

function is_session_started()
{
	if ( php_sapi_name() !== 'cli' ) {
		if ( version_compare(phpversion(), '5.4.0', '>=') ) {
			return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		} else {
			return session_id() === '' ? FALSE : TRUE;
		}
	}
	return FALSE;
}

if ( is_session_started() === FALSE) session_start();

$outPutData = array();

if ( isset($_REQUEST['controllerType']) ) {
	$action = (int) $_REQUEST['controllerType'];
	switch ( $action )
	{
		case 0:
			$userController = new UserControllerClass( $_REQUEST['action'], $_REQUEST['jsonData'] );
			$outPutData = $userController->doAction();
			break;
		case 1:
				if (isset($_SESSION['connectedUser'])) {
					$applicationController = new ApplicationControllerClass( $_REQUEST['action'], $_REQUEST['jsonData'] );
					$outPutData = $applicationController->doAction();
				}
				break;
		case 2:
				if (isset($_SESSION['connectedUser'])) {
					$reviewController = new ReviewControllerClass( $_REQUEST['action'], $_REQUEST['jsonData'] );
					$outPutData = $reviewController->doAction();
				}
		case 3:
				/*$fileController = new FileControllerClass( $_REQUEST['action'], $_REQUEST['jsonData'] );
				$outPutData = $fileController->doAction();*/
				break;
		default:
			$errors = array();
			$outPutData[0]=false;
			$errors[]="Sorry, there has been an error. Try later";
			$outPutData[]=$errors;
			error_log("MainControllerClass: action not correct, value: ".$_REQUEST['controllerType']);
			break;
	}
}
else
{
	$errors = array();
	$outPutData[0]=false;
	$errors[]="Sorry, there has been an error. Try later";
	error_log("MainControllerClass: action does not exist");
	$outPutData[]=$errors;
}

echo json_encode($outPutData);
?>
