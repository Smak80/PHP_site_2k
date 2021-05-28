<?php
include_once "a_content.php";


class a_page
{
    private $the_page;

    public function __construct(a_content $the_page){
        $this->the_page = $the_page;
        session_start();
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
        ?>
        <div class="menu">
            <?php
            $m = json_parser::get_full_info("menu.json");
            foreach ($m as $page_info){
                if (
                    "/".$page_info['addr'] === $_SERVER['PHP_SELF'] ||
                    ($page_info['addr'] === 'index.php' && $_SERVER['PHP_SELF'] === '/')
                ){
                    print ("<div class='current_menu_item'>{$page_info['name']}</div>");
                } else {
                    print ("<div class='menu_item'><a href='{$page_info['addr']}'>{$page_info['name']}</a></div>");
                }
            }
            ?>
        </div>
        <?php
    }

    private function show_content(){
        $this->the_page->show_content();
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
        $this->show_menu();
        $this->show_content();
        $this->show_footer();
        $this->finish_page();
    }
}