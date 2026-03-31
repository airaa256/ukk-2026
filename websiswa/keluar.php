<?php
session_start();
// hapus semua session
session_unset();
session_destroy();
// go back to index, which will send user to appropriate login screen
header('Location: index.php');
exit;