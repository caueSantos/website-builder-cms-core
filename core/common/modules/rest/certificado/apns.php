<?php

function enviarAPNS($deviceToken)
{
    // Put your device token here (without spaces):
    // $deviceToken = '1234';

    // Put your private key's passphrase here:
    $passphrase = 'labcloud';

    // Put your alert message here:
    $title = 'LabCloud';
    $message = 'Teste!';

    ////////////////////////////////////////////////////////////////////////////////

    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'labcloud.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

    if (!$fp) {
        echo "Failed to connect: $err $errstr";
        return false;
    }

    // Create the payload body
    $body['aps'] = [
        'alert' => [
            'title' => $title,
            'body' => $message
        ],
        'badge' => 2,
        'sound' => 'oven.caf'
    ];

    // Encode the payload as JSON
    $payload = json_encode($body);

    // Build the binary notification
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

    // Send it to the server
    $result = fwrite($fp, $msg, strlen($msg));

    // Close the connection to the server
    fclose($fp);
    
    if (!$result) {
        echo 'Message not delivered';
        return false;
    }
    
    echo 'Message successfully delivered';
    return true;
}

var_dump(enviarAPNS('1234'));