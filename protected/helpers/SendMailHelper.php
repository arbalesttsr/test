<?php

class SendMailHelper
{

    //CONST from_email = 'yiiteste@gmail.com';//'supportmtc@bts.md';
    //CONST from_user = 'Sinapsys';
    //CONST host = 'smtp.gmail.com';//'mail.software.md';
    //CONST port = 587;//465;//2525;
    //CONST secure = 'tls';
    //CONST username = 'yiiteste@gmail.com';//'Nippon\support_mtc';
    //CONST password = 'YIIteste1';//'1234qweAS';

    public static function sendMail($to_email, $to_name, $to_subject, $to_content, $doc = null)
    {
        $mail = new YiiMailer();
        $from_email = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_ID)->config_value : 'yiiteste@gmail.com';
        $from_user = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_NAME_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_NAME_ID)->config_value : 'Synapsis';
        $host = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_HOST_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_HOST_ID)->config_value : 'smtp.gmail.com';
        $port = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_PORT_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_PORT_ID)->config_value : '587';
        $secure = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_SECURE_TLS_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_SECURE_TLS_ID)->config_value : 'tls';
        $password = !is_null(BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_PASSWORD_ID)) ? BaseConfigs::model()->findByPk(BaseConfigs::CONFIG_SYSTEM_MAIL_PASSWORD_ID)->config_value : 'YIIteste1';

        $mail->setFrom($from_email, $from_user);

        $mail->setTo($to_email);
        $mail->setSubject($to_subject);
        $mail->setBody($to_content);

        $mail->IsSMTP();
        $mail->Host = $host;
        $mail->Port = $port;
        //$mail->Port = 143;

        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $secure;

        $mail->Username = $from_email;
        $mail->Password = $password;

        if(!is_null($doc))
            $mail->setAttachment($doc);

        if (!$mail->send())
            die(var_dump($mail->getError()));
        else
            if(!is_null($doc))
                @unlink($doc);
    }
}


