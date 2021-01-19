<?php

// uključiti definiciju klase i stvoriti objekt
include_once "models/Blog_Entry_Table.class.php";
$entryTable = new Blog_Entry_Table( $db );

// je li poslan obrazac za urednik?
$editorSubmitted = isset( $_POST['action']);
if ($editorSubmitted){
    $buttonClicked = $_POST['action'];
    $save = ( $buttonClicked === 'save');
    // novi kôd: dobivanje id-a unosa sa skrivenog input-a u editor form
    $id = $_POST['id'];
    $insertNewEntry = ( $save and $id === '0' );
    $deleteEntry = ( $buttonClicked === 'delete' );
    // ako je $insertNewEntry false, znate da entry_id NIJE 0
    // To se događa kada je u uređivaču prikazan postojeći unos
    // drugim riječima: korisnik pokušava spremiti postojeći unos
    $updateEntry = ( $save and $insertNewEntry === false );
    // dobivanje podataka o naslovu i unosu iz obrasca za uređivanje
    $title = $_POST['title'];
    $entry = $_POST['entry'];

    if ($insertNewEntry) {
        // uvedemo varijablu koja sadrži id spremljenog unosa
        $savedEntryId = $entryTable->saveEntry( $title, $entry );
    } else if ( $updateEntry ) {
        $entryTable->updateEntry( $id, $title, $entry );
        // u slučaju da je unos ažuriran
        // prepišite varijablu s ID-om ažuriranog unosa
        $savedEntryId = $id;
    } else if ( $deleteEntry ) {
        $entryTable->deleteEntry( $id );
    }
}
// uvodimo novu varijablu: dobivamo ID unosa s URL-a
$entryRequest = isset( $_GET['id'] );
if ( $entryRequest ) {
    $id = $_GET['id'];
    // model učitavanja postojećeg unosa
    $entryData = $entryTable->getEntry( $id );
    $entryData->entry_id = $id;
    // novi kôd: ne prikazuje poruku kad se unos učita u početku
    $entryData->message = "";
}

$entrySaved = isset( $savedEntryId );
if ( $entrySaved ) {
    $entryData = $entryTable->getEntry( $savedEntryId );
    // prikazuje poruku potvrde
    $entryData->message = "Entry was saved";
}

$editorOutput = include_once "views/admin/editor-html.php";
return $editorOutput;