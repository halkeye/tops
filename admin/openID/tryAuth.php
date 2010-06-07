<?php

require_once "common.php";
session_start();

$openid = "https://www.google.com/accounts/o8/id";
$consumer = getConsumer();

// Begin the OpenID authentication process.
$auth_request = $consumer->begin($openid);

// No auth request means we can't begin OpenID.
if (!$auth_request) {
    die("Authentication error; not a valid OpenID.");
}


// Create AX fetch request
$ax = new Auth_OpenID_AX_FetchRequest;
// Create attribute request object
// See http://code.google.com/apis/accounts/docs/OpenID.html#Parameters for parameters
// Usage: make($type_uri, $count=1, $required=false, $alias=null)
$ax->add(Auth_OpenID_AX_AttrInfo::make(AX_EMAIL_FIELD,2,1, 'email'));
$ax->add(Auth_OpenID_AX_AttrInfo::make(AX_FIRST_NAME_FIELD,1,1, 'firstname'));
$ax->Add(Auth_OpenID_AX_AttrInfo::make(AX_LAST_NAME_FIELD,1,1, 'lastname'));

$auth_request->addExtension($ax);

$pape_request = new Auth_OpenID_PAPE_Request($pape_policy_uris);
if ($pape_request) {
    $auth_request->addExtension($pape_request);
}

// Redirect the user to the OpenID server for authentication.
// Store the token for this authentication so we can verify the
// response.

// For OpenID 1, send a redirect.  For OpenID 2, use a Javascript
// form to send a POST request to the server.
if ($auth_request->shouldSendRedirect()) {
    $redirect_url = $auth_request->redirectURL(getTrustRoot(),
                                               getReturnTo());

    // If the redirect URL can't be built, display an error
    // message.
    if (Auth_OpenID::isFailure($redirect_url)) {
        die("Could not redirect to server: " . $redirect_url->message);
    } else {
        // Send redirect.
        header("Location: ".$redirect_url);
    }
} else {
    // Generate form markup and render it.
    $form_id = 'openid_message';
    $form_html = $auth_request->htmlMarkup(getTrustRoot(), getReturnTo(),
                                           false, array('id' => $form_id));

    // Display an error if the form markup couldn't be generated;
    // otherwise, render the HTML.
    if (Auth_OpenID::isFailure($form_html)) {
        die("Could not redirect to server: " . $form_html->message);
    } else {
        print $form_html;
    }
}