<?php
include_once "a_content.php";
include_once "a_page.php";

class second extends a_content
{

    public function show_content()
    {

    }
}

$p = new a_page(new second());
$p->create();