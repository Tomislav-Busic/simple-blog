<?php
include_once "models/Blog_Entry_Table.class.php";
$entryTable = new Blog_Entry_Table($db);
// dobiti objekt PDOStatement za pristup svim unosima
$allEntries = $entryTable->getAllEntries();

$entriesAsHTML = include_once "views/admin/admin-entries.php";
return $entriesAsHTML;