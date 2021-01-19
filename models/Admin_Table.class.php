<?php
include_once "models/Table.class.php";

class Admin_Table extends Table {
    public function create ( $email, $password ) {
        // provjeravamo je li e-pošta dostupna
        $this->checkEmail( $email );
        // šifriranje lozinke s MD5
        $sql = "INSERT INTO admin ( email, password )
                    VALUES( ?, MD5(?) )";
        $data = array( $email, $password );
        $this->makeStatement( $sql, $data );
    }

    private function checkEmail ($email) {
        $sql = "SELECT email FROM admin WHERE email = ?";
        $data = array( $email );
        $this->makeStatement( $sql, $data );
        $statement = $this->makeStatement( $sql, $data );
        // ako je korisnik s tom e-poštom pronađen u bazi podataka
        if ( $statement->rowCount() === 1 ) {
            $e = new Exception("Error: '$email' already used!");
            throw $e;
        }
    }

    public function checkCredentials ( $email, $password ){
        $sql = "SELECT email FROM admin
                WHERE email = ? AND password = MD5(?)";
        $data = array($email, $password);
        $statement = $this->makeStatement( $sql, $data);
        if ( $statement->rowCount() === 1 ) {
            $out = true;
        } else {
            $loginProblem = new Exception( "login failed!" );
            throw  $loginProblem;
        }
        return $out;
    }
}