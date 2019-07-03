<?php
include "BasicEnum.php";
 class mo_options_enum_sso_login extends BasicEnum {
	const Relay_state = 'mo_saml_relay_state';
	const Redirect_Idp = 'mo_saml_registered_only_access';
	const Force_authentication = 'mo_saml_force_authentication';
	const Enable_access_RSS = 'mo_saml_enable_rss_access';
	const Auto_redirect = 'mo_saml_enable_login_redirect';
}

class mo_options_enum_identity_provider extends BasicEnum{
 	const Broker_service ='mo_saml_enable_cloud_broker';
	const SP_Base_Url='mo_saml_sp_base_url';
	const SP_Entity_ID = 'mo_saml_sp_entity_id';

}

class mo_options_enum_pointers extends BasicEnum{
	public static $SERVICE_PROVIDER = array('custom_admin_pointers4_8_52_miniorange-support-pointer',
		'custom_admin_pointers4_8_52_miniorange-select-your-idp',
		'custom_admin_pointers4_8_52_miniorange-upload-metadata',
		'custom_admin_pointers4_8_52_miniorange-test-configuration',
		'custom_admin_pointers4_8_52_miniorange-import-config',
		'custom_admin_pointers4_8_52_export-import-config',
		'custom_admin_pointers4_8_52_configure-service-restart-tour');
	public static $IDENTITY_PROVIDER = array(
		'custom_admin_pointers4_8_52_metadata_manual',
		'custom_admin_pointers4_8_52_miniorange-sp-metadata-url',
		'custom_admin_pointers4_8_52_identity-provider-restart-tour'
		);
	public static $ATTRIBUTE_MAPPING = array(
		'custom_admin_pointers4_8_52_miniorange-attribute-mapping',
		'custom_admin_pointers4_8_52_miniorange-role-mapping',
		'custom_admin_pointers4_8_52_attribute-mapping-restart-tour');
	public static $REDIRECTION_LINK = array(
		'custom_admin_pointers4_8_52_minorange-use-widget',
		'custom_admin_pointers4_8_52_miniorange-auto-redirect',
		'custom_admin_pointers4_8_52_miniorange-auto-redirect-login-page',
		'custom_admin_pointers4_8_52_miniorange-short-code',
		'custom_admin_pointers4_8_52_miniorange-redirection-sso-restart-tour'
		);

}


class mo_options_enum_service_provider extends BasicEnum{
	const Identity_name ='saml_identity_name';
	const Login_binding_type='saml_login_binding_type';
	const Login_URL = 'saml_login_url';
	const Logout_binding_type = 'saml_logout_binding_type';
	const Logout_URL = 'saml_logout_url';
	const Issuer = 'saml_issuer';
	const X509_certificate = 'saml_x509_certificate';
	const Request_signed = 'saml_request_signed';
	const Guide_name = 'saml_identity_provider_guide_name';
    const Is_encoding_enabled = 'mo_saml_encoding_enabled';


}

class mo_options_test_configuration extends BasicEnum{
    const SAML_REQUEST = 'MO_SAML_REQUEST';
    const SAML_RESPONSE = 'MO_SAML_RESPONSE';
    const TEST_CONFIG_ERROR_LOG = 'MO_SAML_TEST';
}

class mo_options_enum_attribute_mapping extends BasicEnum{
 	const Attribute_Username ='saml_am_username';
 	const Attribute_Email = 'saml_am_email';
 	const Attribute_First_name ='saml_am_first_name';
 	const Attribute_Last_name = 'saml_am_last_name';
 	const Attribute_Group_name ='saml_am_group_name';
 	const Attribute_Custom_mapping = 'mo_saml_custom_attrs_mapping';
	const Attribute_Account_matcher = 'saml_am_account_matcher';

}

class mo_options_enum_role_mapping extends BasicEnum{
	const Role_do_not_auto_create_users = 'mo_saml_dont_create_user_if_role_not_mapped';
	const Role_do_not_assign_role_unlisted = 'saml_am_dont_allow_unlisted_user_role';
	const Role_do_not_update_existing_user = 'saml_am_dont_update_existing_user_role';
	const Role_default_role ='saml_am_default_user_role';
}


class mo_options_error_constants extends BasicEnum{
 	const Error_no_certificate = "Unable to find a certificate .";
	const Cause_no_certificate = "No signature found in SAML Response or Assertion. Please sign at least one of them.";
	const Error_wrong_certificate = "Unable to find a certificate matching the configured fingerprint.";
	const Cause_wrong_certificate = "X.509 Certificate field in plugin does not match the certificate found in SAML Response.";
	const Error_invalid_audience = "Invalid Audience URI.";
	const Cause_invalid_audience = "The value of 'Audience URI' field on Identity Provider's side is incorrect";
	const Error_issuer_not_verfied = "Issuer cannot be verified.";
	const Cause_issuer_not_verfied = "IdP Entity ID configured and the one found in SAML Response do not match";
}

class mo_options_feedback extends BasicEnum{
 	const Features_not_available = "Does not have the features I'm looking for";
 	const Not_upgrading_to_premium = "Do not want to upgrade to Premium version";
 	const Confusing_interface = "Confusing Interface";
 	const Bugs_in_plugin = "Bugs in the plugin";
 	const Other_reasons = "Other Reasons:";
}

class mo_options_plugin_constants extends  BasicEnum{
     const CMS_Name = "WP";
     const Application_Name = "WP miniOrange SAML 2.0 SSO Plugin";
     const Application_type = "SAML";
     const Version = "4.8.77";
     const HOSTNAME = "https://login.xecurify.com";
}

class mo_options_plugin_idp extends  BasicEnum{
    public static $IDP_GUIDES = array(
        "ADFS" => "adfs",
        "Okta" => "okta",
        "SalesForce" => "salesforce",
        "Google Apps" => "google-apps",
        "Azure AD" => "azure-ad",
        "OneLogin" => "onelogin",
        "Centrify" => "centrify",
        "Keycloak" => "jboss-keycloak",
        "MiniOrange" => "miniorange",
        "Bitium" => "bitium",
        "Other" => "Other"
    );
}

