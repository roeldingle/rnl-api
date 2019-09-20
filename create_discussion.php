<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('main.php');

$_POST = file_get_contents('php://input');
$postData = json_decode($_POST);

$account_id = 176953;
$project_id = 1878;

$data = array(
	'company' => 'Straightarrow Corporation',
	'app_name' => 'SA-RNL ActiveCollab automation',
	'email' => 'rmdingle@straightarrow.com.ph',
	'password' => 'rinoayuna12',
);

$oMain = new Main();

$authenticator = $oMain->intializeAuth($data);
$token = $oMain->issueToken($authenticator, $account_id);
$client = $oMain->createClientInstance($token);



if(isset($postData)){


   switch($postData->task_type){
   	case "Combine":
   	$type = "CM";
   	break;

   	case "Load":
   	$type = "LO";
   	break;

   	case "Code":
   	$type = "CO";
   	break;

   	case "E-card":
   	$type = "EC";
   	break;
   }

   $formatedName = $type . '-' . $postData->client_name . '(' . $postData->bu. ')' . '-' .$postData->date_due;

   $formatedBody = '';
   $formatedBody .= '<strong>Client name: </strong>&nbsp;' . $postData->client_name;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Date Requested/Filed: </strong>&nbsp;' . $postData->date_req;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Business/Task type: </strong>&nbsp;' . $postData->bu;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Task Description: </strong>&nbsp;' . $postData->task_type;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Versions: </strong><br />' . $postData->versions;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>File location: </strong><br />' . $postData->file_loc;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Initial Due date: </strong>&nbsp;' . $postData->date_due;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>Special Notes/Instructions: </strong>&nbsp;' . $postData->req_notes;
   $formatedBody .= '<br />'.;
   $formatedBody .= '<strong>RNL Staff: </strong>&nbsp;' . $postData->rnl_staff;
   $formatedBody .= '<br />'.;


	$payload = array(
		'name' => $formatedName,
		'body' => $formatedBody,
	);

	$bResponse = $oMain->createProjectData($client, $project_id, 'discussions', $payload);

	if($bResponse){
		$response = 'all good';
	}else{
		$response = 'all failed';
	}
}


// function formatName($data){
   
//    $html = '';

//    switch($data->task_type){
//    	case "Combine":
//    	$type = "CM";
//    	break;

//    	case "Load":
//    	$type = "LO";
//    	break;

//    	case "Code":
//    	$type = "CO";
//    	break;

//    	case "E-card":
//    	$type = "EC";
//    	break;
//    }

//    $html .= $type . '-' . $data->client_name . '(' . $data->bu. ')' . '-' .$data->date_due;

//    return $html;

// }


// function formatBody($data){
   
//    $html = '';
//    $html .= '<strong>Client name: </strong>&nbsp;' . $data->client_name;
//    $html .= '<br />'.;
//    $html .= '<strong>Date Requested/Filed: </strong>&nbsp;' . $data->date_req;
//    $html .= '<br />'.;
//    $html .= '<strong>Business/Task type: </strong>&nbsp;' . $data->bu;
//    $html .= '<br />'.;
//    $html .= '<strong>Task Description: </strong>&nbsp;' . $data->task_type;
//    $html .= '<br />'.;
//    $html .= '<strong>Versions: </strong><br />' . $data->versions;
//    $html .= '<br />'.;
//    $html .= '<strong>File location: </strong><br />' . $data->file_loc;
//    $html .= '<br />'.;
//    $html .= '<strong>Initial Due date: </strong>&nbsp;' . $data->date_due;
//    $html .= '<br />'.;
//    $html .= '<strong>Special Notes/Instructions: </strong>&nbsp;' . $data->req_notes;
//    $html .= '<br />'.;
//    $html .= '<strong>RNL Staff: </strong>&nbsp;' . $data->rnl_staff;
//    $html .= '<br />'.;

//    return $html;
// }


echo json_encode($response);

/*
http://straightarrow-tech.com:2082/	straigy4	P@ssw0rd12345
*/