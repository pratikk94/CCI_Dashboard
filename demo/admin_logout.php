<?php

if (session_destroy()) {
    header("Location: admin_index.php");
}
?>