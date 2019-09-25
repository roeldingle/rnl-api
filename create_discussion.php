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
   
   
   $formatedName =  formatName($postData);
   $formatedBody = formatBody($postData);

	$payload = array(
		'name' => '[TEST] ' . $formatedName,
		'body' => $formatedBody,
	);

	$bResponse = $oMain->createProjectData($client, $project_id, 'discussions', $payload);

	if($bResponse){

		$response = array(
			'status' => 'success',
			'data' => $postData
		);
	}else{
		$response = array(
			'status' => 'failed',
			'data' => $postData
		);
	}

	echo json_encode($response);
}




function formatName($data){
   
   switch($data->task_type){
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

   	default:
   	$type = "";
   }

   $html =  $type . ' - ' . $data->client_name . ' (' . $data->bu. ')' . ' - ' . substr($data->date_due, 0, -5);

   return $html;

}


function formatBody($data){
   
   $html = '';
   $html .= '<strong>Client name: </strong>&nbsp;' . $data->client_name;
   $html .= '<br /><br />';

   $html .= '<strong>Date Requested/Filed: </strong>&nbsp;' . $data->date_req;
   $html .= '<br /><br />';

   $html .= '<strong>Business/Task type: </strong>&nbsp;' . $data->bu;
   $html .= '<br /><br />';

   $html .= '<strong>Task Description: </strong>&nbsp;' . $data->task_type;
   $html .= '<br /><br />';

   $html .= '<strong>Versions: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->versions);
   $html .= '<br /><br />';

   $html .= '<strong>File location: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->file_loc);
   $html .= '<br /><br />';

   $html .= '<strong>Initial Due date: </strong>&nbsp;' . $data->date_due;
   $html .= '<br /><br />';

   $html .= '<strong>Special Notes/Instructions: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->req_notes);
   $html .= '<br /><br />';

   $html .= '<strong>RNL Staff: </strong>&nbsp;' . $data->rnl_staff;
   $html .= '<br /><br />';

   $html .= '<strong>Gen Notes: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->gen_notes);
   $html .= '<br /><br />';


   $html .= 'This task request submitted via RNL-SA automation tool';
   $html .= '<br /><br />';
   $html .= 'Thank you';

   return $html;
}
/*
straightarrow-tech.com:2082	straigy4	P@ssw0rd12345
git pull https://github.com/roeldingle/rnl-api.git master
*/