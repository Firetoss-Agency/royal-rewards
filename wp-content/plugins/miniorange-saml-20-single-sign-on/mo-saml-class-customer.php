<?php
/** miniOrange SAML 2.0 SSO enables user to perform Single Sign On with any SAML 2.0 enabled Identity Provider.
 Copyright (C) 2015  miniOrange

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>
 * @package 		miniOrange SAML 2.0 SSO
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/**
 * This library is miniOrange Authentication Service.
 *
 * Contains Request Calls to Customer service.
 *
 *
 * wp_remote_post($url, $args) : Retrieve the raw response from the HTTP request using the POST method.
 * @param string $url  Site URL to retrieve.
 * @param array  $args Optional. Request arguments. Default empty array.
 * @return WP_Error|array The response or WP_Error on failure.
 *
 * $args : Array or string of HTTP request arguments.
 * @type string         method             Request method. Accepts 'GET', 'POST', 'HEAD', or 'PUT'.
 *                                         Some transports technically allow others, but should not be
 *                                         assumed. Default 'GET'.
 * @type string|array   body               Body to send with the request. Default null.
 * @type int            timeout            How long the connection should stay open in seconds. Default 5.
 * @type int            redirection        Number of allowed redirects. Not supported by all transports
 *                                         Default 5.
 * @type string         httpversion        Version of the HTTP protocol to use. Accepts '1.0' and '1.1'.
 *                                         Default '1.0'.
 * @type bool           blocking           Whether the calling code requires the result of the request.
 *                                         If set to false, the request will be sent to the remote server,
 *                                         and processing returned to the calling code immediately, the caller
 *                                         will know if the request succeeded or failed, but will not receive
 *                                         any response from the remote server. Default true.
 * @type string|array   headers            Array or string of headers to send with the request.
 *                                         Default empty array
 */
require_once dirname( __FILE__ ) . '/includes/lib/mo-options-enum.php';
include_once 'Utilities.php';

class Customersaml {
	public $email;
	public $phone;

	/*
	 * * Initial values are hardcoded to support the miniOrange framework to generate OTP for email.
	 * * We need the default value for creating the first time,
	 * * As we don't have the Default keys available before registering the user to our server.
	 * * This default values are only required for sending an One Time Passcode at the user provided email address.
	 */
    private $defaultCustomerKey = "16555";
    private $defaultApiKey = "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";

	function create_customer() {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/rest/customer/add';

		$current_user = wp_get_current_user();
		$this->email = get_option ( 'mo_saml_admin_email' );
		$password = get_option ( 'mo_saml_admin_password' );

		$fields = array (
				'areaOfInterest' => 'WP miniOrange SAML 2.0 SSO Plugin',
				'email' => $this->email,
				'password' => $password
		);
		$field_string = json_encode ( $fields );

		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");

		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}

	function get_customer_key() {
		$url = mo_options_plugin_constants::HOSTNAME . "/moas/rest/customer/key";

		$email = get_option ( "mo_saml_admin_email" );

		$password = get_option ( "mo_saml_admin_password" );

		$fields = array (
				'email' => $email,
				'password' => $password
		);
		$field_string = json_encode ( $fields );

		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function check_customer() {
		$url = mo_options_plugin_constants::HOSTNAME . "/moas/rest/customer/check-if-exists";

		$email = get_option ( "mo_saml_admin_email" );

		$fields = array (
				'email' => $email
		);
		$field_string = json_encode ( $fields );

		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function send_otp_token($email, $phone, $sendToEmail = TRUE, $sendToPhone = FALSE) {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/api/auth/challenge';
		$customerKey = $this->defaultCustomerKey;
		$apiKey = $this->defaultApiKey;

		//$username = get_option ( 'mo_saml_admin_email' );

		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		//$currentTimeInMillis = round ( microtime ( true ) * 1000 );
		$currentTimeInMillis = self::get_timestamp();

		/* Creating the Hash using SHA-512 algorithm */
		//$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$stringToHash = $customerKey . $currentTimeInMillis . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );


		if ($sendToEmail) {
			$fields = array (
					'customerKey' => $customerKey,
					'email' => $email,
					'authType' => 'EMAIL',
					'transactionName' => 'WP miniOrange SAML 2.0 SSO Plugin'
			);
		} else {
			$fields = array (
					'customerKey' => $customerKey,
					'phone' => $phone,
					'authType' => 'SMS',
					'transactionName' => 'WP miniOrange SAML 2.0 SSO Plugin'
			);
		}
		$field_string = json_encode ( $fields );

		$headers = array(
			"Content-Type" => "application/json",
			"Customer-Key" => $customerKey,
			"Timestamp" => $currentTimeInMillis,
			"Authorization" => $hashValue
		);
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function validate_otp_token($transactionId, $otpToken) {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/api/auth/validate';


		$customerKey = $this->defaultCustomerKey;
		$apiKey = $this->defaultApiKey;

		$username = get_option ( 'mo_saml_admin_email' );

		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		//$currentTimeInMillis = round ( microtime ( true ) * 1000 );
		$currentTimeInMillis = self::get_timestamp();

		/* Creating the Hash using SHA-512 algorithm */
		//$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$stringToHash = $customerKey . $currentTimeInMillis . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );

		$fields = '';
		// *check for otp over sms/email
		$fields = array (
				'txId' => $transactionId,
				'token' => $otpToken
		);

		$field_string = json_encode ( $fields );

		$headers = array(
			"Content-Type" => "application/json",
			"Customer-Key" => $customerKey,
			"Timestamp" => $currentTimeInMillis,
			"Authorization" => $hashValue
		);
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function submit_contact_us($email, $phone, $query) {
		$url = mo_options_plugin_constants::HOSTNAME. '/moas/rest/customer/contact-us';
		$current_user = wp_get_current_user();
		$query = '[WP SAML 2.0 SP SSO Plugin] ' . $query;
		$fields = array (
				'firstName' => $current_user->user_firstname,
				'lastName' => $current_user->user_lastname,
				'company' => $_SERVER ['SERVER_NAME'],
				'email' => $email,
				'ccEmail'=>'samlsupport@xecurify.com',
				'phone' => $phone,
				'query' => $query
		);
		$field_string = json_encode ( $fields );

		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function save_external_idp_config() {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/rest/saml/save-configuration';

		$current_user = wp_get_current_user();
		$this->email = get_option ( 'mo_saml_admin_email' );
		$this->phone = get_option ( 'mo_saml_admin_phone' );

		$idpType = 'saml';
		$identifier = get_option ( 'saml_identity_name' );
		$acsUrl = $url;

		$password = get_option ( 'mo_saml_admin_password' );
		$custId = get_option ( 'mo_saml_admin_customer_key' );
		$samlLoginUrl = get_option ( 'saml_login_url' );
		$samlIssuer = get_option ( 'saml_issuer' );
		//$samlX509Certificate = get_option ( 'saml_x509_certificate' );
		$samlX509Certificate = maybe_unserialize(get_option ( 'saml_x509_certificate' ));
		$samlX509Certificate = is_array($samlX509Certificate) ? $samlX509Certificate[0] : $samlX509Certificate;
		$Id = get_option ( 'saml_idp_config_id' );
		$assertionSigned = get_option ( 'saml_assertion_signed' ) == 'checked' ? 'true' : 'false';
		$responseSigned = get_option ( 'saml_response_signed' ) == 'checked' ? 'true' : 'false';

		$fields = array (
				'customerId' => $custId,
				'idpType' => $idpType,
				'identifier' => $identifier,
				'samlLoginUrl' => $samlLoginUrl,
				'samlLogoutUrl' => $samlLoginUrl,
				'idpEntityId' => $samlIssuer,
				'samlX509Certificate' => $samlX509Certificate,
				'assertionSigned' => $assertionSigned,
				'responseSigned' => $responseSigned,
				'overrideReturnUrl' => 'true',
				'returnUrl' => site_url () . '/?option=readsamllogin'
		);

		$field_string = json_encode ( $fields );

		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}

	function send_email_alert($email,$phone,$message){

		$url = mo_options_plugin_constants::HOSTNAME . '/moas/api/notify/send';

		$customerKey = $this->defaultCustomerKey;
		$apiKey =  $this->defaultApiKey;

		$currentTimeInMillis = self::get_timestamp();
		$currentTimeInMillis = number_format ( $currentTimeInMillis, 0, '', '' );
		$stringToHash 		= $customerKey .  $currentTimeInMillis . $apiKey;
		$hashValue 			= hash("sha512", $stringToHash);
		$fromEmail			= 'no-reply@xecurify.com';
		$subject            = "Feedback: WordPress SAML 2.0 SSO Plugin";
		$site_url=site_url();

		global $user;
		$user         = wp_get_current_user();


		$query        = '[WordPress SAML SSO 2.0 Plugin: ]: ' . $message;


		$content='<div >Hello, <br><br>First Name :'.$user->user_firstname.'<br><br>Last  Name :'.$user->user_lastname.'   <br><br>Company :<a href="'.$_SERVER['SERVER_NAME'].'" target="_blank" >'.$_SERVER['SERVER_NAME'].'</a><br><br>Phone Number :'.$phone.'<br><br>Email :<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br><br>Query :'.$query.'</div>';


		$fields = array(
			'customerKey'	=> $customerKey,
			'sendEmail' 	=> true,
			'email' 		=> array(
				'customerKey' 	=> $customerKey,
				'fromEmail' 	=> $fromEmail,
				'bccEmail' 		=> $fromEmail,
				'fromName' 		=> 'Xecurify',
				'toEmail' 		=> 'info@xecurify.com',
				'toName' 		=> 'samlsupport@xecurify.com',
				'bccEmail'		=> 'samlsupport@xecurify.com',
				'subject' 		=> $subject,
				'content' 		=> $content
			),
		);
		$field_string = json_encode($fields);

		$headers = array(
			"Content-Type" => "application/json",
			"Customer-Key" => $customerKey,
			"Timestamp" => $currentTimeInMillis,
			"Authorization" => $hashValue
		);
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function mo_saml_forgot_password($email) {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/rest/customer/password-reset';

		/* The customer Key provided to you */
		$customerKey = get_option ( 'mo_saml_admin_customer_key' );

		/* The customer API Key provided to you */
		$apiKey = get_option ( 'mo_saml_admin_api_key' );

		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round ( microtime ( true ) * 1000 );

		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );

		$fields = '';

		// *check for otp over sms/email
		$fields = array (
				'email' => $email
		);

		$field_string = json_encode ( $fields );
		$headers = array(
			"Content-Type" => "application/json",
			"Customer-Key" => $customerKey,
			"Timestamp" => $currentTimeInMillis,
			"Authorization" => $hashValue
		);
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = Utilities::mo_saml_wp_remote_post($url, $args);
		return $response['body'];

	}
	function get_timestamp() {
		$url = mo_options_plugin_constants::HOSTNAME . '/moas/rest/mobile/get-timestamp';
		$response = Utilities::mo_saml_wp_remote_post($url);
		return $response['body'];

	}

    function enable_guest_audit($in_use) {

        $url = mo_options_plugin_constants::HOSTNAME. "/moas/rest/customer/guest-audit";

        $user = wp_get_current_user();
        $urlparts = parse_url(site_url());
        $domain = $urlparts['host'];
        if(array_key_exists('path',$urlparts))
            $domain .=$urlparts['path'];
        $fields = array (
            'emailAddress' => $user->user_email,
            'companyName' =>$domain,
            'cmsName' => mo_options_plugin_constants::CMS_Name,
            'pluginVersion' => mo_options_plugin_constants::Version,
            'applicationName' => mo_options_plugin_constants::Application_Name,
            'applicationType' => mo_options_plugin_constants::Application_type,
            'inUse' => $in_use
        );
        $field_string = json_encode ( $fields );

        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $args = array(
            'method' => 'POST',
            'body' => $field_string,
            'timeout' => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => $headers
        );
        $response = Utilities::mo_saml_wp_remote_post($url, $args);
        return $response['body'];

    }





}
?>