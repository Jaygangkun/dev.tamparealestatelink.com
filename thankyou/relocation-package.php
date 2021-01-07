<?php
// #################
// Include Header #
// #################
$path = '';
$meta_title = 'Thank you for contacting Bahia International Realty!';
$meta_description = 'Thank you for contacting Bahia International Realty! We will be in touch with you soon.';
include $path . '../header.php';

$phone = "(813) 402-1324";
$website ="www.tamparealestatelink.com";
$website_email ="info@tamparealestatelink.com";
$fromEmail = "Raul Aleman <info@tamparealestatelink.com>";
$mailSubject = "Download your Tampa Relocation Guide";
?>

<div class="container userregthankyou">
	<div class="row">
		<div class="col-md-12">
						<?php 
				if(isset($_POST['sendMailTo']))
				{
					$ToEmail = $_POST['sendMailTo'];
					$message = "<h2><a href=\"https://www.bahia-realty.com/download/tampa-relocation-package.pdf\">Download the Tampa Relocation Guide</a></h2>
								Thank you for downloading the Tampa Relocation Guide!  
								Our Tampa Home Consultant will be contacting you within 1-2 business days to see if you have any questions.
								To receive immediate assistance, please call $phone or <a href=\"https://www.tamparealestatelink.com/contact.php\">Contact Us</a>.		
					
							<br><br>
							Sincerely,<br>
							Raul Aleman<br>
							Bahia International Realty<br>
							$phone<br>
							<a href=\"https://www.tamparealestatelink.com/contact.php\">Contact Us</a><br>
							$website<br>";
					
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=utf-8\r\n";
					$headers .= "From: ".$fromEmail."\r\n";
					mail ( $ToEmail, $mailSubject, $message, $headers);
				}
			?>
		  <h1>Success!</h1>
            <img src="../images/thankyou.jpg" />
			<p>We sent you the free Tampa Relocation Guide. If you do not see the email in your inbox, please check your spam or junk folder as it may have found its way there in error.</p>
            <h3>Do you know which area in Tampa you're moving to?  </h3>
            <p>Our experienced Tampa realtor will contact you in the next few days to see if they can help you with finding the exact home you're looking for.  You can talk to them to get information about areas with best schools and neighborhoods.</p>
            <h3>We have access to 100% of the available properties in Tampa Bay area.  </h3>
            <p>Our services are free to homebuyers, so do take advantage of the experience and market knowledge Bahia realtors have to offer!</p>
            <p>If you'd like immediate assistance, please <a href="../contact.php">contact us</a>.</p>
            <p>&nbsp;</p>
	  </div>
	</div>
</div>
<?php
// #################
// Include Footer #
// #################
include $path . '../footer.php';
?>