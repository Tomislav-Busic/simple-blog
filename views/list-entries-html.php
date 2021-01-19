<?php
$entriesFound = isset($entries);
if( $entriesFound === false ){
    trigger_error('views/list-entries-html.php');
}
$entriesHTML = "<ul id='blog-entries'>";
// $entry bit će objekt StdClass s entry_id, title i intro
while ($entry = $entries->fetchObject()){
    $href = "index.php?page=blog&amp;id=$entry->entry_id";
    $entriesHTML .= "<li>
        <h2>$entry->title</h2>
        <div>$entry->intro
            <p><a href='$href'>Read more</a></p>
        </div>
    </li>";
}
$entriesHTML .= "</ul>";
return $entriesHTML;