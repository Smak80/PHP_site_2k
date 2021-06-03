<?php
include_once "a_content.php";
include_once "a_page.php";

class third extends a_content
{

    private $logged = false;

    public function __construct()
    {
        parent::__construct();
        $this->try_logout();
    }

    private function try_logout(){
        if ($this->get_user_value('exit')!=null){
            unset($_SESSION['logged_in']);
        }
    }

    public function show_content()
    {
        if (isset($_SESSION['logged_in'])){
            print ("AUTHORIZED USER");
            print ("<br><a href='third.php?exit=1'>Выход</a>");
        } else {
            print ("UNAUTHORIZED USER");
        }
    }
}

$p = new a_page(new third());
$p->create();