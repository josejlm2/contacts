<?php
/**
 * This file contains the actual lessons we'll be covering in Module 2.
 *
 * The goal of this module is to introduce you to the concept of credentials management
 * when dealing with external systems that also require authentication.
 */

namespace EAMann\Contacts\Lesson;

use EAMann\Contacts\Util\API;
use EAMann\Contacts\Util\Brewery;

/**
 * Retrieve a list of breweries from our remote API, based on a certain geographic
 * location.
 *
 * @param string $zipcode
 *
 * @return array
 */
function get_breweries(string $zipcode) : array
{
    require_once '../config/config.php';

    // @TODO Assume our Util::API class is an SDK wrapper than enumerates Breweries. How would you instantiate it?
    $api = new API(API_KEY_ID, API_SECRET);
    // @TODO Once you have a handle on the SDK, fetch the list of breweries!
    return $api->getBreweries($zipcode);
}

/**
 * The main dashboard will present data retrieved from our (mock) APU system.
 *
 * @return string
 */
function show_dashboard($zipcode): string
{
    // @TODO Use our helper method above to fetch a list of breweries given the ZIP specified in a search
    $breweries = get_breweries($zipcode);

    $list = '<ul>';


    // @TODO Iterate through the list of breweries returned and build out an HTML payload to write to the response
    foreach ($breweries as $brewery){
        $list .= "<li>$brewery</li>";
    }
    $list .= '</ul>';

    return $list;
}