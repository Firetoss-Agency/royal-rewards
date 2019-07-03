<?php
require_once dirname( __FILE__ ) . '/includes/lib/mo-options-enum.php';

function display_saml_feedback_form() {
	if ( 'plugins.php' != basename( $_SERVER['PHP_SELF'] ) ) {
		return;
	}
	$deactivate_reasons = mo_options_feedback::getConstants();

	wp_enqueue_style( 'wp-pointer' );
	wp_enqueue_script( 'wp-pointer' );
	wp_enqueue_script( 'utils' );
	wp_enqueue_style( 'mo_saml_admin_plugins_page_style', plugins_url( '/includes/css/style_settings.css?ver=4.8.60', __FILE__ ) );
	?>

    </head>
    <body>


    <!-- The Modal -->
    <div id="feedback_modal" class="mo_modal">

        <!-- Modal content -->
        <div class="mo_modal-content">
            <h3 style="margin: 2%;">Leaving us?<span class="mo_close" style="cursor: pointer">&times;</span>
            </h3>

            <form name="f" method="post" action="" id="mo_feedback">
                <?php wp_nonce_field("mo_feedback");?>
                <input type="hidden" name="option" value="mo_feedback"/>
                <div>
                    <p style="margin:2%">
                    <br>
                    <textarea id="query_feedback" name="query_feedback" rows="5" style="width: 100%"
                              placeholder="Tell us what happened!"></textarea>
                    <br><br>
                    <div class="mo-modal-footer" style="text-align: center;margin-bottom: 2%">
                        <input type="submit" name="miniorange_feedback_submit"
                               class="button button-primary button-large" value="Submit"/>
                        <input type="button" name="miniorange_skip_feedback"
                               class="button button-primary button-large" value="Not now" onclick="document.getElementById('mo_feedback_form_close').submit();"/>
                    </div>
                </div>
            </form>
            <form name="f" method="post" action="" id="mo_feedback_form_close">
                <?php wp_nonce_field("mo_skip_feedback");?>
                <input type="hidden" name="option" value="mo_skip_feedback"/>
            </form>

        </div>

    </div>

    <script>
        jQuery('a[aria-label="Deactivate miniOrange SSO using SAML 2.0"]').click(function () {

            var mo_modal = document.getElementById('feedback_modal');

            var span = document.getElementsByClassName("mo_close")[0];

// When the user clicks the button, open the mo2f_modal

            mo_modal.style.display = "block";

            span.onclick = function () {
                mo_modal.style.display = "none";
                jQuery('#mo_feedback_form_close').submit();
            }

            // When the user clicks anywhere outside of the mo2f_modal, mo2f_close it
            window.onclick = function (event) {
                if (event.target == mo_modal) {
                    mo_modal.style.display = "none";
                }
            }
            return false;

        });
    </script><?php
}

?>