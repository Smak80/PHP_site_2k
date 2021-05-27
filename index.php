<?php
include_once "a_content.php";
include_once "a_page.php";
include_once "json_parser.php";

class index extends a_content {

    public function show_content()
    {
        ?>
        <form action="index.php" method="post">
            <label>
                Введите какие-нибудь данные:
                <input type="text" value="SomeData" name="data">
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

$p = new a_page(new index());
$p->create();
?>