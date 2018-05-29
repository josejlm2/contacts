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
 * @throws \Exception
 */
function store_secret_message(string $message)
{
    // @TODO Encrypt the secret string using Libsodium. You can either use an asymmetric keypair or a single symmetric key

    require_once '../config/config.php';






    // @TODO Use the tricks learned in lesson 2 to protect the key(s) you use for encryption!
    $nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES);
//    echo bin2hex($nonce);






    $sender_key = 'asdfas';
    $recipent_key = 'adfadsfsad'; //public key

//    $key_pair = sodium_crypto_box_keypair_from_secretkey_and_publickey($sender_key, $recipent_key);
    $key_pair = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin(PRIVATE_KEY), hex2bin(PUBLIC_KEY));

    $cipher = sodium_crypto_box($message, $nonce, $key_pair);

//    $store = base64_encode($encrypted);

    $store = bin2hex($nonce.$cipher);

    file_put_contents('config/secret.txt', $store);
}

/**
 * Read the contents of a secret message and print them to screen.
 *
 * @return string
 */
function get_secret_message() : string
{
    $message = file_get_contents('config/secret.txt');

    $keypair = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin(PRIVATE_KEY), hex2bin(PUBLIC_KEY));

    $bits =  hex2bin($message);
    $nonce = substr($bits, 0, SODIUM_CRYPTO_BOX_NONCEBYTES);
    $cipher = substr($bits, SODIUM_CRYPTO_BOX_NONCEBYTES);

    $message = sodium_crypto_box_open($message,$nonce,$keypair);

    // @TODO Read the contents of `secret.txt` and decrypt them for presentation.

    return $message;
}