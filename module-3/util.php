<?php
/**
 * These utility functions help for rendering our UI to make password management
 * a bit easier. You're not expected to implement anything here.
 */

namespace EAMann\Contacts\Util;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function show_entry_form(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
{
    if ($request->getMethod() === 'POST') {
        $body = $request->getParsedBody();
        $secretMessage = $body['secret_message'];
    } else {
        $secretMessage = '';
    }

    $body = get_entry_form($secretMessage);
    $response->getBody()->write($body);

    return $response;
}

function get_entry_form(string $secretMessage): string
{
    $body = <<<BODY
<html>
<head>
    <title>Module 3 | Encryption</title>
    <style type="text/css">
        #entry-form { width: 250px; margin: auto; }
        form > div { margin-top: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div id="entry-form">
        <form method="post" action="">
            <div>
                <label for="secret_message">Secret Message: </label>
                <textarea name="secret_message" cols="50" rows="10">SECRETMESSAGE</textarea>
            </div>
            <div>
                <input type="submit" value="Save the Secrets!" />
            </div>       
        </form>
    </div>
</body>
</html>
BODY;

    return str_replace('SECRETMESSAGE', htmlspecialchars($secretMessage), $body);
}