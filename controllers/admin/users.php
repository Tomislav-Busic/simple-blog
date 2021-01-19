<?php
include_once "models/Admin_Table.class.php";

// je li obrazac poslan?
$createNewAdmin = isset( $_POST['new-admin'] );
//ako je...
if ( $createNewAdmin ) {
    // uhvatite obrazac za unos
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    $adminTable = new Admin_Table($db);
    try {
        // pokušati stvoriti novog administratora
        $adminTable->create( $newEmail, $newPassword );
        // reći korisniku kako je prošlo
        $adminFormMessage = "New user created for $newEmail!";
    } catch ( Exception $e ) {
        // ako operacija nije uspjela, recite korisniku što je pošlo po zlu
        $adminFormMessage = $e->getMessage();
    }
}

$newAdminForm = include_once "views/admin/new-admin-form-html.php";
return $newAdminForm;