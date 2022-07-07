<?php
/*
Plugin Name: Custom Contact Form Plugin
Plugin URI: http://example.com
Description: Simple WordPress Contact Form
Version: 1.0
Network: true
Author: Shevchenko Liza
Author URI: http://w3guy.com
*/

function html_form_code() {?>
    <form action="<?=esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post">
        <p>
            <label for="cf-first_name"><?esc_html_e('First Name', 'test_task')?></label> </br>
            <input type="text" name="cf-first_name" pattern="[a-zA-Z ]+" value="<?= ( isset( $_POST["cf-first_name"] ) ? esc_attr( $_POST["cf-first_name"] ) : '' )?>" size="40" />
        </p>

        <p>
            <label for="cf-last_name"><?esc_html_e('Last Name', 'test_task')?></label> </br>
            <input type="text" name="cf-last_name" pattern="[a-zA-Z ]+" value="<?=( isset( $_POST["cf-last_name"] ) ? esc_attr( $_POST["cf-last_name"] ) : '' ) ?>" size="40" />
        </p>

        <p>
            <label for="cf-subject"><?esc_html_e('Subject', 'test_task')?></label> </br>
            <input type="text" name="cf-subject" pattern="[a-zA-Z0-9 ]+" value="<?= (isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '')?>" size="40" />
        </p>

        <p>
            <label for="cf-message"><?esc_html_e('Message', 'test_task')?></label> </br>
            <textarea rows="10" cols="35" name="cf-message"> <?= (isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '')?> </textarea>
        </p>

        <p>
            <label for="cf-message"><?esc_html_e('Email', 'test_task')?></label> </br>
            <input type="email" name="cf-email" value=" <?= (isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '')?> " size="40"/>
        </p>

        <p>
            <input type="submit" class="btn" name="cf-submitted" value="Send">
        </p>
    </form>

<? }

function deliver_mail() {

    if ( isset( $_POST['cf-submitted'] ) ) {

        $first_name  = sanitize_text_field( $_POST["cf-first_name"] );
        $last_name  = sanitize_text_field( $_POST["cf-last_name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $subject = sanitize_text_field( $_POST["cf-subject"] );
        $message = esc_textarea( $_POST["cf-message"] );
        $to = get_option( 'admin_email' );
        $headers = "From: $first_name $last_name  <$email>" . "\r\n";

        $arr = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
                array(
                    'property' => 'firstname',
                    'value' => $first_name
                ),
                array(
                    'property' => 'lastname',
                    'value' => $last_name
                )
            )
        );

        define('DEFAULT_SITE_DIR', $_SERVER['DOCUMENT_ROOT']."/task/wp-content/log/log.txt");

        function logger ($log)
        {
            if(!file_exists(DEFAULT_SITE_DIR)) {
                file_put_contents(DEFAULT_SITE_DIR, '');
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            $date = date("j-M-Y H:i:s");
            $contents = file_get_contents(DEFAULT_SITE_DIR);
            $contents .= "$ip\t$date\t$log\r";
            file_put_contents(DEFAULT_SITE_DIR, $contents);

        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        if ( wp_mail( $to, $subject, $message, $headers ) ) {

            echo '<script>alert(\'Thanks for your message!\');</script>';
            $post_json = json_encode($arr);
            $hapikey = readline('eu1-f4a9-6500-4882-bb99-9e3392ab3c0a');
            $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $hapikey;
            $ch = @curl_init();
            @curl_setopt($ch, CURLOPT_POST, true);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
            @curl_setopt($ch, CURLOPT_URL, $endpoint);
            @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = @curl_exec($ch);
            $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_errors = curl_error($ch);
            @curl_close($ch);
            echo "curl Errors: " . $curl_errors;
            echo "\nStatus code: " . $status_code;
            echo "\nResponse: " . $response;


        }
            $log="Form sent from $email";
            logger($log);
    }
        else{
            echo '<script>alert(\'Invalid email format!\');</script>';

        }
    }
}


function cf_shortcode() {
    ob_start();
    deliver_mail();
    html_form_code();
    return ob_get_clean();
}

add_shortcode( 'custom_contact_form', 'cf_shortcode' );
?>
