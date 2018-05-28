<?php
/**
 * This file contains the actual lessons we'll be covering in Module 3.
 *
 * The goal of this module is to introduce you to the concepts of symmetric and asymmetric
 * encryption leveraging the Libsodium module shipped with PHP.
 */

namespace EAMann\Contacts\Lesson;

/**
 * Automatically encrypt the contents of a secret message sent to the server. Store the output
 * of the encryption in `secret.txt` for later retrieval.
 *
 * @param string $message
 */
function store_secret_message(string $message)
{
    // @TODO Encrypt the secret string using Libsodium. You can either use an asymmetric keypair or a single symmetric key

    // @TODO Use the tricks learned in lesson 2 to protect the key(s) you use for encryption!

    $_SESSION['secret_message'] = $message;
}

/**
 * Read the contents of a secret message and print them to screen.
 *
 * @return string
 */
function get_secret_message() : string
{
    $message = $_SESSION['secret_message'];

    // @TODO Read the secret contents of the user's session and decrypt them for presentation.

    return $message;
}