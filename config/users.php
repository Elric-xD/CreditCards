<?php

$auchats = array('-1001848070236');
$owner = '504392428';
$preusers = array();

if($userId == '504392428'){
    $user = "<a href='tg://user?id=504392428'>𝘿𝙖𝙍𝙠𝙨𝙊𝙡 ✘</a>[𝗚ø𝗱]";
  $plan = 'God';
}
elseif(in_array($userId,$preusers)){
    $user = '@'.$username.'[𝗣𝗿𝗲𝗺𝗶𝘂𝗺✨]';
    $plan = 'premium';
}
else {
    $user = '@'.$username.'[𝗙𝗿𝗲𝗲]';
    $plan = 'free';
}

?>
