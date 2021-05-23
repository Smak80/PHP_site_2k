<?php
include_once "a_content.php";

class page
{
    private $the_page;

    public function __construct(a_content $the_page){
        $this->the_page = $the_page;
    }

    private function start_page(){
        ?>
        <html lang="ru">
        <head>
            <title>
                <?php
                print $this->the_page->get_title();
                ?>
            </title>
            <link rel="stylesheet" href="main.css">
        </head>
        <body>
        <?php
    }

    private function show_title(){
        ?>
        <div class="title">
            <?php print $this->the_page->get_title(); ?>
        </div>
        <?php
    }

    private function show_menu(){

    }

    private function show_content(){

    }

    private function show_footer(){

    }

    private function finish_page(){
        ?>
        </body></html>
        <?php
    }

    public function create(){
        $this->start_page();
        $this->show_title();

        $this->finish_page();
    }
}