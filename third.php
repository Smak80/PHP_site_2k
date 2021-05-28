<?php
include_once "a_content.php";
include_once "a_page.php";

class third extends a_content
{

    private $logged = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function show_content()
    {
        if (isset($_SESSION['logged_in'])){
            print ("AUTHORIZED USER");
        } else {
            print ("UNAUTHORIZED USER");
        }
    }
}

$p = new a_page(new third());
$p->create();