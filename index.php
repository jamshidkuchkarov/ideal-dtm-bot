<?php
//files
require_once 'Telegram.php';
require_once 'User.php';
require_once "Pages.php";
require_once "Texts.php";

// super admin
$super_admin =1814409422;

//connect bot
$telegram = new Telegram('5876254576:AAEnCPGUsI6yQSW6CWYSwITz5esEP2GqP6c');


//query data
$callback_query = $telegram->Callback_Query();
$callback_data = $telegram->Callback_Data();

$text = $telegram->Text();
$data = $telegram->getData();
$chatID = $telegram->ChatID();
$first_name = $telegram->FirstName();
$last_name = $telegram->LastName();


$user = new User($chatID);
$texts = new Texts($user->getLanguage());
var_dump($texts->admins());
$status = $telegram->getChatMember([
    "user_id" => $chatID,
    "chat_id" => "@suuuu_public"
]);
if ($callback_query !== null && $callback_query != '') {
    $callback_data = $telegram->Callback_Data();
    $chatID = $telegram->Callback_ChatID();
    if(isContains($callback_data,'success')){
        if($status['result']['status']=='left'){
            is_channel('Siz hali a\'zo bo\'lmadingiz☝️');
        }
        else{
            showStart();
        }
    }
}
elseif($status['result']['status']!='left'){
    if ($text == '/start') {
        showStart();

    }else{
        switch ($user->getPage()){
            case Pages::START:
                switch ($text){
                    case "🇺🇿 O'zbekcha":
                        $user->setLanguage('uz');
                        $texts = new Texts($user->getLanguage());
                        showMainPage();
                        break;
                    case "🇷🇺 Русский":
                        $user->setLanguage('ru');
                        $texts = new Texts($user->getLanguage());
                        showMainPage();
                        break;
                    case "➕Admin Qo'shish":
                        showAdminName();
                        break;
                    default:
                        showStart();
                        break;
                }
                break;
            case "adminname":
                $user->setAdminName($text);
                showAdminId();
                break;
            case "adminId":
                $user->setAdminId($text);
                showAdmin();
                break;
            case Pages::PAGE_MAIN:
                switch ($text){
                    case $texts->getText('front'):
                        showTestPage();
                        break;
                    case $texts->getText("back_btn"):
                        showStart();
                        break;
                    default:
                        showMainPage();
                        break;
                }
                break;
            case Pages::PAGE_ADMIN:
                $answer ="abcabcabc";
                strtoupper($answer);
                strtoupper($user);
                $count = 0;
                for($i=0;$i<strlen($answer);$i++){
                    if($answer[$i]==$text[$i]){
                        $count++;
                    }
                }
                sendMessage($count);
                $datetime = new DateTime();
                sendMessage($datetime->format('F jS, Y'));

                break;


        }
    }
}else{
  is_channel("Kanalarimizga a'zo bo'ling ❌ ");
}
function showAdmin()
{
    sendMessage('salom');
}
function showAdminId(){
    global $texts,$user;
    $user->setPage('adminId');
    sendMessage("Adminning ID sini kiriting");
}
function showAdminName(){
     global $texts,$user;
     $user->setPage('adminname');
    sendMessage("Adminning ismini kiriting");
}
function is_channel($text,$edit=false){
    global $chatID,$telegram,$callback_query;
    $option = array(
        //First row
        array($telegram->buildInlineKeyBoardButton("Button 1", $url="https://t.me/edu_ideal"), $telegram->buildInlineKeyBoardButton("Button 2", $url="http://t.me/suuuu_public")),
        array($telegram->buildInlineKeyboardButton("A'zo bo'ldim ✅",'','success'))
 );
    $keyb = $telegram->buildInlineKeyBoard($option);
    if($edit){
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'reply_markup' => $keyb, 'text' => $text);
        $telegram->editMessageText($content);
    } else {
        $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text);
        $telegram->sendMessage($content);
    }


}
function showTestPage(){
    global $texts,$user;
    $user->setPage(Pages::PAGE_ADMIN);
    sendMessage("Javoblarni shu ko'inishda jo'nating 9888|abca....");
}

function showMainPage(){
 global $texts,$user,$charID;
    $user->setPage(Pages::PAGE_MAIN);
    $button = [$texts->getText('front')];
    sendTextWithKeyboard($button,$texts->getText('info'),true);

}
function sendMessage($text)
{
    global $telegram, $chatID;
    $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text]);
}
function showStart()
{
    global $user,$texts,$chatID,$super_admin;
    $user->setPage(Pages::START);
    $buttons = ["🇷🇺 Русский", "🇺🇿 O'zbekcha"];
    foreach ($texts->admins() as $item){
       if($item == $chatID){
           if($chatID == $super_admin){
               $buttons[]="➕Admin Qo'shish";
           }
            $buttons[] = "➕Test qo'shish";
        }
    }

    $textToSend = "Пожалуйста выберите язык. 👇\n\nIltimos, tilni tanlang. 👇";
    sendTextWithKeyboard($buttons, $textToSend);
}
function sendTextWithKeyboard($buttons, $text, $backBtn = false)
{
    global $telegram, $chatID, $texts;
    $option = [];
    if (count($buttons) % 2 == 0) {
        for ($i = 0; $i < count($buttons); $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
    } else {
        for ($i = 0; $i < count($buttons) - 1; $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
        $option[] = array($telegram->buildKeyboardButton(end($buttons)));
    }
    if ($backBtn) {
        $option[] = [$telegram->buildKeyboardButton($texts->getText("back_btn"))];
    }
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function isContains($string,$needle){
    return strpos($string,$needle) !==false;
}