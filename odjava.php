<?php
include '_header.php';
if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
}

header('Location: index.php');
exit;
?>
