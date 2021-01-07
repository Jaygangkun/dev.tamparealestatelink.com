<?php
########################################################
# SMTP EMAIL FUNC SCRIPT                               #
# smtp.php -- 8/12/09                                  #
# Function for sending emails via smtp                 #
########################################################

####################
# Define Variables #
####################
require_once('func/class.phpmailer.php');

########################
# Send Emails Function #
########################
function email($to,$subject,$body,$fromaddress,$fromname='',$att_path,$att_filename)
{
 $email = new PHPMailer();
 $email->IsHTML(true);
 $email->From      = $fromaddress;
 $email->FromName  = $fromname;
 $email->Subject   = $subject;
 $email->Body      = $body;
 $email->AddAddress($to);
 $email->AddAttachment($att_path.$att_filename,$att_filename);
 return $email->Send();
}

?>
