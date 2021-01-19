<?php
class Blog_Entry_Table {
    private $db;

    public function __construct( $db ) {
        $this->db = $db;
    }

    public function saveEntry ( $title, $entry ) {
        // primijetiti rezervirana mjesta u SQL nizu. ? je rezervirano mjesto
        $entrySQL = "INSERT INTO blog_entry ( title, entry_text )
                     VALUES ( ?, ?)";
        // stvoriti niz s dinamičkim podacima
        // Redoslijed je važan: $title mora biti na prvom mjestu, $entry na drugom mjestu
        $formData = array( $title, $entry );
        // $this-> makeStatement poziva makeStatement od Blog_Entry_Table
        $entryStatement = $this->makeStatement( $entrySQL, $formData );
        // vratimo entry_id spremljenog unosa
        return $this->db->lastInsertId();
    }

    public function getAllEntries() {
        $sql = "SELECT entry_id, title,
                    SUBSTRING(entry_text, 1, 150) AS intro FROM blog_entry";
        $statement = $this->makeStatement( $sql );
        return $statement;
    }

    //možete deklarirati metodu koja uzima argument entry_id i vraća StdClass objekt sa svim sadržajem za odgovarajući zapis na blogu
    public function getEntry($id) {
        $sql = "SELECT entry_id, title, entry_text, date_created
                FROM blog_entry
                WHERE entry_id = ?";
        $data = array($id);
        $statement = $this->makeStatement( $sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    public function deleteEntry ( $id ) {
        // novi kod: izbrišite sve komentare prije brisanja unosa
        $this->deleteCommentsByID( $id );
        $sql = "DELETE FROM blog_entry WHERE entry_id = ?";
        $data = array( $id );
        $statement = $this->makeStatement( $sql, $data);
    }

    private function deleteCommentsByID( $id ) {
        include_once "models/Comment_Table.class.php";
        $comments = new Comment_Table( $this->db );
        // izbriši sve komentare prije brisanja unosa
        $comments->deleteByEntryId( $id );
    }

    public function updateEntry ( $id, $title, $entry ) {
        $sql = "UPDATE blog_entry
                SET title = ?,
                entry_text = ?
                WHERE entry_id = ?";
        $data = array( $title, $entry, $id );
        $statement = $this->makeStatement( $sql, $data );
        return $statement;
    }

    //$ sql argument mora biti SQL niz
    // $data moraju biti niz dinamičkih podataka za upotrebu u SQL-u
    private function makeStatement( $sql, $data = NULL ) {
        // stvorimo objekt PDOStatement
        $statement = $this->db->prepare($sql);
        try{
            // koristimo dinamičke podatke i pokrenimo upit
            $statement->execute($data);
        } catch (Exception $e){
            $exceptionMessage = "<p>You tried to run this sql: $sql</p>
                      <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }
        // vraća objekt PDOStatement
        return $statement;
    }

    public function searchEntry ( $searchTerm ) {
        $sql = "SELECT entry_id, title FROM blog_entry
                WHERE title LIKE ?
                OR entry_text LIKE ?";
        $data = array ( "%$searchTerm%", "%$searchTerm%" );
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }
}
