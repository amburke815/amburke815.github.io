<?php

if($_POST) {

    $visitor_name = "";
    $visitor_email = "";
    $visitor_type = "";
    $visitor_message = "";
    $email_body ="<div>\n";

    if (isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>\n
        \t<label><b>Visitor Name: </b></label>&nbsp;<span>'.$visitor_name.'</span>\n
        <div>\n";
    }

    if (isset($_POST['visitor_email'])) {
        // $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = "amburke815@gmail.com" // filter_var($_POST['visitor_email'], FILTER_VALIDATE_EMAIL); // filter_var($_POST['visitor_email'], FILTER_VALIDATE_STRING);
        $email_body .= "<div>\n
        \t<label><b>Visitor Email:</b></label>&nbsp;<span>'.$visitor_email.'</span>\n
        <div>\n";
    }

    if (isset($_POST['visitor_type'])) {
        $visitor_type = filter_var($_POST['visitor_type'], FILTER_SANITIZE);
        $email_body .= "<div>\n
        \t<label><b>Visitor Type:</b></label>&nbsp;<span>'.$visitor_type.'</span>\n
        <div>\n";
    }

    if (isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>\n
        \t<label><b>Visitor Message:</b></label>&nbsp;<span>'.$visitor_message'</span>\n
        <div>\n";
    }

    $personal_email = "";
    if ($visitor_type == "employer") {
        $email_body = '<div><p style="font-size: x-large; background-color: yellow; font-weight: bold">MESSAGE FROM EMPLOYER</p>' . $email_body;
        $personal_email .= ", amburke815@protonmail.com";
    }

    if ($visitor_type == "collaborator") {
        $email_body = '<div><p><u>Request to collaborate</u></p>' . $email_body;
    }

    $email_body .= "\n</div>\n";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";

     $school_email = "burke.ad@northeastern.edu";

    if (mail(($school_email . $personal_email), "New Website Email From " . $visitor_name . "(" . $visitor_type . ")",
    $email_body,  $headers)) {
        echo "<p>Thank you for contacting me, $visitor_name! I look forward to reading your email. You can expect a reply 
        within the next 48 hours.</p>";
    } else {
        echo "<p>Sorry, there was a problem sending your email!</p>";
    }
} else {
    echo "<p>Something went wrong</p>"
}

?>