<?php
/**
 * These utility functions help for rendering our UI to make password management
 * a bit easier. You're not expected to implement anything here.
 */

namespace EAMann\Contacts\Util;

use function EAMann\Contacts\Lesson\get_signed_message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function show_signature_data(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
{
    $secretMessage = file_get_contents('secret.txt');
    $signature = file_get_contents('secret.txt.sig');

    $body = get_signature_markup($secretMessage, $signature);
    $response->getBody()->write($body);

    return $response;
}

function get_signature_markup(string $secretMessage, string $signature): string
{
    $body = <<<BODY
<html>
<head>
    <title>Module 6 | Message Signatures</title>
    <style type="text/css">
        #data-presentation { width: 250px; margin: auto; }
        form > div { margin-top: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div id="data-presentation">
        <div>
            <label for="secret_message">Secret Message: </label>
            <textarea name="secret_message" cols="50" rows="10" readonly="readonly">SECRETMESSAGE</textarea>
        </div>
        <div>
            <input type="text" value="SIGNATURE" readonly="readonly" />
        </div>
        <div>
            <input type="text" value="VALIDATED" readonly="readonly" />
        </div>
    </div>
</body>
</html>
BODY;

    $body = str_replace('SIGNATURE', htmlspecialchars($signature), $body);

    $validated = get_signed_message('secret.txt', '4af816254d721f156edb2589fddf55db06a16fe546cbc252708e287796fc16a7') ? 'Message is VALID' : 'Message is INVALID';
    $body = str_replace('VALIDATED', $validated, $body);

    return str_replace('SECRETMESSAGE', htmlspecialchars($secretMessage), $body);
}