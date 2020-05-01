<?php

header('Content-Type: text/html; charset=utf-8');

// подрубаем API
require_once("vendor/autoload.php");

// создаем переменную бота
$token = "1092442739:AAGTQJxfxzbHfDTxPJQDihun8zAZcP26lTc";
$bot = new \TelegramBot\Api\Client($token);

// если бот еще не зарегистрирован - регистрируем
if (!file_exists("registered.trigger")) {
    /**
     * файл registered.trigger будет создаваться после регистрации бота.
     * если этого файла нет значит бот не зарегистрирован
     */

    // URl текущей страницы
    $page_url = "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $result = $bot->setWebhook($page_url);
    if ($result) {
        file_put_contents("registered.trigger", time()); // создаем файл дабы прекратить повторные регистрации
    }
}

// обязательное. Запуск бота
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $name = "Привет" . " " . $message->getChat()->getFirstName() . " " . $message->getChat()->getLastName();
    $bot->sendMessage($message->getChat()->getId(), $name);
});

// помощ
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - помощ';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// общение
$bot->on(function ($Update) use ($bot) {
    $message = $Update->getMessage();
    $mtext = $message->getText();
    $cid = $message->getChat()->getId();

    // connect db
    $servername = "localhost";
    $username = "u936519911_adm";
    $password = "ZfnFATK";
    $dbname = "u936519911_adm";

    // Create connection
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sqlSelect = "SELECT * FROM questions_answers WHERE question = '{$mtext}'";
    $result = $db->query($sqlSelect);
    if (!empty($result)) {
        foreach ($result
                 as $row) {
            $answer = $row['answer'];
            $bot->sendMessage($message->getChat()->getId(), $answer);
        }
    }
    mysqli_close($db);
    //end connect db

//    if (mb_stripos($mtext, ":-(") !== false) {
//
//        $bot->sendMessage($message->getChat()->getId(), $anwser);
//    }

    if (mb_stripos($mtext, "добрый день") !== false) {
        $bot->sendMessage($message->getChat()->getId(), "Что Вас интересует?");
    }

}, function ($message) use ($name) {
    return true; // когда тут true - команда проходит
});

// запускаем обработку
$bot->run();





