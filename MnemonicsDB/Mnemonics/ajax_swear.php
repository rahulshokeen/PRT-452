<?php
$people = array("anal","anus","arse","ass","ballsack","balls","bastard","bitch","biatch","bloody","blowjob","blow job","bollock","bollok","boner","boob","bugger","bum","butt","buttplug","clitoris","cock","coon","crap","cunt","damn","dick","dildo","dyke","fag","feck","fellate","fellatio","felching","fuck","f u c k","fudgepacker","fudge packer","flange","Goddamn","God damn","hell","homo","jerk","jizz","knobend","knob end","labia","lmao","lmfao","muff","nigger","nigga","omg","penis","piss","poop","prick","pube","pussy","queer","scrotum","sex","shit","s hit","sh1t","slut","smegma","spunk","tit","tosser","turd","twat","vagina","wank","whore");
$string = $_POST['mnemonic'];
$flag_swear = FALSE;
$matchfound = preg_match_all(
               "/\b(" . implode($people,"|") . ")\b/i",
               $string,
               $matches
             );
if ($matchfound) {
 $words = array_unique($matches[0]);
 foreach($words as $word) {
   echo "You used $word, which is offensive please remove to submit your Mnemonic <br>";
 }
 echo "</ul>";
}

?>
