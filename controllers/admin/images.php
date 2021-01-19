<?php
include_once "models/Uploader.class.php";
$imageSubmitted = isset( $_POST['new-image'] );

if ( $imageSubmitted ) {
    $uploader = new Uploader( 'image-data' );
    $uploader->saveIn( "img" );
    try {
        $uploader->save();
        // stvorimo poruku za prijenos koja potvrđuje uspješan uspjeh
        $uploadMessage = "file uploaded!";
        // uhvatiti bilo koje izuzeće
    } catch ( Exception $exception ) {
        $uploadMessage = $exception->getMessage();
    }
}

$deleteImage = isset( $_GET['delete-image'] );
if ( $deleteImage ) {
    // zgrabite src slike za brisanje
    $whichImage = $_GET['delete-image'];
    //unlink- PHP funkcija za brisanje datoteke
    unlink($whichImage);
}

$imageManagerHTML = include_once "views/admin/images-html.php";
return $imageManagerHTML;

