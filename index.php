<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1);
include_once "models/Page_Data.class.php";
$pageData = new Page_Data();
$pageData->title = "PHP/MYSQL blog";
$pageData->addCSS("css/blog.css");

$dbInfo = "mysql:host=localhost;dbname=simple_blog";
$dbUser = "root";
$dbPassword = "";
$db = new PDO( $dbInfo, $dbUser, $dbPassword );
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$pageRequest = isset( $_GET['page'] );
// zadani kontroler je blog
$controller = "blog";
if ( $pageRequest ) {
    // ako je korisnik poslao obrazac za pretraživanje
    if ( $_GET['page'] === "search" ) {
        // učitavanje pretraživanja prepisivanjem zadanog kontrolera
        $controller = "search";
    }
}
$pageData->content .= include_once "views/search-form-html.php";
$pageData->content .= include_once "controllers/$controller.php";


$page = include_once "views/page.php";
echo $page;