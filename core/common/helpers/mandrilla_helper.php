<?phpheader('Content-Type: text/html; charset=utf-8');require COMMONPATH . 'third_party/phpmailer/class.phpmailer.php';function envia_email_mandrilla($dados, $destinatario) {    $mail = new PHPMailer;    $mail->SMTPDebug = 1;    $mail->IsSMTP();                                      // Set mailer to use SMTP    $mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server    $mail->Port = 587;                                    // Set the SMTP port    $mail->SMTPAuth = true;                               // Enable SMTP authentication    $mail->Username = 'webmaster@landsdigital.com.br';                // SMTP username    $mail->Password = 'BsPIqhXfVHoZCMhg-QZDIw';                  // SMTP password    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted    $mail->Sender = $dados->From;    $mail->From = $dados->From;    $mail->FromName = $dados->FromName;    $mail->AddAddress($destinatario);//       ver($dados,1);//    ver($destinatario);//      print_r($destinatario);//// Add a recipient//$mail->AddAddress('ellen@example.com');               // Name is optional    $mail->IsHTML(true);                                  // Set email format to HTML    $mail->Subject = $dados->Subject;    $mail->Body = $dados->Body;    $mail->AltBody = $dados->Subject;//    echo "<pre>";//    print_r($mail);//die();//ver($mail);    if (!$mail->Send()) {        echo '- Não Enviada';        echo '- Erro: ' . $mail->ErrorInfo;        echo '<br>';        return $mail->ErrorInfo;        exit;    } else {        echo '- Enviada <br>';        return 'enviada';    }}