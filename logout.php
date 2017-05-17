#!/usr/local/php5/bin/php-cgi


<?php
session_start();
session_unset($_SESSIOM['UserID']);
session_destroy();
header('Location:index.php');
?>