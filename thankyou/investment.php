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
$mailSubject = "Download your free Brochure";
?>

<div class="container userregthankyou">
	<div class="row">
		<div class="col-md-12">
			<?php 
				if(isset($_POST['sendMailTo']))
				{
					$ToEmail = $_POST['sendMailTo'];
					$message = "<h2><a href=\"https://www.bahia-realty.com/download/bahia-investment-brochure.pdf\">Download Free Brochure</a></h2>
							<p>Thank you for downloading the Orlando Vacation Home Investment Guide!  Our Orlando Home Consultant will be contacting you within 1-2 business days to see if you have any questions.</p>
							<p>To receive immediate assistance, please call $phone or <a href=\"https://www.tamparealestatelink.com/contact.php\">Contact Us</a>.</p>
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
			<h1>Success, Attachment Sent!</h1>
			<p>We sent you the free guide. If you do not see the email in your inbox, please check your spam or junk folder as it may have found its way there in error.</p>
            <p>We will contact you in the next 1-2 days to see if you have any questions.</p>
		</div>
	</div>
</div>
<?php
// #################
// Include Footer #
// #################
include $path . '../footer.php';
?>