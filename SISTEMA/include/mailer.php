<?php
	/**
	* Mailer.php
	*
	* Modified by: Carlos Pinto
	* Last Updated: April 14, 2014
	*/

include_once("constants.php");
include_once("database.php");

class Mailer
{
	
	function sendMailPasswordReset($user,$password)
	{
		global $database;

		$body = '
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td align="center" bgcolor="#55cab7" style="padding-top:14px; padding-bottom:14px;">

					<a href="'.URL_SITE.'">
					<img src="'.URL_SITE.'/emails/registration/images/logo-sidneey.png" width="213" height="63" alt="Sidneey">
					</a>

					<td>
					</tr>
					</table>

					<tr>
					<td>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					Dear 
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; font-weight:bold; line-height:1; color: #2f353e; ">
					'.$user.',
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					<br><br>
					Your password has been reset!
					</span>					
					
					</td>
					</tr>
					


					</table>					

					<table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:24px;">

					<tr>
					<td bgcolor="#ffffff" style="border-bottom: solid 1px #e6e6e8;">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1; color: #3f444d; ">
					Your user information:
					</span>

					</td>
					</tr>

					<tr>
					<td bgcolor="#fafafb">

					<ul style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1.5; color: #3f444d; ">

					<li>
					Email/User: <b>'.$user.'</b>
					</li>

					<li>
					Your Password: <b>'.$password.'</b>
					</li>

					</ul>

					</td>
					</tr>

					</table>


					<table width="100%" border="0" align="center" cellpadding="25" cellspacing="0" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">


					<br><br>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>

					<a href="'.URL_SITE.'" style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; text-decoration:none; line-height:1; color: #2f353e; ">
					'.URL_BEAUTY.'
					</a>
					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>
					</td>
					</tr>

					</table>

					<table width="100%" height="120" border="0" align="center" cellpadding="25" cellspacing="0" background="'.URL_SITE.'emails/registration/images/onda-blanca.png" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">
					</td>
					</tr>

					</table>

					</td>
					</tr>
				</table>';
		
		// Email Subject 
		$subjectmail = 'Password Reset';

		if ($this->sendmyemail($body,$subjectmail,$user))
		{
			return true;
		}else{
			return false;
		}
	}

	function sendMailSignUp($email,$password,$passCon,$fullname,$provinces,$counties,$phone)
	{
		global $database;

		$body = '
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td align="center" bgcolor="#55cab7" style="padding-top:14px; padding-bottom:14px;">

					<a href="'.URL_SITE.'">
					<img src="'.URL_SITE.'/emails/registration/images/logo-sidneey.png" width="213" height="63" alt="Sidneey">
					</a>

					<td>
					</tr>
					</table>

					<tr>
					<td>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					Dear 
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; font-weight:bold; line-height:1; color: #2f353e; ">
					'.$fullname.',
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					<br><br>
					Welcome to Sidneey!
					</span>

					</td>
					</tr>

					</table>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1; color: #2f353e; ">
 					You will enjoy of our huge range of benefits that include deals, trends, news and information from our lounge.</span>

					</td>
					</tr>

					</table>

					<table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:24px;">

					<tr>
					<td bgcolor="#ffffff" style="border-bottom: solid 1px #e6e6e8;">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1; color: #3f444d; ">
					Your user information:
					</span>

					</td>
					</tr>

					<tr>
					<td bgcolor="#fafafb">

					<ul style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1.5; color: #3f444d; ">

					<li>
					Email/User: <b>'.$email.'</b>
					</li>

					<li>
					Password: <b>'.$password.'</b>
					</li>

					</ul>

					</td>
					</tr>

					</table>


					<table width="100%" border="0" align="center" cellpadding="25" cellspacing="0" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 22px; font-style:italic; line-height:1; color: #2f353e; ">
					Welcome on board!
					</span>

					<br><br>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>

					<a href="'.URL_SITE.'" style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; text-decoration:none; line-height:1; color: #2f353e; ">
					'.URL_BEAUTY.'
					</a>
					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>
					</td>
					</tr>

					</table>

					<table width="100%" height="120" border="0" align="center" cellpadding="25" cellspacing="0" background="'.URL_SITE.'emails/registration/images/onda-blanca.png" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">
					</td>
					</tr>

					</table>

					</td>
					</tr>
				</table>';
		
		// Email Subject 
		$subjectmail = 'Welcome to Sidneey!';

		if ($this->sendmyemail($body,$subjectmail,$email))
		{
			return true;
		}else{
			return false;
		}
	}

	function sendMailAsk($usname,$email,$comments‏)
	{
		global $database;

		$body = '
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td align="center" bgcolor="#55cab7" style="padding-top:14px; padding-bottom:14px;">

					<a href="'.URL_SITE.'">
					<img src="'.URL_SITE.'/emails/registration/images/logo-sidneey.png" width="213" height="63" alt="Sidneey">
					</a>

					<td>
					</tr>
					</table>

					<tr>
					<td>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					<br><br>
					New Question from Sidneey.ie!
					</span>

					</td>
					</tr>

					</table>
					
					<table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:24px;">

					<tr>
					<td bgcolor="#ffffff" style="border-bottom: solid 1px #e6e6e8;">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1; color: #3f444d; ">
					Queestion Details:
					</span>

					</td>
					</tr>

					<tr>
					<td bgcolor="#fafafb">

					<ul style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1.5; color: #3f444d; ">

					<li>
					Name: <b>'.$usname.'</b>
					</li>

					<li>
					Email: <b>'.$email.'</b>
					</li>
					
					<li>
					Question: <b>'.$comments‏.'.</b>
					</li>

					</ul>

					</td>
					</tr>

					</table>					

					<table width="100%" border="0" align="center" cellpadding="25" cellspacing="0" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>

					<a href="'.URL_SITE.'" style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; text-decoration:none; line-height:1; color: #2f353e; ">
					'.URL_BEAUTY.'
					</a>
					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>
					</td>
					</tr>

					</table>

					<table width="100%" height="120" border="0" align="center" cellpadding="25" cellspacing="0" background="'.URL_SITE.'emails/registration/images/onda-blanca.png" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">
					</td>
					</tr>

					</table>

					</td>
					</tr>
				</table>';
		
		// Email Subject 
		$subjectmail = 'New Question From Sidneey.ie!';

		if ($this->sendmyemail($body,$subjectmail,EMAIL_CONTACT))
		{ 
			return true;
		}else{
			return false;
		}
	}
	
	
	function sendMailSeller($idadv,$email,$message)
	{
		global $database;
		
		$infoseller	=	$database->getInfoSellerByIdAvert($idadv);

		$body = '
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td align="center" bgcolor="#55cab7" style="padding-top:14px; padding-bottom:14px;">

					<a href="'.URL_SITE.'">
					<img src="'.URL_SITE.'/emails/registration/images/logo-sidneey.png" width="213" height="63" alt="Sidneey">
					</a>

					<td>
					</tr>
					</table>

					<tr>
					<td>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					Dear 
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; font-weight:bold; line-height:1; color: #2f353e; ">
					'.$infoseller["fullname"].',
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					<br><br>
					 The following is a reply to your "'.$infoseller["title"].'" Ad on Sidneey Ireland!
					</span>

					</td>
					</tr>

					</table>

					<table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:24px;">

					<tr>
					<td bgcolor="#ffffff" style="border-bottom: solid 1px #e6e6e8;">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1; color: #3f444d; ">
					Reply Details:
					</span>

					</td>
					</tr>

					<tr>
					<td bgcolor="#fafafb">

					<ul style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1.5; color: #3f444d; ">

					<li>
					Contact Email: <b>'.$email.'</b>
					</li>
					
					<li>
					Message: <b>'.$message.'.</b>
					</li>

					</ul>

					</td>
					</tr>

					</table>	

					<table width="100%" border="0" align="center" cellpadding="25" cellspacing="0" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>

					<a href="'.URL_SITE.'" style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; text-decoration:none; line-height:1; color: #2f353e; ">
					'.URL_BEAUTY.'
					</a>
					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>
					</td>
					</tr>

					</table>

					<table width="100%" height="120" border="0" align="center" cellpadding="25" cellspacing="0" background="'.URL_SITE.'emails/registration/images/onda-blanca.png" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">
					</td>
					</tr>

					</table>

					</td>
					</tr>
				</table>';
		
		// Email Subject 
		$subjectmail = 'Reply to your "'.$infoseller["title"].'" Ad on Sidneey Ireland';

		if ($this->sendmyemail($body,$subjectmail,$infoseller["email"]))
		{ 
			return true;
		}else{
			return false;
		}
	}	
	

	function sendMailNewsletter($email)
	{
		global $database;

		$body = '
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td align="center" bgcolor="#55cab7" style="padding-top:14px; padding-bottom:14px;">

					<a href="'.URL_SITE.'">
					<img src="'.URL_SITE.'/emails/registration/images/logo-sidneey.png" width="213" height="63" alt="Sidneey">
					</a>

					<td>
					</tr>
					</table>

					<tr>
					<td>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					Dear 
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; font-weight:bold; line-height:1; color: #2f353e; ">
					'.$email.',
					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 20px; line-height:1; color: #2f353e; ">
					<br><br>
					Welcome to Our Sidneey Newsletter!
					</span>

					</td>
					</tr>

					</table>

					<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">

					<tr>
					<td>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; line-height:1; color: #2f353e; ">
					Thanks for your interest in our e-newsletter. It is the best way to stay informed about upcoming anyone selling stuff at a give away price, and special announcements and offers. 					
					The e-mail address you provide will be used only to send you the newsletter; we will not share it with anyone. Your privacy is important to us. Read our full <a href="'.URL_SITE.'privacy.php">Privacy Policy</a> for details.
					</span>
					</td>
					</tr>

					</table>


					<table width="100%" border="0" align="center" cellpadding="25" cellspacing="0" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 22px; font-style:italic; line-height:1; color: #2f353e; ">
					Welcome on board!
					</span>

					<br><br>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; line-height:1; color: #2f353e; ">

					</span>

					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>

					<a href="'.URL_SITE.'" style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; text-decoration:none; line-height:1; color: #2f353e; ">
					'.URL_BEAUTY.'
					</a>
					<span style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 18px; line-height:1.5; color: #3f444d; ">|</span>
					</td>
					</tr>

					</table>

					<table width="100%" height="120" border="0" align="center" cellpadding="25" cellspacing="0" background="'.URL_SITE.'emails/registration/images/onda-blanca.png" style="margin-top:15px;">

					<tr>
					<td align="center" valign="top">
					</td>
					</tr>

					</table>

					</td>
					</tr>
				</table>';
		
		// Email Subject 
		$subjectmail = 'Welcome to Sidneey Newsletter';

		if ($this->sendmyemail($body,$subjectmail,$email))
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	function sendmyemail($body,$subjectmail,$email)
	{
		require_once('phpmailer/class.phpmailer.php');
		
		$mail = new PHPMailer(true); // Declaramos un nuevo correo, el parametro true significa que mostrara excepciones y errores.
		 
		$mail->IsSMTP(); // Se especifica a la clase que se utilizará SMTP

		$mail->Host       = SMTP_HOST;      				// SMTP server
		$mail->SMTPDebug  = 0;                     			// enables SMTP debug information (for testing)																	
		$mail->SMTPAuth   = true;                  			// enable SMTP authentication
		$mail->Host       = SMTP_HOST;      				// SMTP server
		$mail->Port       = 26;                   			// set the SMTP port for the GMAIL server
		$mail->Username   = SMTP_USER;  					// username
		$mail->Password   = SMTP_PASSWD;            		// password

		$mail->SetFrom(FROM_MAILWEB, NAME_MAILWEB);
		$mail->AddReplyTo(FROM_MAILWEB, NAME_MAILWEB);

	##################	

		$mail->Subject    = $subjectmail;

		$mail->MsgHTML($body);

		$address	=	$email;
#		$address	=	"cpinto@intotechs.net";
#		$devmail1	=	"carpint24@gmail.com";
#		$devmail2	=	"intotech@hotmail.com";
		
		$mail->AddAddress($address);
#		$mail->AddBCC($devmail1);
#		$mail->AddBCC($devmail2);
		

		if(!$mail->Send()) {
			return "Mailer Error: " . $mail->ErrorInfo;
			#return false;
		} else {
			$mail->ClearAddresses();
			$mail->ClearAttachments();
			#return "Message sent to ".$address."!";
			return true;
		}
	}

	};
	
	/* Initialize mailer object */
	$mailer = new Mailer;
?>