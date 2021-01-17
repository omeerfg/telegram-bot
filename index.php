<?php
require_once __DIR__."/class.telegram.php";
/**
 * I'm having fun, it's your turn
 * insta : https://instagram.com/omeerfg
 * twitter : https://twitter.com/omeeeerf
 * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
 * 
 * Below are some commands you can use
 */


$telegram = new TelegramBot();
$telegram->setWebhook("YOUR_WEBHOOK_ADRESS");/*DESCRIBED ONCE THEN HIDE*/
$telegram->setToken("YOUR_TOKEN");
$data = $telegram->getData();
$text = strtolower($data->text);

// --------------Default Methods---------------
if($text == '/DEFAULT_MESSAGE'){
	$telegram->sendMessage("DEFAULT_MESSAGE");
}
if($text == '/DEFAULT_PHOTO'){
	$telegram->sendPhoto("DEFAULT_PHOTO_URL");
}

/*

If there is no database, this area creates a txt file on your server and records the messages received for the request.

*/
$text = explode(" ", $text);
if($text[0] == '/FILE_NAME'){
    if (!(file_exists('FILE_NAME.txt'))) touch('FILE_NAME.txt');
    if(!empty($text[1])){
    $file = fopen('FILE_NAME.txt', 'a');
    $result = fwrite($file, "\n".'WHO :' .$data->from->first_name. "\t".'SUBJECT: '.$text[1]);
    fclose($file);
    if($result) $telegram->sendMessage('"'.$text[1].'" I got your message. Thanks!');
    else $telegram->sendMessage('Message Ok');
    }else $telegram->sendMessage('Message Don\'t Ok');
}


if($text == '/photo'){
    $data = $telegram->getRandomPhoto();
    $telegram->sendPhoto($data->download_url,$data->author);
}

if($text == '/food'){
    $telegram->sendPhoto($telegram->getFood());
}

if($text == '/help'){
    $telegram->sendMessage('YOUR_BOT_HELP_MESSAGE');
}

if($text == '/cat'){
    $cat = $telegram->getCat();
	$telegram->sendPhoto($cat[0],$cat[1]);
}

if($text == '/dog'){
    $dog = $telegram->getDog();
	$telegram->sendPhoto($dog);
}

