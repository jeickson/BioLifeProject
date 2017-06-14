<?php
/**
 * Description of MainController
 * @package    
 * @author Luis Jeickson Frias Marte   
 * @version    1.0
 * @date: 2017-05-10
*/

require_once "UserController.php";
require_once "PublicationController.php";

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
			$publicationController = new PublicationControllerClass( $_REQUEST['action'], $_REQUEST['jsonData'] );
			$outPutData = $publicationController->doAction();
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
