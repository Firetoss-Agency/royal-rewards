<?php

require_once "mo_saml_settings_page.php";

$pointers = array();
$tab= 'save';
$test_status = get_option('MO_SAML_TEST_STATUS');
if(array_key_exists('tab',$_GET))
    $tab = $_GET['tab'];
if($tab == 'save'){

    $pointers['miniorange-support-pointer'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'We are here!!' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Get in touch with us and we will help you setup the plugin in no time.' ) ),
        'anchor_id' => '#mo_saml_support_layout',
        'edge'      => 'right',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
    $pointers['miniorange-select-your-idp'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Select your IDP' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Choose your IDP from the list of IDPs, and refer to the setup guides to proceed further' ) ),
        'anchor_id' => '#select_your_idp',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
    $pointers['miniorange-upload-metadata'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Upload your metadata' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'If you have a metadata URL or file provided by your IDP, click on the button. You can configure the plugin manually' ) ),
        'anchor_id' => '#upload-metadata',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
    $pointers['miniorange-upload-metadata'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Upload your metadata' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'If you have a metadata URL or file provided by your IDP, click on the button. You can configure the plugin manually' ) ),
        'anchor_id' => '#upload-metadata',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );

    if(mo_saml_is_sp_configured() || get_option('saml_x509_certificate')){
        $pointers['miniorange-test-configuration'] = array(
            'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Check your configurations' ) ),
            'content'   => sprintf( '<p>%s</p>', esc_html__( 'This will test if the configurations on IDP and SP are correct' ) ),
            'anchor_id' => '#test_config',
            'edge'      => 'left',
            'align'     => 'left',
            'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
        );
        $pointers['export-import-config'] = array(
            'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Export Configuration' ) ),
            'content'   => sprintf( '<p>%s</p>', esc_html__( 'If you are having trouble setting up the plugin, Export the configurations and mail us at info@miniorange.com.' ) ),
            'anchor_id' => '#export-import-config',
            'edge'      => 'left',
            'align'     => 'left',
            'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
        );
    }

    $pointers['configure-service-restart-tour'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Click when you need me!' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Revisit tour' ) ),
        'anchor_id' => '#configure-service-restart-tour',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );

}
if($tab == 'config'){

    $pointers['miniorange-sp-metadata-url'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Service Provider Metadata URL' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Use this Metadata URL to configure your IDP.' ) ),
        'anchor_id' => '#metadata_url',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
    $pointers['metadata_manual'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Service Provider Metadata URLs' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'If your IDP does not support metadata URL, you can even manually configure your IDP using the information given here' ) ),
        'anchor_id' => '#metadata_manual',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );


    $pointers['identity-provider-restart-tour'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Click when you need me!' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Revisit tour' ) ),
        'anchor_id' => '#identity-provider-restart-tour',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );

}
if($tab == 'opt'){

    $pointers['miniorange-attribute-mapping'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Configure Attribute Mapping' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'While auto registering the users in your WordPress site these attributes will automatically get mapped to your WordPress user details.' ) ),
        'anchor_id' => '#miniorange-attribute-mapping',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );

    $pointers['miniorange-role-mapping'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Configure Role Mapping' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Select roles to be assigned to users when they are created in Wordpress.' ) ),
        'anchor_id' => '#miniorange-role-mapping',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );


    $pointers['attribute-mapping-restart-tour'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Click when you need me!' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Revisit tour' ) ),
        'anchor_id' => '#attribute-mapping-restart-tour',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );


}

if( $tab =='general'){
    $pointers['minorange-use-widget'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Available with this version' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Add a widget to your Wordpress page and test out the SSO.' ) ),
        'anchor_id' => '#minorange-use-widget',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
    $pointers['miniorange-auto-redirect'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Premium Feature' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Redirect the users to your IdP if user not logged in.Protects your complete site from not logged in Users' ) ),
        'anchor_id' => '#miniorange-auto-redirect',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );


    $pointers['miniorange-auto-redirect-login-page'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Premium Feature' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Automatically redirect the user to the Identity Provider when they land on the WordPress Login Page.' ) ),
        'anchor_id' => '#miniorange-auto-redirect-login-page',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );

    $pointers['miniorange-short-code'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Premium Feature' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Add a shortcode to any page and SSO into your website' ) ),
        'anchor_id' => '#miniorange-short-code',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
	
	$pointers['miniorange-redirection-sso-restart-tour'] = array(
        'title'     => sprintf( '<h3>%s</h3>', esc_html__( 'Click when you need me!' ) ),
        'content'   => sprintf( '<p>%s</p>', esc_html__( 'Revisit tour' ) ),
        'anchor_id' => '#miniorange-redirection-sso-restart-tour',
        'edge'      => 'left',
        'align'     => 'left',
        'where'     => array( 'toplevel_page_mo_saml_settings' ) // <-- Please note this
    );
}






return $pointers;