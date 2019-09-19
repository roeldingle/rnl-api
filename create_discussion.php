<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = array(
	'test1' => 'aaaa',
	'test2' => 'bbbb'
);

echo json_encode($data);
 


//require_once('main.php');

//echo "test";
// $_POST = json_decode(file_get_contents('php://input'), true);

// return echo $_POST;



// $account_id = 176953;
// $project_id = 1878;

// $data = array(
// 	'company' => 'Straightarrow Corporation',
// 	'app_name' => 'SA-RNL ActiveCollab automation',
// 	'email' => 'rmdingle@straightarrow.com.ph',
// 	'password' => 'rinoayuna12',
// );

// $oMain = new Main();

// $authenticator = $oMain->intializeAuth($data);
// $token = $oMain->issueToken($authenticator, $account_id);
// $client = $oMain->createClientInstance($token);


// if(isset($_POST)){
// 	$oMain->createProjectData($client, $project_id, 'discussions', $_POST);
// }