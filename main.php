<?php
include __DIR__."/config/variables.php";
include __DIR__."/config/users.php";
include __DIR__."/functions/bot.php";
include_once __DIR__."/functions/functions.php";


////Modules
include __DIR__."/Modules/Others/sk.php";
include __DIR__."/Modules/Others/id.php";
include __DIR__."/Modules/Others/bin.php";



include __DIR__."/Modules/Gates/chk.php";
include __DIR__."/Modules/Gates/chh.php";
include __DIR__."/Modules/Gates/shk.php";
include __DIR__."/Modules/Gates/mchk.php";


//////////////===[START]===//////////////

if(strpos($message, "/start") === 0){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Hello @$username,

Type /cmds to know all my commands!</b>",
	'parse_mode'=>'html',
	'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard' => [
        [
          ['text' => "💠 Created By 💠", 'url' => "tg://user?id=6056931017"]
        ],
        [
          ['text' => "💎 Join 💎", 'url' => "t.me/DraMaCLuB_II"]
        ],
      ], 'resize_keyboard' => true])
        
    ]);
}


//////////////===[Plan]===//////////////

if(strpos($message, "/plan") === 0 || strpos($message, "!plan") === 0 || strpos($message, ".plan") === 0){

  
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>☣️ User</b> - @$username
<b>🆔 ID</b> - <code>$userId</code>
<b>✨ Plan</b> - <b><i><u>$plan</u></i></b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
    ]);
}


//////////////===[PREM]===//////////////

if(strpos($message, "/vip") === 0 || strpos($message, "!vip") === 0 || strpos($message, ".vip") === 0){

  
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b><u>7 Day Access = 5$ 
1 Month Access = 16$ 
2 Month Access = 28$</u></b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
    ]);
}



//////////////===[CMDS]===//////////////

if(strpos($message, "/cmds") === 0 || strpos($message, "!cmds") === 0 || strpos($message, ".cmds") === 0){

  
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Which commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"💳 CC Checker Gates",'callback_data'=>"checkergates"]],[['text'=>"🛠 Other Commands",'callback_data'=>"othercmds"]],
    ],'resize_keyboard'=>true])
    ]);
  
  
  }
  
  if($data == "back"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>Which commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"💳 CC Checker Gates",'callback_data'=>"checkergates"]],[['text'=>"🛠 Other Commands",'callback_data'=>"othercmds"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  if($data == "checkergates"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"━━𝗖𝗖 𝗖𝗵𝗲𝗰𝗸𝗲𝗿 𝗚𝗮𝘁𝗲𝘀━━
    
━━━━━━━━━━━━━━━━━
⋆ 𝗦𝗧𝗥𝗜𝗣𝗘 𝗔𝗨𝗧𝗛
⋆ Format: /au cc|mm|yyyy|cvv
⋆ Status : Free ✅
━━━━━━━━━━━━━━━━━
⋆ 𝗦𝗧𝗥𝗜𝗣𝗘 𝗖𝗛𝗔𝗥𝗚𝗘 $3
⋆ Format: /chh cc|mm|yyyy|cvv
⋆ Status: Off ❌
━━━━━━━━━━━━━━━━━
⋆ 𝗦𝗧𝗥𝗜𝗣𝗘 𝗖𝗛𝗔𝗥𝗚𝗘 𝗖𝗨𝗦𝗧𝗢𝗠 𝗔𝗠𝗢𝗨𝗡𝗧
⋆ Format: /shk cc|mm|yyyy|cvv|amt
⋆ Empty amount = $10
⋆ Status: Off ❌
━━━━━━━━━━━━━━━━━
⋆ 𝗠𝗔𝗦𝗦 𝗦𝗧𝗥𝗜𝗣𝗘 𝗔𝗨𝗧𝗛
⋆ Format: 
⋆ /mau cc|mm|yyyy|cvc
⋆ cc|mm|yyyy|cvv
⋆ Status: Under Work ❌

𝗝𝗢𝗜𝗡 <a href='t.me/DraMaCLuB_II'>𝗛𝗘𝗥𝗘</a>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }
  
  
  if($data == "othercmds"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"━━𝗢𝘁𝗵𝗲𝗿 𝗖𝗼𝗺𝗺𝗮𝗻𝗱𝘀━━
    
━━━━━━━━━━━━━━━━━
⋆ 𝗕𝗜𝗡 𝗟𝗢𝗢𝗞𝗨𝗣
⋆ Format: /bin 601120
⋆ Status : Free ✅
━━━━━━━━━━━━━━━━━
⋆ 𝗦𝗞 𝗖𝗛𝗘𝗖𝗞
⋆ Format: /sk sk_live_xxxxxxxxxxx
⋆ Status: Free ✅
━━━━━━━━━━━━━━━━━
⋆ 𝗖𝗛𝗘𝗖𝗞 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠 𝗜𝗗/𝗚𝗥𝗢𝗨𝗣 𝗜𝗗
⋆ Format: /id

𝗝𝗢𝗜𝗡 <a href='t.me/DraMaCLuB_II'>𝗛𝗘𝗥𝗘</a>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }

?>
    
?>
