<?php
include_once "models/Comment_Table.class.php";
// stvorimo novi objekt, proslijedimo mu PDO objekt veze baze podataka
$commentTable = new Comment_Table($db);

$newCommentSubmitted = isset( $_POST['new-comment'] );
if ( $newCommentSubmitted ) {
    $witchEntry = $_POST['entry-id'];
    $user = $_POST['user-name'];
    $comment = $_POST['new-comment'];
    $commentTable->saveComment( $witchEntry, $user, $comment );
}

$comments = include_once "views/comment-form-html.php";
$allComments = $commentTable->getAllById( $entryId );
$comments .= include_once "views/comments-html.php";
return $comments;
