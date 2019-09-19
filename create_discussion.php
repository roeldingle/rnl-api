<?php
require_once('main.php');

echo "test";

return $_POST;



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