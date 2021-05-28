<?php
include_once "a_content.php";
include_once "a_page.php";

class registrator{

    private $user_data;

    public function __construct($data)
    {
        $this->user_data = $data;
    }

    public function is_data_sent(): bool{
        return isset($this->user_data['login'])
            && isset($this->user_data['password'])
            && isset($this->user_data['password2']);

    }

    public function is_user_exists(){

    }

    public function save_data(){
        $filename = "users.dat";
        if (!file_exists($filename) || is_writable($filename)) {
            $psw = password_hash($this->user_data['password'], PASSWORD_DEFAULT);
            $f = fopen($filename, "a");
            if ($f != null) {

                fwrite($f, $this->user_data['login'] . " ");
                fwrite($f, $psw."\r\n");
                fclose($f);
            }
        }
    }

    public function is_passwords_correct(){
        return $this->is_data_sent()
            && mb_strlen($this->user_data['password']>=6)
            && $this->user_data['password'] === $this->user_data['password2'];
    }

    public function authenticate($psw): bool{
        $filename = "users.dat";
        $res = false;
        if (is_readable($filename)) {
            $f = fopen($filename, "r");
            while ($s = fgets($f)){
                $sa = mb_split("\\s", $s);
                if (strcmp($sa[0], "smaklets")===0){
                    $res = password_verify($psw, $sa[1]);
                }
            }
            fclose($f);
        }
        return $res;
    }
}

class second extends a_content
{

    private $reg;

    public function __construct()
    {
        parent::__construct();
        $this->reg = new registrator($this->request);
    }

    public function show_content()
    {
        if ($this->reg->is_data_sent()){
            if (!$this->reg->is_passwords_correct()){
                print ("<div class='err_msg'>Проверьте ввод паролей.</div>");
            } else {
                $this->reg->save_data();
                if ($this->reg->authenticate("111111")){
                    print("<br>PSW OK!<br>");
                    $_SESSION["logged_in"] = "true";
                }
            }

        }
        print ("Регистрация пользователя:");
        ?>
        <form action="second.php" method="post">
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
            <label>
                Повтор пароля:
                <input type="password" name="password2">
            </label>
            <input type="submit" value="Отправить">
        </form>
        <?php
        $data = $this->get_user_value('data');
        if (isset($data)) {
            print("Пользователь отправил: $data");
        }
    }
}

$p = new a_page(new second());
$p->create();