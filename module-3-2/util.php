<?php
/**
 * These utility functions help for rendering our UI to make password management
 * a bit easier. You're not expected to implement anything here.
 */

namespace EAMann\Contacts\Util;

use function EAMann\Contacts\Lesson\find_contact;
use function EAMann\Contacts\Lesson\list_contacts;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function show_landing(ServerRequestInterface $request, ResponseInterface $response, string $email): ResponseInterface
{
    if (empty($email)) {
        $contacts = list_contacts();
    } else {
        $contacts = [find_contact($email)];
    }

    $body = <<<BODY
<html>
<head>
    <title>Module 3 | Lesson 2 | Database Encryption</title>
    <style type="text/css">
        #contacts, #search-form, #create-form { width: 250px; margin: auto; }
        #contacts th, #contacts td { border: 1px solid gray; margin: 0; padding-left: 10px; padding-right: 10px; text-align: left; }
        form > div { margin-top: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div id="contacts">
        <h2>Current Contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
BODY;

    foreach($contacts as $contact) {
        /** @var Contact $contact */
        $body .= sprintf('<tr><td>%s</td><td>%s</td></tr>', htmlspecialchars($contact->name), htmlspecialchars($contact->email));
    }

    $body .= <<<BODY
            </tbody>
        </table>
    </div>
    <div id="search-form">
        <h2>Find a Contact</h2>
        <form method="post" action="">
            <div>
                <label for="email">Email: </label>
                <input type="text" name="email" value="" />
            </div> 
            <div>
                <input type="submit" value="Find user!" />
            </div>       
        </form>
    </div>
    <div id="create-form">
        <h2>Create a Contact</h2>
        <form method="post" action="create">
            <div>
                <label for="name">Name: </label>
                <input type="text" name="name" value="" />
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="text" name="email" value="" />
            </div>
            <div>
                <input type="submit" value="Create user!" />
            </div>      
        </form>
    </div>
</body>
</html>
BODY;

    $response->getBody()->write($body);

    return $response;
}

function insert_contact(Contact $contact)
{

}

class Contact
{
    public $name;

    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}