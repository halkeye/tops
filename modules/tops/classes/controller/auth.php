<?php

class controller_auth extends Controller
{
    protected $session;
    
    function before()
    {
        $this->session = Session::instance();
        return parent::before();
    }
    
    function action_rpx()
    {
        // As copied from http://gist.github.com/291396

        // Below is a very simple PHP 5 script that implements the RPX token URL processing.
        // The code below assumes you have the CURL HTTP fetching library.  

        $rpxApiKey = '2ed37ea8d84eedf0f442d456286f73cd155565a8';  

        if(isset($_POST['token'])) 
        { 

            /* STEP 1: Extract token POST parameter */
            $token = $_POST['token'];

            /* STEP 2: Use the token to make the auth_info API call */
            $post_data = array(
                    'token' => $_POST['token'],
                    'apiKey' => $rpxApiKey,
                    'format' => 'json'
            ); 

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, 'https://rpxnow.com/api/v2/auth_info');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $raw_json = curl_exec($curl);
            curl_close($curl);


            /* STEP 3: Parse the JSON auth_info response */
            $auth_info = json_decode($raw_json, true);

            if ($auth_info['stat'] == 'ok') {

                /* STEP 3 Continued: Extract the 'identifier' from the response */
                $profile = $auth_info['profile'];
                var_dump($profile);
                die();

                $this->session->regenerate();
                $this->session->set('account_id', $profile['identifier']);
                $this->session->set('account_email', isset($profile['email']) ? $profile['email'] : '');
                $this->session->set('account_displayName', isset($profile['displayName']) ? $profile['displayName'] : '');

                /* STEP 4: Use the identifier as the unique key to sign the user into your system.
                   This will depend on your website implementation, and you should add your own
                   code here.
                 */
                $location = $this->session->get('redirected_from');
                $this->session->delete('redirected_from');
                if (!$location) $location = "admin/index";
                $this->request->redirect($location);

                /* an error occurred */
            } else {
                // gracefully handle the error.  Hook this into your native error handling system.
                echo 'An error occured: ' . $auth_info['err']['msg'];
            }
        }
        else
        {
            $this->request->redirect('');
        }
    }
    function action_logout()
    {

        $this->session->destroy();
        $this->request->redirect('');
    }

}
