<?php
ob_start();
session_start();
require_once 'config.php';
//$user_obj = new Cl_User();
//$data = $user_obj->logout();

session_unset();
session_destroy();
session_start();
//$_SESSION['success'] = LOGOUT_SUCCESS;
header('Location: ../mis/login.php');
?>