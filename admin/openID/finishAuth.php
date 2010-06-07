<?php
session_start();
session_regenerate_id(TRUE);

require_once "common.php";

$consumer = getConsumer();

// Complete the authentication process using the server's
// response.
$return_to = getReturnTo();
$response = $consumer->complete($return_to);

// Check the response status.
if ($response->status == Auth_OpenID_CANCEL) {
    // This means the authentication was cancelled.
    die('Verification cancelled.');
} else if ($response->status == Auth_OpenID_FAILURE) {
    // Authentication failed; display the error message.
    die("OpenID authentication failed: " . $response->message);
} else if ($response->status != Auth_OpenID_SUCCESS) {
    die("Unknown error: " . $response->status);
}

// This means the authentication succeeded; extract the
// identity URL and Simple Registration data (if it was
// returned).
$openid = $response->getDisplayIdentifier();
$esc_identity = htmlentities($openid);

$pape_resp = Auth_OpenID_PAPE_Response::fromSuccessResponse($response);

$ax = new Auth_OpenID_AX_FetchResponse();
$obj = $ax->fromSuccessResponse($response);
$openidData = $obj->data;

$_SESSION['id'] = $openid;
$_SESSION['email'] = $openidData[AX_EMAIL_FIELD];
$_SESSION['fname'] = @$openidData[AX_FIRST_NAME_FIELD];
$_SESSION['lname'] = @$openidData[AX_LAST_NAME_FIELD];

header('Location: ../index.php');
