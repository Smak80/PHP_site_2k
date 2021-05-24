<?php


abstract class a_content
{
    protected $title;
    private $request = array();

    public function __construct(){
        $this->get_user_data();
    }

    private function get_user_data()
    {
        foreach ($_REQUEST as $key=>$req){
            $this->request[$key] = htmlspecialchars($req);
        }
    }

    public function get_user_value($key){
        if (isset($this->request[$key]))
            return $this->request[$key];
        return null;
    }

    public function get_title(){
        return $this->title;
    }

    public abstract function show_content();
}