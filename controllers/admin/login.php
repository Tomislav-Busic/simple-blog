<?php
include_once "models/Admin_Table.class.php";

$loginFormSubmitted = isset( $_POST['log-in'] );
if( $loginFormSubmitted ) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // stvoriti objekt za komunikaciju s tablicom baze podataka
    $adminTable = new Admin_Table( $db );
    try {
        // pokušaj prijave korisnika
        $adminTable->checkCredentials( $email, $password );
        $admin->login();
    } catch ( Exception $e ) {
        // prijava nije uspjela
    }
}

$loggingOut = isset ( $_POST['logout']);
if ( $loggingOut){
    $admin->logout();
}

if ( $admin->isLoggedIn() ) {
    $view = include_once  "views/admin/logout-form-html.php";
} else {
    $view = include_once "views/admin/login-form-html.php";
}

return $view;