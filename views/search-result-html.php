<?php
$searchDataFound = isset( $searchData );
if ( $searchDataFound === false ) {
    trigger_error('views/search-results-html.php needs $searchData');
}

$searchHTML = "<section id='search'> <p>
    You searched for <em>$searchTerm</em></p><ul>";

while ( $searchRow = $searchData->fetchObject() ){
    $href = "index.php?page=blog&amp;id=$searchRow->entry_id";
    $searchHTML .= "<li><li href='$href'>$searchRow->title</li>";
}

$searchHTML .= "</ul></section>";
return $searchHTML;