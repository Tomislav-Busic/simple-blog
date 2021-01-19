<?php
class Page_Data {
    public $title = "";
    public $content = "";
    public $css = "";
    public $embeddedStyle = "";
    public $javaScript = "";

    public function addCSS($href){
        $this->css .= "<link href='$href' rel='stylesheet'>";
    }

    public function addJS($src){
        $this->javaScript .= "<script src='$src'></script>";
    }
}
