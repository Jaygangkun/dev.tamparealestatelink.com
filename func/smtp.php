<?php
########################################################
# SMTP EMAIL FUNC SCRIPT                               #
# smtp.php -- 8/12/09                                  #
# Function for sending emails via smtp                 #
########################################################

####################
# Define Variables #
####################
if(isset($func_path)){
    require_once($func_path.'/class.phpmailer.php');
}
else{
    require_once('func/class.phpmailer.php');
}


########################
# Send Emails Function #
########################
function email($to,$subject,$body,$fromaddress,$fromname='',$att_path=null,$att_filename='')
{
 $email = new PHPMailer();
 $email->IsHTML(true);
 $email->From      = $fromaddress;
 $email->FromName  = $fromname;
 $email->Subject   = $subject;
 $email->Body      = $body;
 $email->AddAddress($to);
 if($att_path){
    $email->AddAttachment($att_path.$att_filename,$att_filename);
 }
 
 return $email->Send();
}

?>
