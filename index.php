<?php
include_once "a_content.php";
include_once "page.php";

class index extends a_content {
   protected $title = "Главная страница";
}

$p = new page(new index());
$p->create();
?>