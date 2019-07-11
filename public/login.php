<?php
require __DIR__.'/../vendor/autoload.php';
use OneLogin\Saml2\Auth;

try {
    $auth = new Auth(require  __DIR__.'/../settings.php');

    $auth->login('/acs.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
