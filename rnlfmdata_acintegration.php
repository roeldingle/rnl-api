<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('main.php');

$_POST = file_get_contents('php://input');
//$postData = json_decode($_POST);

$postData = (object) [];
$postData->task_type = 'Combine';
$postData->client_name = 'CombineCombine';
$postData->date_due = '01/08/2020';
$postData->bu = 'FM';
$postData->file_name = 'dff';
$postData->file_loc = 'dff';
$postData->rnl_staff = 'Angie';
$postData->gen_notes = 'this is a test';


$account_id = 176953;
$project_id = 3671; //SA-RNL Creatives 2020 - activecollab page

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
		'name' => $formatedName,
		'body' => $formatedBody,
	);

	$oMain->createProjectData($client, $project_id, 'discussions', $payload);

	//$bResponse = $oMain->createProjectData($client, $project_id, 'discussions', $payload);

	// if($bResponse){

	// 	$response = array(
	// 		'status' => 'success',
	// 		'data' => $postData
	// 	);
	// }else{
	// 	$response = array(
	// 		'status' => 'failed',
	// 		'data' => $postData
	// 	);
	// }

	// echo json_encode($response);
}




function formatName($data){
   
   switch($data->task_type){
   	case "SaaS":
   	$type = "SaaS";
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

   $html .= '<strong>File name: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n",","),"<br/>",$data->file_name);
   $html .= '<br /><br />';

   $html .= '<strong>File location: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->file_loc);
   $html .= '<br /><br />';

   $html .= '<strong>Initial Due date: </strong>&nbsp;' . $data->date_due;
   $html .= '<br /><br />';

   $html .= '<strong>Special Notes/Instructions: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->req_notes);
   $html .= '<br /><br />';

   $html .= '<strong>RNL Staff: </strong>&nbsp;' . $data->rnl_staff;
   $html .= '<br /><br />';

   if($data->gen_notes != ""){
      $html .= '<strong>Gen Notes: </strong><br />' . str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$data->gen_notes);
   }
   
   $html .= '<br /><br />';


   $html .= '<strong>***</strong>&nbsp;<em>This task request submitted via RNL-SA automation tool</em><strong>***</strong>';
   $html .= '<br /><br />';
   $html .= 'Thank you';

   return $html;
}
/*
straightarrow-tech.com:2082	straigy4	P@ssw0rd12345
git pull https://github.com/roeldingle/rnl-api.git master
*/