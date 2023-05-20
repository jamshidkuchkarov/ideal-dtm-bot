<?php
//files (okUJB)rbERz
require_once 'Telegram.php';
require_once 'User.php';
require_once "Pages.php";
require_once "Texts.php";
//e3rvykeac3zqb65z60
// super admin
$user1 = new User('1814409422');
//salom
$Super_Admin =18144094222;
echo "<pre>";
var_dump(count($user1->getUsers()));
echo "<pre/>";

//connect bot
$telegram = new Telegram('5940929059:AAGfy3ZrGH7MxaV4o2HqK_vkLHllT_hl8I4');


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
$subjects = [$texts->getText('zavuch'),$texts->getText('teacher'),$texts->getText('worker')];
//$status = $telegram->getChatMember([
//    "user_id" => $chatID,
//    "chat_id" => "@suuuu_public"
//]);
//if ($callback_query !== null && $callback_query != '') {
//    $callback_data = $telegram->Callback_Data();
//    $chatID = $telegram->Callback_ChatID();
//    if(isContains($callback_data,'success')){
//        if($status['result']['status']=='left'){
//            is_channel('Siz hali a\'zo bo\'lmadingiz☝️');
//        }
//        else{
//            showStart();
//        }
//    }
//}
//elseif($status['result']['status']!='left'){
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
                    default:
                        showStart();
                        break;
                }
                break;
            case Pages::PAGE_MAIN:
                switch ($text){
                    case $texts->getText('register'):
                    showJobs();
                    break;
                    case 'O\'qtuvchilarni malumoti 📄' :
                        $telegram->sendDocument(['chat_id' => 1814409422, 'document' => 'https://botuzrobot.uz/xususiy/print.pdf']);
                        break;
                    case "Userlar soni":
                        sendMessage(count($user1->getUsers()));
                        break;
                    default:
                        showMainPage();
                    break;
                }
                break;
            case Pages::JOB:
               if(in_array($text,$subjects)){
                   $user->setSubject($text);
                  showFullName();
               }
               else{
                   showJobs();
               }
                break;
            case Pages::FULL_NAME:
              $user->setFirstName($text);
              showMap();
               break;
            case Pages::MAP:
                $user->setMap($text);
                showUniversty();
                break;
            case Pages::PAGE_UNI:
                $user->setUniver($text);
                showYear();
                break;
            case Pages::YEAR:
                $user->setYear($text);
                showSubjectYear();
                break;
            case Pages::SUBJECT_YEAR:
                $user->setYearSubject($text);
                showCourse();
                break;
            case Pages::COURSE:
              if($user->getSubject() == $texts->getText('zavuch')){
                  $user->setZavuchYear($text);
                  showPhone();
              }
              else{
                  $user->setCourse($text);
                  showPhone();
              }
                break;
            case Pages::PHONE:
                $user->setPhoneNumber($text);
                showAddPhone();
                break;
            case Pages::ADD_PHONE:
                $user->setAddPhone($text);
                showLanguange();
                break;
            case Pages::SHOW_LANG:
                $user->setShowLang($text);
                showRegistred();
                break;
            case Pages::REGISTRED:
                switch ($text){
                    case $texts->getText('retry'):
                        showJobs();
                        break;
                    default:
                        showRegistred();


                }
                break;


        }
    }
function showLanguange(){
    global $user,$texts;
    $user->setPage(Pages::SHOW_LANG);
    $text = $texts->getText('showlang');
    sendMessage($text);
}
function showAddPhone(){
    global $user,$texts;
    $user->setPage(Pages::ADD_PHONE);
    $text = $texts->getText('addphone');
    sendMessage($text);
}
function showRegistred(){
    global $user,$texts;
    $user->setPage(Pages::REGISTRED);
    $buttons = [$texts->getText('retry')];
    $text  = $texts->getText('registred');
    sendTextWithKeyboard($buttons,$text);
    sendMessage($texts->getText('warning_text'));

}
function showPhone(){
    global $user,$texts;
    $user->setPage(Pages::PHONE);
    $text = $texts->getText('phone');
    sendMessage($text);
}
function showCourse(){
    global $user,$texts;
    $user->setPage(Pages::COURSE);
    if($user->getSubject() == $texts->getText('zavuch')){
        $text = $texts->getText('zavuch_year');
        sendMessage($text);
    }
    else{
        $text = $texts->getText('course');
        sendMessage($text);
    }

}
function showSubjectYear(){
    global $user,$texts;
    $user->setPage(Pages::SUBJECT_YEAR);
    $text = $texts->getText('subject');
    sendMessage($text);
}
function showYear(){
    global $user,$texts;
    $user->setPage(Pages::YEAR);
    $text = $texts->getText('year');
    sendMessage($text);
}
function showUniversty(){
    global $user,$texts;
    $user->setPage(Pages::PAGE_UNI);
    $text = $texts->getText('university');
    sendMessage($text);

}
function showStart()
{
    global $user,$texts,$chatID,$super_admin;
    $user->setPage(Pages::START);
    $buttons = ["🇷🇺 Русский", "🇺🇿 O'zbekcha"];
    $textToSend = "Пожалуйста выберите язык. 👇\n\nIltimos, tilni tanlang. 👇";
    sendTextWithKeyboard($buttons, $textToSend);
}

function showMainPage(){
    global $chatID,$user,$texts,$Super_Admin,$telegram;
    $user->setPage(Pages::PAGE_MAIN);
    if($chatID == $Super_Admin){
        $button = ['O\'qtuvchilarni malumoti 📄','Userlar soni'];
    }
    else{
        $button = [$texts->getText('register')];
    }
    $textToSend = $texts->getText('info');
    sendTextWithKeyboard($button,$textToSend);

}
function showJobs(){
    global $user,$texts,$text,$subjects;
    $user->setPage(Pages::JOB);
    $buttons = $subjects ;
    $text = $texts->getText('choose_job');
    sendTextWithKeyboard($buttons,$text,'',true);


}
function showFullName(){
    global $chatID,$user,$texts;
    $user->setPage(Pages::FULL_NAME);
    $text = $texts->getText('fish');
    sendMessage($text);
    sendMessage($texts->getText('exam'));
}


function showMap(){
    global $chatID,$user,$texts;
    $user->setPage(Pages::MAP);
    $text = $texts->getText('house');
    sendMessage($text);


}
function is_channel($text,$edit=false){
    global $chatID,$telegram,$callback_query;
    $option = array(
        //First row
        array( $telegram->buildInlineKeyBoardButton("Darslar", $url="http://t.me/suuuu_public")),
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
//salom

function sendMessage($text)
{
    global $telegram, $chatID;
    $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text]);
}

function sendTextWithKeyboard($buttons, $text, $backBtn = false,$remove = false)
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
    $keyboard = $telegram->buildKeyBoard($option, $onetime = $remove, $resize = true,);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function isContains($string,$needle){
    return strpos($string,$needle) !==false;
}