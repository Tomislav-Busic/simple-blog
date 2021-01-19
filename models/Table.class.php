<?php
class Table {
    // obavijest zaštićena, nije privatna
    protected $db;

    public function __construct ( $db ) {
        $this->db = $db;
    }


    // obavijest zaštićena, nije privatna
    protected function makeStatement ( $sql, $data = null ){
        $statement = $this->db->prepare( $sql );
        try{
            $statement->execute($data);
        } catch ( Exception $e ){
            $exceptionMessage = "<p>You tried to run this sql: $sql</p>
                    <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }
        return $statement;
    }
}