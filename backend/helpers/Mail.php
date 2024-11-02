<?

namespace backend\helpers;

class Mail
{
	
	public static function sendEmail($emails = array(), $subject = "", $body = "", $flashMessage = array(), $field = "", $model = null)
	{
		echo "<font color=red>";
		
		echo "!1";
		
		$sendResult = false;
		$fromEmail = \Yii::$app->params["infoEmail"];
		$fromName = "Complete-Center";
		$toEmail = "";

		echo "!2 -> ";
		print_r($fromEmail);

		$wrongRecipients = array();
		$wrongResults = array();
		$globalResult = false;

		echo "!3";

		foreach($emails as $email) {
			$result = -1;

			$emailBody = $body;

			if(!is_array($email)) {
				$emailItSelf = $email;
				$email = array(
					"email" => $emailItSelf
				);
			}

			echo "!4";
			print_r($email);
			
			try {
				
				if(!empty($email["email"])) {
					$toEmail = $email["email"];
					if (!empty($email["fromEmail"])) {
						$fromEmail = $email["fromEmail"];
						$fromName = $email["fromName"];
					}
					
					echo "!5";

					//$logger = new \Swift_Plugins_Loggers_ArrayLogger();

					$yiiMailer = \Yii::$app->mailer;
					//$mailer = $yiiMailer->getSwiftMailer();
					//$mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));
					$message = $yiiMailer->compose();

					echo "!6";
					print_r($message);
					
					
					echo "<font color=green>";
					echo "<br/>1.";
					print_r($toEmail);
					echo "<br/>2.";
					print_r($fromName);
					echo "<br/>3.";
					print_r($subject);
					echo "<br/>4.";
					print_r($emailBody);
					echo "</font><br/>";
					
					$mail = $message
						->setTo($toEmail)
						->setFrom([$fromEmail => $fromName])
						//->setFrom($fromName)
						->setSubject($subject)
						->setHtmlBody(str_replace("\n", "<br/>", $emailBody));
					
					echo "!7";
					
					if(!is_null($model)) {
						foreach ($model->files as $file) {
							$mail->attach($model->getMultiFilePath() . $file->filename);
						}
					}

					print_r($mail);
					
					//-- \Swift_DependencyException
					try {
						//-- \Swift_SwiftException
						try {
							//-- \Swift_IoException
							try {
								//-- \Swift_TransportException
								try {
        					//-- \Swift_RfcComplianceException
									try {
        						$numSent = $mailer->send($message->getSwiftMessage(), $recipients);
        						
        						if($numSent > 0) {
        							$result = "1";
        							$sendResult = true;
        						} else {
        							$strErr = "************** Ошибка отправки почты **************\n";
        							$strErr .= "numSent = ".(string)$numSent." (".gettype($numSent).")\n";
        							$strErr = "***************************************************\n";
        							if(!is_null($recipients)) {
        								if(is_array($recipients)) {
        									$wrongRecipients = $recipients;
        									$result = "Ошибка отправки почты: ".$toEmail;
        								}
        							}
        						}
    							} catch (\Swift_RfcComplianceException $ste) {
        						$result = $ste->getMessage();
    							}
    						} catch (\Swift_TransportException $ste) {
    							$result = $ste->getMessage();
    						}
    					} catch (\Swift_IoException $ste) {
    						$result = $ste->getMessage();
    					}
    				} catch (\Swift_SwiftException $ste) {
    					$result = $ste->getMessage();
    				}
    			} catch (\Swift_DependencyException $ste) {
        		$result = $ste->getMessage();
    			}
				
				} else {
					$result = "Почтовый адрес отсутствует";
				}
				
			} catch (\Exception $ex) {
				$result = $ex->getMessage();
				if(preg_match("{(fsockopen\(\)\:)(.*)}si", $result, $matched)) {
					$result = trim($matched[2]);
				} elseif(preg_match("{(fsockopen\(\))(.*)}si", $result, $matched)) {
					$result = trim($matched[2]);
				}
			}

			if(!empty($result)) {
				//-- nothing to do...
			} else {
				$result = "Неизвестная ошибка";
			}

			$data = array(
				"from" => $fromEmail,
				"to" => $toEmail,
				"subject" => $subject,
				"body" => $emailBody,
				"result" => $result,
			);

		}

		if($result !== "1") {
			$globalResult = true;
			$wrongResults[] = $result;
		}

		$mailSendMessage = array();
		if($globalResult) {
			$mailSendMessage["type"] = "error";
			if(!empty($wrongRecipients)) {
				$mailSendMessage["text"] = "&nbsp;&nbsp;&nbsp;Ошибка отправки почты: ".implode(", ", $wrongRecipients);
			} else {
				$mailSendMessage["text"] = "&nbsp;&nbsp;&nbsp;".implode(". ", $wrongResults);
			}
		} else {
			$mailSendMessage["type"] = "success";
			$mailSendMessage["text"] = "&nbsp;&nbsp;&nbsp;Почта успешно отправлена всем адресатам!";
		}
		if(is_array($mailSendMessage) && !empty($mailSendMessage["type"]) && !empty($mailSendMessage["text"])) {
			\Yii::$app->session->setFlash($mailSendMessage["type"], $mailSendMessage["text"]);
		}

		if(is_array($flashMessage) && !empty($flashMessage["type"]) && !empty($flashMessage["text"])) {
			\Yii::$app->session->addFlash($flashMessage["type"], $flashMessage["text"]);
		}

		echo "</font>";

		return $sendResult;
	}

	public static function send($mailTo, $subject, $message, $mailFrom, $urldecode=true)
	{
  	if(is_array($mailTo)) {
  		$mailTo = implode(",", $mailTo);
  	}
  	if(is_array($mailFrom)) {
  		$mailFrom = implode(",", $mailFrom);
  	}

  	if($urldecode) {
  		$subject = self::utf8_urldecode($subject);
  		$message = self::utf8_urldecode($message);
  		/*
  		$subject = self::unescape($subject);
  		$message = self::unescape($message);
  		
  		$subject = self::stripTags($subject);
  		$message = self::stripTags($message);

  		echo "...cleaned!<br/>";
  		*/
  	}

  	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
    
    //$mailto = 'mail@mail.com';
    //$mailfrom = 'test@test.com';
    //$subject = 'Тема сообщения';
    //$message = 'Само сообщение!';

    //-- a random hash will be necessary to send mixed content
    $separator = md5(uniqid(time()));

    //-- carriage return type (RFC)
    $eol = "\r\n";

    //-- main header (multipart mandatory)
    $headers = "From: ".$mailFrom. $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

    //-- message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $body .= $message . $eol . $eol;

    //@ob_start();
    if(!empty($_FILES)) {
			if(count(array_values($_FILES)) > 0) {
				$files = array_values($_FILES);
				
				foreach($_FILES as $formName => $files) {

					//-- get list of the form field names
					$formFieldNames = array_keys($files["name"]);
					
					foreach($formFieldNames as $fld) {
						$fileName = $files["name"][$fld];
						if(!empty($fileName)) {
							$fileError = $files["error"][$fld];
					    if($fileError === 0) {
    						$fileType = $files["type"][$fld];
    						$fileTmpName = $files["tmp_name"][$fld];
    						$fileSize = $files["size"][$fld];
								
								//-- attachments
								$filename = basename($fileName);
    						$file = $fileTmpName;

    						if(file_exists($file)) {
    							$content = file_get_contents($file);
    							$content = chunk_split(base64_encode($content));
    			        
                  $body .= "--" . $separator . $eol;
                  $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
                  $body .= "Content-Transfer-Encoding: base64" . $eol;
                  $body .= "Content-Disposition: attachment; filename=\"".$filename . "\"" . $eol . $eol;
                  $body .= $content . $eol;
    						}
              }
            }
          }
				}
			}
		}
		
		$body .= "--" . $separator . "--";
    
    //-- SEND Mail
    if(@mail($mailTo, $subject, $body, $headers)) {
      return true;
    } else {
      return error_get_last();
    }
    //$buffer = @ob_get_contents();
		//@ob_end_clean();
		//file_put_contents("c:/test.log", $buffer);
	}

	public static function utf8_urldecode($str)
	{
  	return html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str)), null, 'utf-8');
	}

	public static function removeWhitespaces($str)
	{
		$whitespace = '~(<CR>|<LF>|0x0A|%0A|0x0D|%0D|\\n|\\r|\s)+~i';
		$str = trim(preg_replace($whitespace, '', $str));
    
    $str = preg_replace("([\r\n])", "", $str);
    
    return $str;
  }

	public static function unescape($source='')
	{
    $decodedStr = "";  
    $pos = 0;  
    $len = strlen ($source);  
    while($pos < $len) {  
      $charAt = substr ($source, $pos, 1);  
      if($charAt=='%') {  
        $pos++;  
        $charAt = substr($source, $pos, 1);  
        if($charAt=='u'){  
          //-- we got a unicode character  
          $pos++;  
          $unicodeHexVal = substr ($source, $pos, 4);  
          $unicode = hexdec($unicodeHexVal);  
          $entity = "&#". $unicode . ';';  
          $decodedStr .= utf8_encode($entity);  
          $pos += 4;  
        } else {  
          //-- we have an escaped ascii character  
          $hexVal = substr($source, $pos, 2);  
          $decodedStr .= chr(hexdec ($hexVal));  
          $pos += 2;  
        }  
      } else {  
        $decodedStr .= $charAt;  
        $pos++;  
      }  
    }  
    return $decodedStr;  
	}

	public static function stripTags($str)
	{
    $str = stripslashes($str);
    $str = preg_replace("'<[^>]+>'U", "", $str);
 		return $str;
	}

}
