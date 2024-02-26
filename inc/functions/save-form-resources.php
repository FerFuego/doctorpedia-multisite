<?php 
    /**
     * Last fix 20/01/2021
     * Improvised a fix error before presentation Josh
     */
	require('../../../../wp-load.php');
    header ('Content-type: text/html; charset=utf-8');
    
    global $wpdb;
    
    $fullname = $email = $resources = $type = "";
    $subject = get_bloginfo('name');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $fullname = htmlspecialchars($_POST['fullname']);
        $email = htmlspecialchars($_POST['email']);
        $resources = htmlspecialchars($_POST['resources']);
        $type = htmlspecialchars($_POST['type']);
        
        // Email User
        $recipient = $email;
    
        $message = '<body>';
        $message .= '<h1><img src="'.IMAGES.'/doctorpedia-isologo.svg>'.get_bloginfo('name').'</h1><hr><br><br><br>';
        if($type == 'Resources'){
            $message .= '<p>Thank you for submitting a resource. Our team will review it and consider adding it to the site once we go live.</p>';
        }else{
            $message .= '<p>Thank you for your interest in reviewing resources. We will be in touch if we think it\'s a fit.</p>';
        }
        $message .= '</body>';

        $mail = array('From: '.get_bloginfo('name').' <no-reply@doctorpedia.com>','Content-Type: text/html; charset=UTF-8');
        wp_mail($recipient, $subject, $message, $mail);
    
    
        /***********************************************************/
        
        // Email DP
        $recipient = 'contact@doctorpedia.com';
    
        $content = '<body>';
        $content .= '<h1><img src="'.IMAGES.'/doctorpedia-isologo.svg>'.get_bloginfo('name').'</h1><hr><br><br><br>';
        $content .= '<p><b>Name: </b>'.$fullname.'</p>';
        $content .= '<p><b>Email: </b>'.$email.'</p>';
        $content .= '<p><b>Type: </b>'.$type.'</p>';
        $content .= '<p><b>Resources: </b>'.$resources.'</p>';
        $content .= '</body>';
    
        $mail2 =  array('From: '.get_bloginfo('name').' <no-reply@doctorpedia.com>','Content-Type: text/html; charset=UTF-8');
        try {
            wp_mail($recipient, $subject, $content, $mail2);
            return print '<p class="text-success">Thank you! You message has been sent.</p>';
        } catch (Exception $e) {
            return print '<p class="text-danger">There was a problem, try it again!</p>';
        }
    }