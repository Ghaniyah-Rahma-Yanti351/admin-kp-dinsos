<?php
// Mulai session
session_start();

// Hancurkan semua data session
session_destroy();

// Redirect ke halaman login.php setelah session dihancurkan
header("Location: login.php");
exit;
?>
