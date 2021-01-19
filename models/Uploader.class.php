<?php
class Uploader{
    private $filename;
    private $fileData;
    private $destination;
    // novi kôd: dodajte svojstvo za poruku o pogrešci
    private $errorMessage;
    // novi kôd: dodajte svojstvo za standardne PHP kodove pogrešaka
    private $errorCode;

    public function __construct($key){
        $this->filename = $_FILES[$key]['name'];
        $this->fileData = $_FILES[$key]['tmp_name'];
        $this->errorCode = ( $_FILES[$key]['error'] );
    }

    public function saveIn($folder){
        $this->destination = $folder;
    }
    public function save (){
        // pozivamo novu metodu kako bismo tražili pogreške pri prijenosu
        // ako vrati TRUE, spremite prenesenu datoteku
        if ( $this->readyToUpload() ) {
            move_uploaded_file(
                $this->fileData,
                "$this->destination/$this->filename" );
        } else {
            // ako ne stvorimo iznimku - proslijedimo poruku o pogrešci kao argument
            $exc = new Exception( $this->errorMessage );
            throw $exc;
        }
    }

    private function readyToUpload(){
        $folderIsWriteAble = is_writable( $this->destination );
        if( $folderIsWriteAble === false ){
            // pružiti značajnu poruku o pogrešci
            $this->errorMessage = "Error: destination folder is ";
            $this->errorMessage .= "not writable, change premissions";
            // označavamo da kôd NIJE spreman za prijenos datoteke
            $canUpload = false;
        } else if ( $this->errorCode === 1 ) {
            $maxSIze = ini_get( 'upload_max_filesize' );
            $this->errorMessage = "Error: File is too big. ";
            $this->errorMessage .= "Max file size is $maxSIze";
            $canUpload = false;
            // ako je kôd pogreške veći od jednog, dogodila se neka druga pogreška
        } else if ( $this->errorCode > 1 ) {
            $this->errorMessage = "Something went wrong! ";
            $this->errorMessage .= "Error code: $this->errorCode";
            $canUpload = false;
        } else {
            //nema nikakve pogreške, spremno je za prijenos
            $canUpload = true;
        }
        return $canUpload;
    }
}