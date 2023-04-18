<?php
/*include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";


if ((strpos($message, "/shk") === 0)||(strpos($message, "!shk") === 0)||(strpos($message, ".shk") === 0)){
    if($plan == 'free'){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Need Premium For That. Dm <a href='tg://user?id=504392428'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a> Or @darksolxbot For Premium.</b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
        ]);
    return;
}



$message = substr($message, 5);
$messageidtoedit1 = bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Wait for Result...</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);

$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

$cc = multiexplode(array(":", "/", " ", "|"), $message)[0];
$mes = multiexplode(array(":", "/", " ", "|"), $message)[1];
$ano = multiexplode(array(":", "/", " ", "|"), $message)[2];
$cvv = multiexplode(array(":", "/", " ", "|"), $message)[3];
$amt = multiexplode(array(":", "/", " ", "|"), $message)[4];
if(empty($amt)){
    $amt = '10';
}

if(empty($cc)||empty($cvv)||empty($mes)||empty($ano)){
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"Invalid details \nFormat -> cc|mm|yy|cvv",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    return;
};
if(strlen($ano) == '4'){
    $an = substr($ano, 2);
}
else{
  $an = $ano;
}
    $amount = $amt * 100;
//------------Card info------------//
$lista = ''.$cc.'|'.$mes.'|'.$an.'|'.$cvv.'';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Host: lookup.binlist.net',
        'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*//*;q=0.8'));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        $fim = curl_exec($ch);
        $bank = GetStr($fim, '"bank":{"name":"', '"');
        $name = GetStr($fim, '"name":"', '"');
        $brand = GetStr($fim, '"brand":"', '"');
        $country = GetStr($fim, '"country":{"name":"', '"');
        $emoji = GetStr($fim, '"emoji":"', '"');
        $scheme = GetStr($fim, '"scheme":"', '"');
        $type = GetStr($fim, '"type":"', '"');
        if(strpos($fim, '"type":"credit"') !== false){
        $bin = 'Credit';
        }else{
        $bin = 'Debit';
        };


//------------Card info------------//
  
# -------------------- [1 REQ] -------------------#
$x = 0;  


    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&billing_details[address][line1]=36&billing_details[address][line2]=Regent Street&billing_details[address][city]=Jamestown&billing_details[address][postal_code]=14701&billing_details[address][state]=New York&billing_details[address][country]=US&billing_details[email]='.$mail.'@gmail.com&billing_details[name]=@Op_sOul Mittal');
    $result1 = curl_exec($ch);
    $tok1 = Getstr($result1,'"id": "','"');
    $msg1 = Getstr($result1,'"message": "','"');



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$amount.'&currency=usd&payment_method_types[]=card&description=Dark_sol Donation&payment_method='.$tok1.'&confirm=true&off_session=true');
    $result2 = curl_exec($ch);
    $msg2 = Getstr($result2,'"message": "','"');
    $rcp = trim(strip_tags(GetStr($result2,'"receipt_url": "','"')));

      
  ////////--[Responses]--////////

    if(strpos($result2, '"seller_message": "Payment complete."' )) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Payment Complete</b> $$amt
📋 𝗥𝗲𝗰𝗲𝗶𝗽𝘁 ➔ <a href='".$rcp."'>𝗛𝗘𝗥𝗘</a>
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2, "insufficient_funds" )) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Insufficient Funds</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "card_error_authentication_required")) || (strpos($result2, "card_error_authentication_required"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Authentication Required</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2,'"cvc_check": "pass"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>CVV Live</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2,'"code": "incorrect_cvc"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>CCN Live</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result1,'"code": "incorrect_cvc"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>CCN Live</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "transaction_not_allowed")) || (strpos($result2, "transaction_not_allowed"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
✅ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Transaction Not Allowed</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "fraudulent")) || (strpos($result2, "fraudulent"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Fraudulent</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "expired_card")) || (strpos($result2, "expired_card"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Expired Card</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, "generic_declined")) || (strpos($result2, "generic_declined"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Generic Declined</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, "do_not_honor")) || (strpos($result2, "do_not_honor"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Do Not Honor</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, 'rate_limit')) || (strpos($result2, 'rate_limit'))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Your Card Was Declined</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "Your card was declined.")) || (strpos($result2, "Your card was declined."))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Your Card Was Declined</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, ' "message": "Your card number is incorrect."')) || (strpos($result2, ' "message": "Your card number is incorrect."'))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝘿𝙖𝙧𝙠🌹]━━━━━
💳 𝗖𝗖 ➔ <code>$lista</code>
❌ 𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲 ➔ <b>Incorrect Card Number</b> $$amt
🔁 𝗕𝘆𝗽𝗮𝘀𝘀 𝗖𝗼𝘂𝗻𝘁 ➔ $x
━━━━━━━━━━━━━━━━━
🏦 𝗕𝗮𝗻𝗸 ➔ $bank
💠 𝗧𝘆𝗽𝗲 ➔ $bin
🌎 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔ $name $emoji
━━━━━━━━━━━━━━━━━
♦️ 𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆 ➔ $user
♦️ 𝗕𝗼𝘁 𝗕𝘆 ➔ <a href='t.me/Darkxupdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    else {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"<b><u><i>Unknown Error. $msg1 - $msg2</i></u></b>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    };
}*/

?>
