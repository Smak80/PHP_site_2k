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
        $n_cols = 12;
        if (isset($_SESSION['logged_in'])){
            print ("Введите число(будут выведены все простые числа, меньшие его):");
            ?>
            <form action="third.php" method="post">
                <label>
                    Ввод:
                    <input type="text" name="num">
                </label>
                <input type="submit" value="Вывести">
            </form>
            <?php

            $num = $this->get_user_value('num');
            if (isset($num)) {
                $arr = $this->get_primes($num);
                $sz = sizeof($arr);
                print("<table><caption>Таблица простых щисел</caption>");
                $iter = 1;
                foreach($arr as $el){
                    print("<td>$el</td>");
                    if(!($iter % $n_cols)){
                        print("</tr>");
                    }
                    $iter++;
                }
                print("</table>");
            }
            print ("<br><a href='third.php?exit=1'>Выход</a>");
        } else {
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/auth.php");
        }
    }

    private function get_primes($num){
        $primes = array(2);
        $i = 3;
        $end = $num;
            while ($i <= $end) {
            while ($i <= $end){        
                $sqrt = ceil(sqrt($i));
                foreach  ($primes as $primus){
                $p = $i % $primus;            
                    if ($primus > $sqrt){
                        continue;
                    }
                    if ($p == 0){
                        break 2;
                    }
                }     
                $primes[] = $i;
                $primes = array_unique($primes);       
                $i+=2;        
            } 
            $i+=2;
        } 
        return $primes;
    }   
}

$p = new a_page(new third());
$p->create();