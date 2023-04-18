<?php
include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";




if ((strpos($message, "/sk") === 0)||(strpos($message, "!sk") === 0)||(strpos($message, ".sk") === 0)){
    if(!in_array($chat_id, $auchats)){
    if($plan == 'free'){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>Not Authorised. Join <a href='t.me/DarkxxChat'>Here</a> To Use Free Gates</b>",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
            ]);
        return;
    }
}
$sec = substr($message, 4);
if (!empty($sec)) {
$message = substr($message, 4);
$messageidtoedit1 = bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Wait for Result...</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);

$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');
$skhidden = substr_replace($sec, '',12).preg_replace("/(?!^).(?!$)/", "x", substr($sec, 12));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[number]=4912461004526326&card[exp_month]=04&card[exp_year]=2024&card[cvc]=011');
$result = curl_exec($ch);
$response = trim(strip_tags(GetStr($result,'"message": "','"')));
if (strpos($result, 'tok_')){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>SK LIVE!!</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
elseif (strpos($result, 'Invalid API Key provided')){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>INVALID KEY</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
elseif (strpos($result, 'You did not provide an API key.')){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>You did not provide key</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
elseif (strpos($result, 'rate_limit')){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
⚠️ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>RATE LIMIT KEY</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>TESTMODE KEY</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
elseif (strpos($result, 'api_key_expired')){
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>EXPIRED KEY</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
else{
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$messageidtoedit,
        'text'=>"━━━━━[🔸𝘿𝙖𝙧𝙠🔸]━━━━━
💠 𝗦𝗞 ➔ <code>$skhidden</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>The Card Was Declined</b>
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>'true'
        ]);
}
}
delMessage($chat_id, $message_id);
;}

function delMessage ($chat_id, $message_id){
$url = "https://api.telegram.org/bot5936154810:AAESMFBFA_YHZqI70zTdY4_AYyJfD2kSvyI/deleteMessage?chat_id=".$chat_id."&message_id=".$message_id."";
file_get_contents($url);
};
?>
