<?php

define('AX_EMAIL_FIELD',      'http://axschema.org/contact/email');
define('AX_FIRST_NAME_FIELD', 'http://axschema.org/namePerson/first');
define('AX_LAST_NAME_FIELD',  'http://axschema.org/namePerson/last');

include Kohana::find_file('libraries','Auth/OpenID/Consumer');
/**
 * Require the "file store" module, which we'll need to store
 * OpenID information.
 */
include Kohana::find_file('libraries','Auth/OpenID/FileStore');

/**
 * Require the PAPE extension module.
 */
include Kohana::find_file('libraries','Auth/OpenID/PAPE');

include Kohana::find_file('libraries','Auth/OpenID/AX');


class controller_openid extends Controller
{

    public function action_tryAuth()
    {
        $this->session = Session::instance();
        $openid = "https://www.google.com/accounts/o8/id";
        $consumer = $this->getConsumer();

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

        $pape_request = new Auth_OpenID_PAPE_Request(self::$pape_policy_uris);
        if ($pape_request) {
            $auth_request->addExtension($pape_request);
        }

        // Redirect the user to the OpenID server for authentication.
        // Store the token for this authentication so we can verify the
        // response.

        // For OpenID 1, send a redirect.  For OpenID 2, use a Javascript
        // form to send a POST request to the server.
        if ($auth_request->shouldSendRedirect()) {
            $redirect_url = $auth_request->redirectURL($this->getTrustRoot(),$this->getReturnTo());

            // If the redirect URL can't be built, display an error
            // message.
            if (Auth_OpenID::isFailure($redirect_url)) {
                die("Could not redirect to server: " . $redirect_url->message);
            } else {
                // Send redirect.
                $this->request->redirect($redirect_url);
            }
        } else {
            // Generate form markup and render it.
            $form_id = 'openid_message';
            $form_html = $auth_request->htmlMarkup($this->getTrustRoot(), $this->getReturnTo(),
                    false, array('id' => $form_id));

            // Display an error if the form markup couldn't be generated;
            // otherwise, render the HTML.
            if (Auth_OpenID::isFailure($form_html)) {
                die("Could not redirect to server: " . $form_html->message);
            } else {
                $this->request->response = $form_html;
            }
        }
    }

    public function action_finishAuth()
    {
        $consumer = $this->getConsumer();

        // Complete the authentication process using the server's
        // response.
        $return_to = $this->getReturnTo();
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

        $this->session = Session::instance();
        $this->session->regenerate();
        $this->session->set(array(
                    'account_id' => $openid,
                    'account_email' => $openidData[AX_EMAIL_FIELD][0],
                    'account_fname' => @$openidData[AX_FIRST_NAME_FIELD][0],
                    'account_lname' => @$openidData[AX_LAST_NAME_FIELD][0],
        ));

        $location = $this->session->get_once('redirected_from');
        if (!$location) $location = "admin/index";
        url::redirect($location);
    }

    function getStore() {
        static $store;
        if (!isset($store))
        {
            /**
             * This is where the example will store its OpenID information.
             * You should change this path if you want the example store to be
             * created elsewhere.  After you're done playing with the example
             * script, you'll have to remove this directory manually.
             */
            $store_path = "/tmp/_php_consumer_test";

            if (!file_exists($store_path) && !mkdir($store_path)) {
                print "Could not create the FileStore directory '$store_path'. ".
                    " Please check the effective permissions.";
                exit(0);
            }

            $store = new Auth_OpenID_FileStore($store_path);
        }
        return $store;
    }

    function getConsumer() {
        /**
         * Create a consumer object using the store object created
         * earlier.
         */
        $store = $this->getStore();
        return new Auth_OpenID_Consumer($store);
    }

    function getScheme() {
        $scheme = 'http';
        if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
            $scheme .= 's';
        }
        return $scheme;
    }

    function getReturnTo() {
        return url::site('openid/finishAuth');
    }

    function getTrustRoot() {
        return url::site('/');
    }
}
