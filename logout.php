<?php
session_start();
session_unset($_SESSIOM['UserID']);
session_destroy();
header('Location: index.php?bye');
?>
