<?php
$admin = "1814409422";
$token = '5486259319:AAEIB-ix0pJsj1CVBzZE3304qiyvtlgJvBs';
$mybot="MathsOnlineBot";

function bot($method,$datas=[]){
    global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


function del($nomi){
    array_map('unlink', glob("$nomi"));
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$callcid = $update->callback_query->message->chat->id;
$calltext = $update->callback_query->message->text;$edit = $message->edit_date->text;
$clid = $update->callback_query->from->id;
$callmid = $update->callback_query->message->message_id;
$gid = $update->callback_query->message->chat->id;
$photo = $update->message->photo;
$data = $update->callback_query->data;
$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id;
$ctext = $update->callback_query->message->text;
$callfrid = $update->callback_query->from->id;
$callfname = $update->callback_query->from->first_name;
$calltitle = $update->callback_query->message->chat->title;
$calluser = $update->callback_query->message->chat->username;
$query = $update->inline_query->query;
$infid = $update->inline_query->from->id;
$inid = $update->inline_query->id;
$incid = $update->inline_query->chat->id;
$inmid = $update->inline_query->message->id;
$botim = "@$mybot";
$qid = $update->callback_query->id;
$bot = bot('getme',['bot'])->result->username;
mkdir("step");
mkdir("step/$cid");
mkdir("tests");
mkdir("tests/azolar");
mkdir("ismlar");
mkdir("ismlar/aktivlik");
mkdir("testlar");
mkdir("testlar/$cid");
mkdir("idlar");
mkdir("orinlar");
mkdir("orinlar/orin_1");
mkdir("orinlar/orin_2");
mkdir("orinlar/orin_3");
mkdir("orinlar/orin");
mkdir("orinlar/orin_id1");
mkdir("orinlar/orin_id2");
mkdir("orinlar/orin_id3");
mkdir("orinlar/orin_id");
mkdir("idlar/ismlar");
mkdir("natija");
$step=file_get_contents("step/$cid.txt");
$step2=file_get_contents("step/$callcid.txt");
$kodi=file_get_contents("step/code.txt");
$id=file_get_contents("step/codes.txt");
$ism=file_get_contents("ismlar/$cid.txt");
$ism1=file_get_contents("ismlar/$callcid.txt");
$vaqt = date('H:i:s', strtotime('5 hour'));
$sana = date('d.m.Y', strtotime('5 hour'));
$fannomi=file_get_contents("step/$kodi.txt");
$tests=file_get_contents("tests/$kodi.txt");
$testadmin=file_get_contents("testlar/$kodi.txt");

$azo=file_get_contents("lichka.db");
if($type=="private"){
    if(strpos($azo,"$cid") !==false){
    }else{
        file_put_contents("lichka.db","$azo\n$cid");
    }
}



if($text=="/start@$mybot" or $text=="/start" or mb_stripos($text,"qwertyuiop")!==false){
    if($ism==false){
        file_put_contents("step/$cid.txt","ism");
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Ismingizni kiriting!!!
misol: Akbarxon Komilov</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
                'remove_keyboard'=>true,
            ]),
        ]);
    }else{
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"👋🏻<b>Assalomu alaykum</b> <a href='tg://user?id=$cid'>$ism</a>, <b>Xush kelibsiz!
Bu bot online testlar uchun
yaratilgan ☝🏻</b>

👨🏻‍💻 Yaratuvchi: <a href='tg://user?id=1919193948'>Yaratuvchi</a>
👨🏻‍🏫 Oʻqituvchi : <a href='tg://user?id=ADMIN_ID'>EGA</a>

<b>🖊️ Ismingizni uzgartirish uchun</b>
/ismuzgartirish <b>ni bosing.</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode' => 'html',
            'reply_markup'=>json_encode([
                'remove_keyboard'=>true,
                'inline_keyboard'=>[
                    [['text'=>"Test yaratish", 'callback_data'=>"new"]],
                    [['text'=>"Javoblar tekshirish", 'callback_data'=>"tek"]],
                ]
            ])
        ]);
    }}

if($step=="ism"){
    $w = str_replace(["ʻ","ʼ"],["",""], $text);
    if(str_word_count($w)=="2" and strlen($text)<"50"){
        file_put_contents("ismlar/$cid.txt",$text);
        file_put_contents("step/$cid.txt","");
        bot('deleteMessage',[
            'chat_id'=>$cid,
            'message_id'=>$mid-1,
        ]);
        bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Ism saqlandi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
                'remove_keyboard'=>true,
            ]),
        ]);
        bot('SendMessage',[
            'chat_id'=>$cid,
            'text'=>"👋🏻<b>Assalomu alaykum</b> <a href='tg://user?id=$cid'>$text</a>, <b>Xush kelibsiz!
Bu bot online testlar uchun 
yaratilgan ☝🏻</b>

👨🏻‍💻 Yaratuvchi: <a href='tg://user?id=1814409422'>Yaratuvchi</a>
👨🏻‍🏫 Oʻqituvchi : <a href='tg://user?id=ADMIN_ID'>EGA</a>

<b>🖊️ Ismingizni uzgartirish uchun</b>
/ismuzgartirish <b>ni bosing.</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode' => 'html',
            'reply_markup'=>json_encode([
                'remove_keyboard'=>true,
                'inline_keyboard'=>[
                    [['text'=>"Test yaratish", 'callback_data'=>"new"]],
                    [['text'=>"Javoblar tekshirish", 'callback_data'=>"tek"]],
                ]
            ])
        ]);
    }else{
        bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Xatolik faqat Ism va familiya</b>

<u>namuna: Sodiqov Shoxrux</u>
<i>Qayta urunib koʻring!</i>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode'=>'html',
        ]);
    }}



if($data=="new"){
    file_put_contents("step/$callcid.txt","new");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"<b>Yaratish uchun quyidagi amallarni bajaring</b>
        
<i>misol: fan_nomi*javob_lar</i>

<code>namuna: Biologiya*abacdcbac....</code>

<b>Shu koʻrinishda yozing.</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]]
            ]
        ])
    ]);
}

if($data=="tek"){
    file_put_contents("step/$callcid.txt","tek");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"<b>Javoblarni tekshirish uchun quyidagi amallarni bajaring</b>

<i>misol: test_kodi*javoblar</i>

<code>namuna: 1234*abcabadacb...</code>

<b>Shu koʻrinishda yoʻboring.</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]]
            ]
        ])
    ]);
}



if($data=="bosh"){
    file_put_contents("step/$callcid.txt"," ");
    bot('editMessageReplyMarkup',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'inline_query_id'=>$qid,
    ]);
    bot('sendMessage',[
        'chat_id'=>$callcid,
        'text'=>"👋🏻<b>Assalomu alaykum</b> <a href='tg://user?id=$callcid'>$ism1</a>, <b>Xush kelibsiz!
Bu bot online testlar uchun
yaratilgan ☝🏻</b>

👨🏻‍💻 Yaratuvchi: <a href='tg://user?id=1919193948'>Yaratuvchi</a>
👨🏻‍🏫 Oʻqituvchi : <a href='tg://user?id=ADMIN_ID'>EGA</a>
🤖Hostingsiz bot yaratish: @XvesXosting_RuBot
<b>🖊️ Ismingizni uzgartirish uchun</b>
/ismuzgartirish <b>ni bosing.</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Test yaratish", 'callback_data'=>"new"]],
                [['text'=>"Javoblar tekshirish", 'callback_data'=>"tek"]],
            ]
        ])
    ]);
}

if($text=="/ismuzgartirish"){
    file_put_contents("step/$cid.txt","ism");
    bot('deleteMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid-1,
    ]);
    bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>Yangi ism kiriting.
namuna: Sodiqov Shoxrux</b>

<i>Eslatma bu ism sertifikatga tushiriladi.
Iltimos toʻgʻri yozing!</i>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
            ]
        ])
    ]);
}



if($step=="new" and isset($text)){
    $ex = explode("*",$text);
    $fan = strtoupper("$ex[0]");
    $var = strtolower("$ex[1]");
    file_put_contents('step/code.txt',file_get_contents('step/code.txt') + 1);
    file_put_contents("tests/$kodi.txt",$var);
    file_put_contents("step/$kodi.txt",$fan);
    $soni=strlen("$var");
    file_put_contents('step/codes.txt',"$id\n$kodi");
    file_put_contents("testlar/$kodi.txt",$cid."_$ism");
    bot('deleteMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid-1,
    ]);
    bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>Test bazaga qushildi</b>
	
<i>Fan nomi: $fan</i>

<i>Testlar soni: $soni ta</i>
	
<i>Test kodi:</i> <code>$kodi</code>
	
<b>Test ishlanishga tayyor!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                [['text'=>'Testni yuborish','switch_inline_query'=>"id_raqam+$kodi"]],
            ]
        ])
    ]);
    file_put_contents("step/$cid.txt"," ");
}


if($step=="tek"){
    $ex=explode("*",$text);
    $idlar=file_get_contents("idlar/$ex[0].txt");
    if(mb_stripos($idlar,"$cid") !== false){
        bot('deleteMessage',[
            'chat_id'=>$cid,
            'message_id'=>$mid-1,
        ]);
        bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>"<b>Bu testga siz javob berib boʻlgansiz!</b>

<i>Bitta testga faqat bir marta javob berish mumkin</i>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                ]
            ])
        ]);
    }}

if($step=="tek" and isset($text)){
    $ex = explode("*",$text);
    $idlar=file_get_contents("idlar/$ex[0].txt");
    if(mb_stripos($idlar,$cid) !== false){
    }else{
        if(mb_stripos($id,"$ex[0]")!==false){
            $ev = explode("$ex[0]",$id);
            $var = strtolower("$ex[1]");
            $varsoni = strlen("$var");
            $teslar=file_get_contents("tests/$ex[0].txt");
            file_put_contents("step/$cid.txt","");
            $to=0;
            $a = 1;
            $b=1;
            $vars = strlen("$teslar");
            for($i = 0; $i <= $vars - 1; $i++){
                if(substr(strtolower($ex[1]),$i,1)==substr($teslar,$i,1)){
                    file_put_contents("testlar/$cid/$ex[0].txt",$b++.".   Toʻgʻri   ".substr($ex[1],$i,1)."   ✅\n");
                    file_put_contents("natija/$ex[0].txt",$a++.".   Toʻgʻri   ".substr($ex[1],$i,1)."|[".substr($teslar,$i,1)."] ✅\n");
                    $to = $to + 1;
                    $ste.=file_get_contents("natija/$ex[0].txt");
                    $tex.=file_get_contents("testlar/$cid/$ex[0].txt");
                }else{
                    file_put_contents("testlar/$cid/$ex[0].txt",$b++.".   Xato      ".substr($ex[1],$i,1)."   ❌\n");
                    file_put_contents("natija/$ex[0].txt",$a++.".   Xato      ".substr($ex[1],$i,1)."|[".substr($teslar,$i,1)."] ❌\n");
                    $ste.=file_get_contents("natija/$ex[0].txt");
                    $tex.=file_get_contents("testlar/$cid/$ex[0].txt");
                } }
            file_put_contents("step/$cid/$ex[0].txt",$ste);
            $testadminid=file_get_contents("testlar/$ex[0].txt");
            $x=$to/$vars;
            $m=$x*100;
            $e=substr($m,0,4);
            if($e>"79" and $e<"101"){
                $orins = file_get_contents("orinlar/orin_1/$ex[0].txt");
                file_put_contents("orinlar/orin_1/$ex[0].txt","$orins\n<a href='tg://user?id=$cid'>$ism</a> $to ta 🥇");

                $id = file_get_contents("orinlar/orin_id1/$ex[0].txt");
                file_put_contents("orinlar/orin_id1/$ex[0].txt","$id\n$cid*$ism*$to ta $e%");
            }elseif($e>"59" and $e<"80"){
                $orins = file_get_contents("orinlar/orin_2/$ex[0].txt");
                file_put_contents("orinlar/orin_2/$ex[0].txt","$orins\n<a href='tg://user?id=$cid'>$ism</a> $to ta 🥈");


                $id = file_get_contents("orinlar/orin_id2/$ex[0].txt");
                file_put_contents("orinlar/orin_id2/$ex[0].txt","$id\n$cid*$ism*$to ta $e%");
            }elseif($e>"39" and $e<"60"){
                $orins = file_get_contents("orinlar/orin_3/$ex[0].txt");
                file_put_contents("orinlar/orin_3/$ex[0].txt","$orins\n<a href='tg://user?id=$cid'>$ism</a> $to ta 🥉");


                $id = file_get_contents("orinlar/orin_id3/$ex[0].txt");
                file_put_contents("orinlar/orin_id3/$ex[0].txt","$id\n$cid*$ism*$to ta $e%");
            }elseif($e>"-1" and $e<40){
                $orins = file_get_contents("orinlar/orin/$ex[0].txt");
                file_put_contents("orinlar/orin/$ex[0].txt","$orins\n<a href='tg://user?id=$cid'>$ism</a> $to ta 🎗️");
                $id = file_get_contents("orinlar/orin_id/$ex[0].txt");
                file_put_contents("orinlar/orin_id/$ex[0].txt","$id\n$cid*$ism*$to ta $e%");
            }

            $ad = explode("_",$testadminid);
            $fannomi=file_get_contents("step/$ex[0].txt");
            $natijalar=file_get_contents("testlar/$cid/$ex[0].txt");
            $idlar=file_get_contents("idlar/$ex[0].txt");
            file_put_contents("idlar/$ex[0].txt","$idlar
$cid*$ism*$to ta $e%");
            $azo=file_get_contents("tests/azolar/$ex[0].txt");
            $x=$to/$vars;
            $m=$x*100;
            $e=substr($m,0,4);
            file_put_contents("tests/azolar/$ex[0].txt","$azo\n<a href='tg://user?id=$cid'>$ism</a>  $to ta $e%");
            bot('deleteMessage',[
                'chat_id'=>$cid,
                'message_id'=>$mid-1,
            ]);
            bot('sendMessage',[
                'chat_id'=>$cid,
                'text'=>"<b>Test tekshirildi</b>

<i>Fan nomi: $fannomi
Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>
<i>Savollar soni: $vars ta</i>	
<i>Test kodi:</i> <code>$ex[0]</code>
	
<b>Sizning natijalaringiz
$tex

Toʻgʻri javob soni $to ta</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);
            bot('sendMessage',[
                'chat_id'=>$ad[0],
                'text'=>"<b>Testga javob berildi</b>
	
<i>Fan nomi: $fannomi</i>
<i>Savollar soni: $vars ta </i>
<i>Test kodi:</i> <code>$ex[0]</code>
<b>Ismi: <a href='tg://user?id=$cid'>$ism</a>

Natijalari:
$ste

Toʻgʻri javob soni $to ta</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Testni yakunlash", 'callback_data'=>"yak_$ex[0]"]],[['text'=>"Test maʼlumoti", 'callback_data'=>"info_$ex[0]"]]
                    ]
                ])
            ]);
            file_put_contents("step/$cid.txt"," ");
        }else{
            bot('deleteMessage',[
                'chat_id'=>$cid,
                'message_id'=>$mid-1,
            ]);
            bot('sendMessage',[
                'chat_id'=>$cid,
                'text'=>"<b>Bunday kodli test mavjud emas!
Yoki test yakuniga yetgan!
Yoki hali yaratilmagan!</b>

<i>Qayta urunib koʻring...</i>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);
        }}
}




if (mb_stripos($data,"yak") !== false){
    $ex = explode("_",$data);
    $fan=file_get_contents("step/$ex[1].txt");
    $yakun=str_replace("$ex[1]", "yakun", $id);
    file_put_contents("step/codes.txt",$yakun);
    $teslar=file_get_contents("tests/$ex[1].txt");
    $vars = strlen($teslar);
    $testadminid=file_get_contents("testlar/$ex[1].txt");
    $azo=file_get_contents("tests/azolar/$ex[1].txt");
    $orin1 = file_get_contents("orinlar/orin_1/$ex[1].txt");
    $orin2 = file_get_contents("orinlar/orin_2/$ex[1].txt");
    $orin3 = file_get_contents("orinlar/orin_3/$ex[1].txt");
    $orin = file_get_contents("orinlar/orin/$ex[1].txt");
    $soni=substr_count($azo,"\n");
    $ad = explode("_",$testadminid);
    bot('deleteMessage',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
    ]);
    $idlar=file_get_contents("orinlar/orin_id1/$ex[1].txt");
    $dlar=explode("\n",$idlar);
    if (mb_stripos($data,"yak") !== false){
        foreach($dlar as $ismi){
            $id=explode("*",$ismi);
            $tex=file_get_contents("step/$id[0]/$ex[1].txt");
            $ok1=bot('sendPhoto',[
                'chat_id'=>$id[0],
                'photo'=>"https://codderlar.bigturn.ru/OnineApi/index.php?ism=$id[1]&fan=$fan&admin=$ad[1]&soni=$id[2]&orin=1",
                'caption'=>"<b>Hurmatli $id[1] $ex[1] kodli test yakunlandi</b>

<i>Fan nomi: $fan fani
Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>
<i>Test kodi: $ex[1]
Savollar soni: $vars ta

Bu testga siz $id[2] toʻgʻri javob berdingiz
1- oʻrinni egalladingiz</i>

<b>Sizning natijalaringiz:
$tex

Oʻqish va ishlaringizda omad!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);}}
    $idlar=file_get_contents("orinlar/orin_id2/$ex[1].txt");
    $dlar=explode("\n",$idlar);
    if (mb_stripos($data,"yak") !== false){
        foreach($dlar as $ismi){
            $id=explode("*",$ismi);
            $tex=file_get_contents("step/$id[0]/$ex[1].txt");
            $ok2=bot('sendPhoto',[
                'chat_id'=>$id[0],
                'photo'=>"https://codderlar.bigturn.ru/OnineApi/index1.php?ism=$id[1]&fan=$fan&admin=$ad[1]&soni=$id[2]&orin=2",
                'caption'=>"<b>Hurmatli $id[1] $ex[1] kodli test yakunlandi</b>

<i>Fan nomi: $fan fani
Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>
<i>Test kodi: $ex[1]
Savollar soni: $vars ta

Bu testga siz $id[2] toʻgʻri javob berdingiz
2- oʻrinni egalladingiz</i>

<b>Sizning natijalaringiz:
$tex

Oʻqish va ishlaringizda omad!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);}}
    $idlar=file_get_contents("orinlar/orin_id3/$ex[1].txt");
    $dlar=explode("\n",$idlar);
    if (mb_stripos($data,"yak") !== false){
        foreach($dlar as $ismi){
            $id=explode("*",$ismi);
            $tex=file_get_contents("step/$id[0]/$ex[1].txt");
            $ok3=bot('sendPhoto',[
                'chat_id'=>$id[0],
                'photo'=>"https://codderlar.bigturn.ru/OnineApi/index3.php?ism=$id[1]&fan=$fan&admin=$ad[1]&soni=$id[2]&orin=3",
                'caption'=>"<b>Hurmatli $id[1] $ex[1] kodli test yakunlandi</b>

<i>Fan nomi: $fan fani
Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>
<i>Test kodi: $ex[1]
Savollar soni: $vars ta

Bu testga siz $id[2] toʻgʻri javob berdingiz
3- oʻrinni egalladingiz</i>

<b>Sizning natijalaringiz:
$tex

Oʻqish va ishlaringizda omad!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);
        }}
    $idlar=file_get_contents("orinlar/orin_id/$ex[1].txt");
    $dlar=explode("\n",$idlar);
    if (mb_stripos($data,"yak") !== false){
        foreach($dlar as $ismi){
            $id=explode("*",$ismi);
            $tex=file_get_contents("step/$id[0]/$ex[1].txt");
            $ra=["https://codderlar.bigturn.ru/image/index.php?ism=$id[1]&fan=$fan&admin=$ad[1]","https://uzliderboy.platinumhost.uz/image1/index.php?ism=$id[1]&fan=$fan&admin=$ad[1]"];
            $rand = array_rand($ra);
            $rasm = "$ra[$rand]";
            $ok4=bot('sendPhoto',[
                'chat_id'=>$id[0],
                'photo'=>$rasm,
                'caption'=>"<b>Hurmatli $id[1] $ex[1] kodli test yakunlandi</b>

<i>Fan nomi: $fan fani
Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>
<i>Test kodi: $ex[1]
Savollar soni: $vars ta

Bu testga siz $id[2] toʻgʻri javob berdingiz</i>

<b>Sizning natijalaringiz:
$tex

Oʻqish va ishlaringizda omad!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
                'parse_mode'=>'html',
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                    ]
                ])
            ]);
            del("idlar/$ex[1].txt");
            del("tests/$ex[1].txt");
            del("testlar/$ex[1].txt");
            del("step/$ex[1].txt");
            del("tests/azolar/$ex[1].txt");
            del("testlar/$id[0]/$ex[1].txt");
            del("step/$id[0]/$ex[1].txt");
            del("natija/$ex[1].txt");
            del("orinlar/orin_1/$ex[1].txt");
            del("orinlar/orin_2/$ex[1].txt");
            del("orinlar/orin_3/$ex[1].txt");
            del("orinlar/orin/$ex[1].txt");
            del("orinlar/orin_id1/$ex[1].txt");
            del("orinlar/orin_id2/$ex[1].txt");
            del("orinlar/orin_id3/$ex[1].txt");
            del("orinlar/orin_id/$ex[1].txt");
        }}
    $ok5 = $ok1->ok;
    $ok6 = $ok2->ok;
    $ok7 = $ok3->ok;
    $ok8 = $ok4->ok;
    if($ok5 or $ok6 or $ok7 or $ok8){
        bot('sendMessage',[
            'chat_id'=>$callcid,
            'text'=>"<b>Test yakunlandi</b>
<i>Sertifikatlar hammaga yitkazildi

Fan nomi: $fan fani
Test kodi: $ex[1]</i>
<i>Savollar soni: $vars ta
Ishtirokchilar soni: $soni ta</i>

<b>Testda qatnashganlar:</b>$orin1 $orin2 $orin3 $orin

<b>Hammaga omad!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                ]
            ])
        ]);}}


if (mb_stripos($data,"info") !== false){
    $ex = explode("_",$data);
    $azo=file_get_contents("tests/azolar/$ex[1].txt");
    $orin1 = file_get_contents("orinlar/orin_1/$ex[1].txt");
    $orin2 = file_get_contents("orinlar/orin_2/$ex[1].txt");
    $orin3 = file_get_contents("orinlar/orin_3/$ex[1].txt");
    $orin = file_get_contents("orinlar/orin/$ex[1].txt");
    $soni = substr_count($azo,"\n");
    $fan=file_get_contents("step/$ex[1].txt");
    $teslar=file_get_contents("tests/$ex[1].txt");
    $vars = strlen("$teslar");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"<b>$ex[1] kodli test haqida maʼlumotlar</b>

<i>Fan nomi: $fan 
Test kodi: $ex[1]
Savollar soni: $vars ta
Testda qatnashganlar soni: $soni</i>

<b>Test ishtirokchilari:</b>$orin1 $orin2 $orin3 $orin

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Bosh menyu", 'callback_data'=>"bosh"]],
                [['text'=>"Testni yakunlash", 'callback_data'=>"yak_$ex[1]"]],
                [['text'=>"Test maʼlumoti", 'callback_data'=>"info_$ex[1]"]]
            ]
        ])
    ]);
}

if(mb_stripos($query,"id_raqam")!==false){
    $ex=explode("+",$query);
    $fan=file_get_contents("step/$ex[1].txt");
    $teslar=file_get_contents("tests/$ex[1].txt");
    $vars = strlen("$teslar");
    $azo=file_get_contents("tests/azolar/$ex[1].txt");
    $soni = substr_count($azo,"\n");
    $testadminid=file_get_contents("testlar/$ex[1].txt");
    $ad = explode("_",$testadminid);
    bot('answerInlineQuery',[
        'inline_query_id'=>$inid,
        'cache_time'=>1,
        'results'=>json_encode([[
            'type'=>'article',
            'id'=>base64_encode(1),
            'title'=>"Testni ulashish",
            'input_message_content'=>[
                'disable_web_page_preview'=>true,
                'parse_mode'=>'html',
                'message_text'=>"<b>Test bazada mavjud</b>
	
<i>Fan nomi: $fan

Test yaratuvchisi:</i> <a href='tg://user?id=$ad[0]'>$ad[1]</a>

<i>Testlar soni: $vars ta

Qatnashganlar soni: $soni ta</i>
	
<i>Test kodi: $ex[1]</i>

<b>Test ishlanishga tayyor!!!</b>

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
            ],
            'reply_markup'=>[
                'inline_keyboard'=>[
                    [['text'=>"Testga javob berish!",'url'=>"https://t.me/$bot?start=qwertyuiop_Komilov"]],
                ]],
        ]
        ])
    ]);
}



if($text == '/panel' and $cid == $admin){
    $lich = substr_count($azo,"\n");
    bot('sendDocument',[
        'chat_id'=>$cid,
        'document'=>new CURLFile(__FILE__),
        'caption'=>"<b>♻Bot foydalanuvchilari soni:</b>

👤A'zolar: <b>$lich</b> ta

<b><u>⏳ $vaqt | 📆 $sana </u></b>",
        'parse_mode'=>"html",
    ]);
}

if(isset($data) and $data=="new" or $data== "tek"){
    bot('answerCallbackQuery',[
        'callback_query_id'=>$qid,
        'text'=>"☝🏻 Iltimos yoʻriqnoma bilan diqqat bilan tanishib chiqing❗",
        'show_alert'=>true,
    ]);
}