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

	$postData = array(
		'name' => $postData->client_name,
		'body' => $postData->versions,
	);

	$bResponse = $oMain->createProjectData($client, $project_id, 'discussions', $postData);

	if($bResponse){
		$response = 'all good';
	}else{
		$response = 'all failed';
	}
}


echo json_encode($postData);