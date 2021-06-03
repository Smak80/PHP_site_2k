<?php
include_once "a_content.php";
include_once "a_page.php";

class autorizer{

    private $user_data;

    public function __construct($data)
    {
        $this->user_data = $data;
    }

    public function is_data_sent(): bool{
        return isset($this->user_data['login'])
            && isset($this->user_data['password']);
    }

    public function is_autorized_user(): bool{
        $filename = "users3.dat";
        $res = false;
        if (is_readable($filename)) {
            $f = fopen($filename, "r");
            while ($s = fgets($f)){
                $sa = mb_split("\\s", $s);
                if (strcmp($sa[0], $this->user_data['login'])===0){
                    $res = password_verify($this->user_data['password'], $sa[1]);
                    break;
                }
            }
            fclose($f);
        }
        return $res;
    }

}


class auth extends a_content
{

    private $auth;
    private $not_auth;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new autorizer($this->request);
        if ($this->auth->is_data_sent())
            $this->not_auth = !$this->auth->is_autorized_user();
        if (isset($this->not_auth) && !$this->not_auth) {
            $_SESSION['logged_in'] = 1;
            header("Location: third.php");
        }
    }

    public function show_content()
    {
        if (isset($this->not_auth) && $this->not_auth){
            print ("<div class='err_msg'>Неверный логин или пароль.</div>");
        }
        print ("Введите данные для входа:");
        ?>
        <form action="auth.php" method="post">
            <label>
                Логин:
                <input type="text" name="login">
            </label>
            <br>
            <label>
                Пароль:
                <input type="password" name="password">
            </label>
            <br>
            <input type="submit" value="Авторизоваться">
        </form>
        <?php
    }
}

$p = new a_page(new auth());
$p->create();