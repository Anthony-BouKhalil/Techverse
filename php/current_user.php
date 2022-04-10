<?php
if (!isset($_SESSION)) {
    session_start();
}

$data = mb_convert_encoding([$_SESSION['user']], 'UTF-8', 'UTF-8');
echo json_encode($data);
?>