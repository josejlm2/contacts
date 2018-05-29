<?php
/**
 * Created by PhpStorm.
 * User: manriquez
 * Date: 5/29/2018
 * Time: 1:07 PM
 */

$handle = new \SQLite3('contacts.db');

$handle->exec("ALTER TABLE contacts ADD COLUMN email_hash text;");