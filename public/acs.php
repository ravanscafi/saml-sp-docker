<?php
require __DIR__.'/../vendor/autoload.php';

use OneLogin\Saml2\Auth;

try {
    $auth = new Auth(require __DIR__.'/../settings.php');

    $auth->processResponse($_SESSION['AuthNRequestID'] ?? null);
    unset($_SESSION['AuthNRequestID']);
} catch (Exception $e) {
    echo $e->getMessage();
}

$errors = $auth->getErrors();

if (!empty($errors)) {
    echo '<p>', implode(', ', $errors), '</p>';
    exit();
}

if (!$auth->isAuthenticated()) {
    echo "<p>Not authenticated</p>";
    exit();
}

$attributes = $auth->getAttributes();
$nameId = $auth->getNameId();

echo '<h1>Identified user: '.htmlentities($nameId).'</h1>';

if (!empty($attributes)) {
    echo '<h2>User attributes:</h2>';
    echo '<table><thead><th>Name</th><th>Values</th></thead><tbody>';
    foreach ($attributes as $attributeName => $attributeValues) {
        echo '<tr><td>'.htmlentities($attributeName).'</td><td><ul>';
        foreach ($attributeValues as $attributeValue) {
            echo '<li>'.htmlentities($attributeValue).'</li>';
        }
        echo '</ul></td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo 'No attributes found.';
}

