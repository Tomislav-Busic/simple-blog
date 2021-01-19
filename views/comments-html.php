<?php
$commentsFound = isset( $allComments );
if($commentsFound === false){
    trigger_error('views/comments-html.php needs $allComments' );
}

$allCommentsHTML = "<ul id='comments'>";
// prelistavanje svih redaka vraćenih iz baze podataka
while ( $commentData = $allComments->fetchObject() ) {
    // primijetiti operator inkrementalnog spajanja .=
    // dodaje <li> elemente u <ul>
    $allCommentsHTML .= "<li>
       $commentData->author wrote:
       <p>$commentData->txt</p>
    </li>";
}
$allCommentsHTML .= "</ul>";
return $allCommentsHTML;