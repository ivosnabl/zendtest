<style>
.obj_form {
	margin: 1em 0 0 0;
	padding: 10px 10px 0 10px;
	border: solid 1px rgb(200, 200, 200);
	background-color: rgb(240, 240, 240);
	color: rgb(80, 80, 80);
}

.obj_form fieldset {
	padding: 20px 0 0 0 !important /*Non-IE6*/;
	padding: 10px 10px 10px 10px /*IE6*/;
	margin: 0 0 20px 0;
	border: solid 1px #999;
}

.obj_form fieldset legend {
	margin: 0 0 0 5px !important /*Non-IE*/;
	margin: 0 0 5px 5px /*IE6*/;
	padding: 0 2px 0 2px;
	color: rgb(80, 80, 80);
	font-weight: bold;
	font-size: 110%;
}

.obj_form label.left {
	float: left;
	width: 150px;
	margin: 0 0 0 10px;
	padding: 2px;
	font-size: 90%;
}

.obj_form select.combo {
	width: 475px;
	padding: 2px;
	font-size: 90%;
	border: solid 1px rgb(200, 200, 200);
}

.obj_form input.field {
	width: 475px;
	padding: 2px;
	font-size: 90%;
	border: solid 1px rgb(200, 200, 200);
}

.obj_form textarea.same {
	width: 475px;
	padding: 2px;
	font-size: 90%;
	border: solid 1px rgb(200, 200, 200);
}

.obj_form input.button {
	width: 9.0em;
	margin-right: 20px;
	padding: 1px !important /*Non-IE6*/;
	padding: 0 /*IE6*/;
	background: rgb(230, 230, 230);
	color: rgb(80, 80, 80);
	font-size: 90%;
	border: solid 1px rgb(150, 150, 150);
}

.obj_form input.button:hover {
	cursor: pointer;
	background: rgb(220, 220, 220);
	color: rgb(30, 30, 30);
}

.skryty {
	visibility: hidden;
	display: none;
}
</style>

<?php
/**
 * pro skryti polozek formulare s class=skryty nutno pridat do globalnich css tuto definici:
 * .skryty { visibility: hidden; display: none; }
 * a volitelne take vyse uvedene formatovani formulare
 */

/* konfiguracni parametry: */
$config ["mail_subject"] = "Poptavka na pobyt " . $_SERVER ['HTTP_HOST'];
$config ["recipients_mails"] = "ivosnabl@gmail.com"; // email list adresatu
$config ["return_path"] = "ivosnabl@gmail.com"; // zsustr@itsprava.cz navratova adresa, na kterou se email vrati pokud nebude prijemce dostupny
$config ["strict_check_for_spam_urls"] = 1; // striktni mod: pokud je kdekoliv URL, povazuj zpravu za spam

$config ["thanks_msgs"] = "Dìkujeme, zpráva byla odeslána, oèekávejte potvrzení pøihlášky";
$config ["error_msgs"] = "Došlo k chybì, údaje nebyly odeslané";

$config ["send_ftl_msgs"] = true; // posilani fatal erroru
$config ["developer_contact"] = "ivosnabl@gmail.com"; // zsustr@itsprava.cz email na developera, pokud se vyskytne fatal error

$config ["form_legend"] = "Poptávka na pobyt";
$config ["form_params"] = array ( // pole s definici formularovych prvku, lze lib. rozsirit
		"termin" => array (
				"title" => "Termín pobytu:", // s dvojteckou nebo bez
				"type" => "text",
				"class" => "field",
				"size" => 50, // uplatni se pri absenci tridy stylu (class)
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		"nahradni" => array (
				"title" => "Náhradní termín:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		
		"pocet_mist" => array (
				"title" => "Poèet míst:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		
		"jmeno" => array (
				"title" => "Jméno:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		"prijmeni" => array (
				"title" => "Pøíjmení:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		
		"ulice" => array (
				"title" => "Ulice, è.p.:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		"mesto" => array (
				"title" => "Mìsto:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		"PSC" => array (
				"title" => "PSÈ:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50  // vzdy vyplnovat u textovych inputu
				),
		
		"telefon" => array (
				"title" => "Telefon:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 50, // vzdy vyplnovat u textovych inputu
				"required" => true 
		),
		"posta" => array ( // POZOR pro email VZDY pouzivat nazev posta, mj. i kvuli spamu (to stejne plati pro nazvy: url, message, add)
				"title" => "E-mail:",
				"type" => "text",
				"class" => "field",
				"size" => 50,
				"maxlength" => 100,
				"required" => true 
		),
		"nadpis_info" => array (
				"title" => "<strong>Jak jste se o nas dozvìdìli?</strong>", // nutno doplnit mezerami podle delky titulku
				"type" => "plainlabel" 
		),
		"odkud" => array (
				"title" => "Osobni zkušenosti:&nbsp;&nbsp;&nbsp;", // nutno doplnit mezerami podle delky titulku
				"type" => "radio",
				"values" => array (
						"ano",
						"ne" 
				) 
		),
		
		"odkud_2" => array (
				"title" => "Informace od známých:&nbsp;&nbsp;&nbsp;", // nutno doplnit mezerami podle delky titulku
				"type" => "radio",
				"values" => array (
						"ano",
						"ne" 
				) 
		),
		
		"odkud_6" => array (
				"title" => "Odkaz z partnerských webových stránek:&nbsp;", // nutno doplnit mezerami podle delky titulku
				"type" => "radio",
				"values" => array (
						"ano",
						"ne" 
				) 
		),
		
		"odkud_8" => array (
				"title" => "Jiné:&nbsp;", // nutno doplnit mezerami podle delky titulku
				"type" => "radio",
				"values" => array (
						"ano",
						"ne" 
				) 
		)
		,
		
		"poznamka" => array (
				"title" => "Poznámka:",
				"type" => "textarea",
				"class" => "same" 
		) 
)
;

if ($_POST ["odeslat"] === "Odeslat") {
	CheckForSpam ( 1 );
	$mess = "";
	$error = 0;
	foreach ( $config ["form_params"] as $param => $attrib ) {
		$config ["form_params"] [$param] ["input_value"] = $input_value = strip_tags ( trim ( $_POST [$param] ) );
		$attrib_title = str_replace ( array (
				"&nbsp;" 
		), "", $attrib ["title"] ); // odstrani tvrde mezery
		if ($config ["strict_check_for_spam_urls"] == 1 and mb_eregi ( "http", $input_value ) !== false)
			die ( "Zpráva nesmí obsahovat URL adresy !!!!" );
		if ($param == "posta")
			$posta = $input_value; // uchovani emailu
		
		if ($param != "kontrolni_otazka") { // kontrolni otazku vynech
			$mess .= strip_tags ( $attrib_title ) . ": " . $input_value . "\n"; // hodnoty do tela emailu
		}
	}
	
	if ($error == 0) {
		$mess .= "\n************************** Automaticka zprava byla odeslana ze serveru " . $_SERVER ['HTTP_HOST'];
		$from = (CheckEmail ( $posta )) ? $posta : "SCHAZI_EMAIL";
		if (MailWithoutAttachement ( $from, $config ["recipients_mails"], $config ["mail_subject"], $mess ))
			VypisMsg ( $config ["thanks_msgs"] );
		else
			VypisMsg ( $config ["error_msgs"], "err" );
	}
}

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
