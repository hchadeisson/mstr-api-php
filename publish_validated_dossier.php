<?php

include 'login.php';
include 'publish_dossier.php';

$login = ''; // set username
$password = ''; // set password
$loginmode = 1; // set loginmode : 1 = Standard - 8 = Guest - 16 = LDAP
$projectid = ''; // set project id
$userid = ''; // set user id to publish to
$dossierid = ''; // set dossier id to publish

$authentication = rest_login($login, $password, $loginmode);

print_r($authentication);

echo 'publishing '.$dossierid.' --> '.publish_dossier($authentication, $projectid, $dossierid, $userid);

?>