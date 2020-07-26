<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* blog.twig */
class __TwigTemplate_bee8ecac27f6ecbbb1fe180c367d5b205b6719218bb6c5923b18ee89c3b8aa99 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>БЛОГ</title>
</head>
<body>

<?php
/** @var \$message \\App\\Models\\Message */
/** @var \$user \\App\\Models\\User */
\$user = \$this->user;
?>
<div class=\"wrapper\">
    <header class=\"header\">
        <h1 class=\"title\">
            Добро пожаловать в блог <?php echo \$name = \$this->name ?> !
        </h1>
        <div class=\"links\">
            <div class=\"last\">
                <a href=\"/Index\">All messages </a>
            </div>
            <div class=\"last\">
                <a href=\"/Index/lastMessages\">3 last messages </a>
            </div>

            <div class=\"api\">
                <a href=\"/Api/getUserMessage/?id=<?= \$user->getId(); ?>\">Get the user's 5 last messages at JSON (API)</a>
            </div>
            <div >
                <a href=\"/index/exit\">Exit</a>
            </div>

        </div>


        <h2 class=\"title\">Список сообщений:</h2>
    </header>
    <section class=\"blog\">
        <?php if (\$messages = \$this->messages): ?>
        <?php foreach (\$messages as \$message): ?>
        <div class=\"message\">

            <div class=\"message__header\">
                <span class=\"date\"><?= \$message->getCreatedAt(); ?> </span>
                <? if (\$author = \$message->getAuthor()): ?>
                <span class=\"author\">Автор: <?= htmlspecialchars(\$author->getName()); ?></span>
                <? else: ?>
                <span class=\"author\">Сообщение от удаленного пользователя</span>
                <? endif; ?>
            </div>

            <div class=\"text\"><?= htmlspecialchars(nl2br(\$message->getText())); ?></div>

            <? if (\$message->getImage()): ?>
            <div class=\"picture\">
                <img class=\"picture__img\" src=\"/images/<?= \$message->getImage(); ?>\">
            </div>
            <? endif; ?>
            <? if (\$user->isAdmin()): ?>
            <div class=\"admin\">
                <a href=\"/index/deleteMessage/?id=<?= \$message->getId(); ?>\">delete</a>
            </div>
            <? endif; ?>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        Сообщений пока нет
        <?php endif; ?>

    </section>
    <section class=\"footer\">Добавить сообщение
        <form class=\"message-add\" enctype=\"multipart/form-data\" action=\"/Index/addMessage\" method=\"post\">
            <textarea class=\"add_text\" type=\"text\" value=\"\" name=\"text\"></textarea>
            <div>
                Изображение:
            </div>
            <input type=\"file\" name=\"image\"><br>
            <input class='button' type=\"submit\" value=\"Отправить\">
        </form>

    </section>
</div>
</body>
</html>
<style>
    * {
        box-sizing: border-box;
    }

    h1 {
        margin: 0;
        color: red;
    }

    h2 {
        margin: 0;
        color: blue;
    }

    .wrapper {
        height: 100vh;
        /*overflow: hidden;*/
        /*border: green 1px solid;*/
        display: flex;
        flex-direction: column;
        /*align-items: stretch;*/
    }

    .blog {
        width: 100%;
        /*min-height: 70vh;*/
        border: red 1px solid;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: auto;
        margin-bottom: 20px;


    }

    .footer {
        /*position: absolute;*/
        /*bottom: 0;*/
        /*border: blue 1px solid;*/
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 400px;
    }

    .header {
        width: 100%;
        height: 120px;
        margin-bottom: 20px;
    }
    .links {
        display: flex;
        justify-content: space-around;
        font-size: 24px;
        font-weight: bold;
    }
    .api {

        margin: 5px;
        text-align: right;
    }
    .last {

        margin: 5px;
        text-align: left;
    }

    .title {
        display: flex;
        justify-content: center;
    }


    .message__header {
        display: flex;
        justify-content: space-between;
    }


    form {

        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 150px;

    }

    .button {
        border: none;
        padding: 10px;
    }

    .button:hover {
        background-color: #ccc;
    }

    .message {
        margin: 5px 0 0 5px;
        padding: 10px;
        border: 1px solid grey;
        width: 450px;
        display: flex;
        flex-direction: column;
    }

    .message-add {

        display: flex;
        flex-direction: column;
        width: 450px;
        height: 200px;

    }

    .add_text {
        width: 100%;
        min-height: 100px;
        margin-bottom: 10px;
    }

    .author {
        margin-left: 10px;
        font-size: 14px;
    }

    .text {
        padding: 15px;
    }

    .date {
        text-align: right;
        color: grey;
        font-size: 14px;
    }

    .admin {
        text-align: right;
    }

    .picture {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
    }

    .picture__img {
        display: block;;
        width: 100%;
        height: 100%;
        object-fit: fill;
    }

</style>

";
    }

    public function getTemplateName()
    {
        return "blog.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "blog.twig", "W:\\domains\\mvc\\App\\Templates\\User\\blog.twig");
    }
}
