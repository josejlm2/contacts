<?php
/**
 * This file contains the actual lessons we'll be covering in the second part of Module 3.
 */

namespace EAMann\Contacts\Lesson;

use EAMann\Contacts\Util\Contact;

/**
 * Pull a list of all contacts from the database, automatically decrypting
 * the email field (and other sensitive fields) as you go.
 *
 * @return Contact[]
 */
function list_contacts(): array
{
    // @TODO Pull all contacts out of the database, automatically decrypting email addresses as we go.

    $contacts = [];

    $handle = new \SQLite3('contacts.db');

    $results = $handle->query('SELECT * FROM contacts');
    while ($row = $results->fetchArray()) {

        // This won't decrypt anything ... just pass out the name and email address
        $contacts[] = new Contact($row['name'], $row['email']);
    }

    $handle->close();

    return $contacts;
}

/**
 * Insert the new contact into the database, automatically encrypting sensitive
 * fields and setting up a hash index against which we can search.
 *
 * @param string $name
 * @param string $email
 */
function create_contact(string $name, string $email)
{
    // @TODO The email address needs to be encrypted at rest. But we also need to query on this field!

    $handle = new \SQLite3('contacts.db');

    $handle->exec(sprintf("INSERT INTO contacts (name, email) VALUES ('%s', '%s')", $name, $email));

    $handle->close();
}

/**
 * Find a specific contact based on a known email address.
 *
 * @param string $email
 *
 * @return Contact
 */
function find_contact(string $email) : Contact
{
    // @TODO Since emails are encrypted, we need to search instead for the _hash_ of the email to find a contact!

    $handle = new \SQLite3('contacts.db');

    $results = $handle->query(sprintf("SELECT * FROM contacts WHERE email = '%s' LIMIT 1;", $email));
    $row = $results->fetchArray();

    $contact = new Contact($row['name'], $row['email']);

    $handle->close();

    return $contact;
}