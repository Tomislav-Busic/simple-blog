<?php
if ( isset( $allEntries ) === false ) {
    trigger_error('views/admmin/entries-html.php needs $allEntries');
}

$entriesAsHTML = "<ul>";
while ( $entry = $allEntries->fetchObject() ) {
    // primijetimo da su dvije varijable URL kodirane u href-u
    $href = "admin.php?page=editor&amp;id=$entry->entry_id";
    $entriesAsHTML .= "<li><a href='$href'>$entry->title</a></li>";
}

$entriesAsHTML .= "</ul>";
return $entriesAsHTML;