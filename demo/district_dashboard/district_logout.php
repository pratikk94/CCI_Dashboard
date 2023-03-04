<?php

if (session_destroy()) {
    header("Location: district_index.php");
}
?>