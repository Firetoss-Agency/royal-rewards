<?php
require_once dirname( __FILE__ ) . '/includes/lib/mo-options-enum.php';
add_action( 'admin_init', 'miniorange_import_export' );
define( "Tab_Class_Names", serialize( array(
	"SSO_Login"         => 'mo_options_enum_sso_login',
	"Identity_Provider" => 'mo_options_enum_identity_provider',
	"Service_Provider"  => 'mo_options_enum_service_provider',
	"Attribute_Mapping" => 'mo_options_enum_attribute_mapping',
	"Role_Mapping"      => 'mo_options_enum_role_mapping',
    "Test_Configuration" => 'mo_options_test_configuration'
) ) );

/**
 *Function to display block of UI for export Import
 */
function miniorange_keep_configuration_saml() {
	echo '<div class="mo_saml_support_layout" id="mo_saml_keep_configuration_intact">
        <div>
        <h3>Keep configuration Intact</h3>
        <form name="f" method="post" action="" id="settings_intact">';

    wp_nonce_field('mo_saml_keep_settings_on_deletion');
	echo '<input type="hidden" name="option" value="mo_saml_keep_settings_on_deletion"/>
		<label class="switch">
		<input type="checkbox" name="mo_saml_keep_settings_intact" ';
        echo checked(get_option('mo_saml_keep_settings_on_deletion')=='true');
		echo 'onchange="document.getElementById(\'settings_intact\').submit();"/>
		<span class="slider round"></span>
					</label><span style="padding-left:5px">
        Enabling this would keep your settings intact when plugin is uninstalled</span>
        <p><b>Please enable this option
        when you are updating to a Premium version.</b></p>
        </form>
        </div>
        <br /><br />
	</div>';
}

/**
 *Function iterates through the enum to create array of values and converts to JSON and lets user download the file
 */
function miniorange_import_export($test_config_screen=false,$json_in_string=false) {

    if($test_config_screen)
        $_POST['option'] = 'mo_saml_export';

	if ( array_key_exists( "option", $_POST )  ) {
	    if($_POST['option']=='mo_saml_export'){
				if($test_config_screen and $json_in_string)
					$export_referer = check_admin_referer('mo_saml_contact_us_query_option');
				else
					$export_referer = check_admin_referer('mo_saml_export');

				if($export_referer){
					$tab_class_name = unserialize(Tab_Class_Names);
					$configuration_array = array();
					foreach ($tab_class_name as $key => $value) {
						$configuration_array[$key] = mo_get_configuration_array($value);
					}
					$configuration_array["Version_dependencies"] = mo_get_version_informations();
					$version = phpversion();
					if(substr($version,0 ,3) === '5.3'){
						$json_string=(json_encode($configuration_array, JSON_PRETTY_PRINT));
					} else {
						$json_string=(json_encode($configuration_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
					}

					if($json_in_string)
						return $json_string;
					header("Content-Disposition: attachment; filename=miniorange-saml-config.json");
					echo $json_string;
					exit;
				}
	    }
	    else if($_POST['option']=='mo_saml_keep_settings_on_deletion' and check_admin_referer('mo_saml_keep_settings_on_deletion')) {

            if (array_key_exists('mo_saml_keep_settings_intact', $_POST))
                update_option('mo_saml_keep_settings_on_deletion', 'true');
            else
                update_option('mo_saml_keep_settings_on_deletion', '');

        }

        return;


	}





}

function mo_get_configuration_array( $class_name ) {
	$class_object = call_user_func( $class_name . '::getConstants' );
	$mo_array = array();
	foreach ( $class_object as $key => $value ) {
		$mo_option_exists=get_option($value);

		if($mo_option_exists){
			if(@unserialize($mo_option_exists)!==false){
				$mo_option_exists = unserialize($mo_option_exists);
			}
			$mo_array[ $key ] = $mo_option_exists;

		}

	}

	return $mo_array;
}

function mo_update_configuration_array( $configuration_array ) {
	$tab_class_name = unserialize( Tab_Class_Names );
	foreach ( $tab_class_name as $tab_name => $class_name ) {
		foreach ( $configuration_array[ $tab_name ] as $key => $value ) {
			$option_string = constant( "$class_name::$key" );
			$mo_option_exists = get_option($option_string);
			if ( $mo_option_exists) {
				if(is_array($value))
					$value = serialize($value);
				update_option( $option_string, $value );
			}
		}
	}

}

function mo_get_version_informations(){
	$array_version = array();
	$array_version["Plugin_version"] = mo_options_plugin_constants::Version;
	$array_version["PHP_version"] = phpversion();
	$array_version["Wordpress_version"] = get_bloginfo('version');
	$array_version["OPEN_SSL"] = mo_saml_is_openssl_installed();
	$array_version["CURL"] = mo_saml_is_curl_installed();
    $array_version["ICONV"] = mo_saml_is_dom_installed();
    $array_version["DOM"] = mo_saml_is_dom_installed();

	return $array_version;

}

