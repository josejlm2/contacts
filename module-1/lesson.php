<?php
/**
 * This file contains the actual lessons we'll be covering in the first part of Module 1.
 *
 * The goal of this module is to introduce you to the concept of password management. Users
 * will be presented with a username and password field on the front-end of the website.
 * They must log in by submitting their information, which must then be compared to known
 * values on the serverside.
 */

namespace EAMann\Contacts\Lesson;
use function EAMann\Contacts\Util\get_user_by_username;

/**
 * The authentication form will send us the user's input for their authentication
 * credentials. Your task is to validate that the username and password match what's
 * expected from them. For a first example, we want to compare our user-provided input
 * to something static (like a hard-coded string).
 *
 * You should also handle the potential of _multiple_ users for the system. How will we
 * match different usernames to different passwords?
 *
 * @param string $username
 * @param string $password
 *
 * @return bool
 */
function validate_auth(string $username, string $password)
{

    $reset_token = new \SQLite3(('users.db'));

    try{
        $user = get_user_by_username($username);

        if(password_verify($password, $user['password'])){
            $_SESSION['auth'] = $username;
            return true;
        }

        return false;

    } catch (\Exception $e){
        return false;
    }





//    $password = password_hash('thisissecure', PASSWORD_DEFAULT);
//    hash_equals('known_string', 'user_provided_string');

//    password_verify($password,$hash);



    switch($username){
        case 'admin':
            $_SESSION['auth'] = 'admin';

            return password_verify($password, password_hash('thisisinsecure', PASSWORD_DEFAULT));
            return $password === 'thisissecure';

        case 'user':
            $_SESSION['auth'] = 'user';
            return $password === 'password';
            break;
        default:
            return false;
    }


    /**
     * @TODO
     * Match usernames to passwords to verify authentication data. If we find a match,
     * this function should return `true`, otherwise `false`.
     */

    /**
     * @TODO
     * The application back-end assumes there's a persistent session set with a key of
     * 'auth.' Make sure we put _something_ in the session with that key, otherwise users
     * won't have anything to view once they log in!
     */
}