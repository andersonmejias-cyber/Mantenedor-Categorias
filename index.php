<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: backoffice/');
    exit();
}

header('Location: user/login/');
exit();