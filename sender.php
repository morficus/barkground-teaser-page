<?php

require_once 'mandrill/src/Mandrill.php';

$formData = $_POST;
$messageToSend = "";

//if this field is NOT empty, then we assume it was a bot...
if($formData['mysteryField'] != "")
{
    echo "false";
    exit();
}

unset($formData['mysteryField']);
reset($formData);
while (list($key, $val) = each($formData)) {
    $messageToSend .= "$key => $val <br/>";
}


try {
$mandrill = new Mandrill('BSrblF2hxBD591WpryQ1ww');

    $message = array(
        'html' => $messageToSend,
        'subject' => 'BarkGround email',
        'from_email' => 'noreply@barkground.com',
        'from_name' => 'BarkGround Teaser Page',
        'to' => array(
            array(
                'email' => 'morficus@gmail.com',
                'name' => 'Maurice W.',
                'type' => 'to'
            ),
            array(
                'email' => 'Hello@kylerothfus.com',
                'name' => 'Kyle R.',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'noreply@barkground.com'),

    );
    $async = false;
    $result = $mandrill->messages->send($message, $async);
    if($result['status'] == "rejected" || $result['status'] == "invalid"){
        echo "false";
     }else{
        echo "true";
     }
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}

?>