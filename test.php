<?php


if ($_POST ["odeslat"] !== "Odeslat" or $error == 1) {
	// generovani formulare
	$timestampnew = base64_encode ( time () );
	echo "<div class=\"obj_form\">\n";
	echo "<form action=\"\" method=\"post\" id=\"obj_formular\">\n";
	echo "  <div>\n";
	echo "    <input type=\"text\" name=\"email\" maxlength=\"200\" class=\"skryty\" />\n";
	echo "    <input type=\"text\" name=\"url\" maxlength=\"200\" class=\"skryty\" />\n";
	echo "    <input type=\"text\" name=\"message\" maxlength=\"200\" class=\"skryty\" />\n";
	echo "    <input type=\"text\" name=\"add\" maxlength=\"200\" class=\"skryty\" />\n";
	echo "    <input type=\"text\" name=\"casoverazitko\" maxlength=\"200\" value=\"$timestampnew\" class=\"skryty\" /><input type=\"submit\" class=\"skryty\" />\n";
	echo "    <input type=\"hidden\" name=\"odeslat\" value=\"Odeslat\" />\n";
	echo "  </div>\n";
	
	echo "  <fieldset>\n";
	echo "    <legend>&nbsp;" . $config ["form_legend"] . "&nbsp;</legend>\n";
	foreach ( $config ["form_params"] as $param => $attrib ) {
		$style = ($attrib ["class"] != "") ? "class=\"" . $attrib ["class"] . "\"" : "style=\"width:" . $attrib ["size"] . "px\"";
		$req = ($attrib ["required"]) ? "*" : "";
		switch ($attrib ["type"]) {
			case "textarea" :
				echo "    <p><label for=\"obj_$param\" class=\"left\">" . $attrib ["title"] . "$req</label> <textarea name=\"$param\" $style rows=\"6\">" . $attrib ["input_value"] . "</textarea></p>\n";
				break;
			
			case "plainlabel" :
				echo "    <p>&nbsp;&nbsp;&nbsp;" . $attrib ["title"] . "</p>\n";
				break;
			
			case "radio" :
				echo "    <p>&nbsp;&nbsp;&nbsp;" . $attrib ["title"] . "$req ";
				foreach ( $attrib ["values"] as $value ) {
					$checked1 = ($attrib ["input_value"] == $value) ? "checked=\"checked\"" : "";
					echo "&nbsp;<input name=\"$param\" value=\"$value\" type=\"radio\" $checked1/>$value&nbsp;\n";
				}
				echo "    </p>\n";
				break;
			
			case "checkbox" :
				echo "    <p>&nbsp;&nbsp;&nbsp;" . $attrib ["title"] . "$req &nbsp;&nbsp;";
				$checked2 = ($attrib ["input_value"] == $attrib ["value"]) ? "checked=\"checked\"" : "";
				echo "&nbsp;<input name=\"$param\" value=\"" . $attrib ["value"] . "\" type=\"checkbox\" $checked2/>" . $attrib ["value"] . "&nbsp;\n";
				echo "    </p>\n";
				break;
			
			default :
				echo "    <p><label for=\"obj_$param\" class=\"left\">" . $attrib ["title"] . "$req</label> <input name=\"$param\" id=\"obj_$param\" value=\"" . $attrib ["input_value"] . "\" $style type=\"text\" maxlength=\"" . $attrib ["maxlength"] . "\" /></p>\n";
				break;
		}
	}
	
	echo "  </fieldset>\n";
	echo "  <p><input class=\"button\" type=\"button\" value=\" Odeslat \" onclick=\"document.getElementById('obj_formular').submit()\" />   <input class=\"button\" type=\"reset\" /></p>\n";
	echo "</form>\n";
	echo "</div>\n";
}
function MailWithoutAttachement($from, $to, $subj, $mail_text, $more_headers = "", $format = "text/plain") {
	$ori = htmlspecialchars ( "$from|$to|$subj" );
	if (strpos ( $from, "<" ) !== false) {
		$from_arr = explode ( "<", $from );
		$headers = "From: =?UTF-8?B?" . base64_encode ( $from_arr [0] ) . "?= <" . $from_arr [1] . "\r\n";
	} else
		$headers = "From: $from\n";
	if (strpos ( $to, "<" ) !== false) {
		$to_arr = explode ( "<", $to );
		$to = "=?UTF-8?B?" . base64_encode ( $to_arr [0] ) . "?= <" . $to_arr [1];
	}
	$subj = "=?utf-8?B?" . base64_encode ( $subj ) . "?=";
	$headers .= "MIME-Version: 1.0\n" . "Content-Type: $format; charset=\"utf-8\"\n" . $more_headers;
	$result = mail ( $to, $subj, $mail_text, $headers );
	return $result;
}
function CheckEmail($email) {
	$atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]'; // znaky tvoøící uživatelské jméno
	$domain = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])'; // jedna komponenta domény
	return mb_eregi ( "^$atom+(\\.$atom+)*@($domain?\\.)+$domain\$", $email );
}
function CheckForSpam($timelimit) {
	if ($_POST ["url"] != "" or $_GET ["url"] != "") {
		@sleep ( 1 );
		die ( "Nesprávné údaje !!!!" );
	}
	if ($_POST ["email"] != "" or $_GET ["email"] != "") {
		@sleep ( 1 );
		die ( "Nesprávné údaje !!!!" );
	}
	if ($_POST ["message"] != "" or $_GET ["message"] != "") {
		@sleep ( 1 );
		die ( "Nesprávné údaje !!!!" );
	}
	if ($_POST ["add"] != "" or $_GET ["add"] != "") {
		@sleep ( 1 );
		die ( "Nesprávné údaje !!!!" );
	}
	if ($_POST ["add"] != "" or $_GET ["add"] != "") {
		@sleep ( 1 );
		die ( "Nesprávné údaje !!!!" );
	}
	
	$timestamp = base64_decode ( $_POST ["casoverazitko"] );
	$actualtimestamp = time ();
	if (($timestamp + $timelimit) > $actualtimestamp) {
		@sleep ( 1 );
		VypisMsgexit ( get_lang ( "Pozor, pravdìpodobnì opakované odesílání formuláøe, zkuste pozdìji !!!!" ), "err" );
	}
}
function VypisMsg($ch, $t = "inf", $p = "") {
	global $config;
	switch ($t) {
		case "err" :
			$color = "red";
			$symb = "";
			break;
		case "ftl" :
			$color = "black";
			$symb = "!";
			if ($config ["send_ftl_msgs"] == true) :
				$p = ($p) ? $p : $php_errormsg . " " . mysql_error ();
				$mail = date ( "r" ) . "\n\nApplication " . $config ["application_title"] . " at the server " . $_SERVER ['SERVER_NAME'] . " failed in this request: " . $_SERVER ["REQUEST_URI"] . "\nMessage: $ch\nParameter: $p";
				MailWithoutAttachement ( "automat@" . $_SERVER ['HTTP_HOST'], $config ["developer_contact"], "FATAL ERROR", $mail );
			

      endif;
			break;
		default :
			$color = "blue";
			$symb = "";
			break;
	}
	echo "<table style=\"padding: 5px; border: 1px #000000 solid; background-color: #ffffff\">\n";
	echo "<tr><td style=\"width: 5em; background-color:$color; font-family: 'Times New Roman', Times, serif; text-align:center;\"><span style=\"color: white; font-size: 4em;\"><strong>$symb</strong></span></td><td style=\"text-align:center; color:$color;\">$ch";
	if ($p != "")
		echo "<br /><em>::: $p</em>\n";
	echo "</td></tr>\n";
  echo "</table><br />\n";
  }


function VypisMsgexit($ch, $t = "i", $p = "") {
VypisMsg($ch, $t, $p);
exit();
}


function get_lang($s, $dest_lang = '') {
return $s;
}

?>
