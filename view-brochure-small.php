<?php

//include_once 'admin/config.php';

//include_once 'admin/func/common.php';

$_GET['mls'] =$mls ;

$_SERVER['HTTP_HOST'] = (substr($_SERVER['REQUEST_URI'],0,6)=='/bahia') ? $_SERVER['HTTP_HOST'].'/bahia' : $_SERVER['HTTP_HOST'];

$country = 'N/A';//ip2Country('',false);

$curr_user_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];



$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

$manual = is_numeric(substr($mls,0,1));

##############

# Send Email #

##############

if(isset($_POST["__vtrftk"]))

{

	$country = (@$_POST['label:Country']!='') ? $_POST['label:Country'] : 'N/A';

	###############

	# Define Vars #

	###############

	$inputValid = true;

	$subject = 'View Listing Brochure - Bahia International Realy';

	$first_name = $_POST['firstname'];

	$last_name = $_POST['lastname'];

	$email = $_POST['email'];

	$phone = $_POST['label:Phone'];

	$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	$required = array(

			'firstname' => 'First Name',

			'lastname' => 'Last Name',

			'label:Phone' => 'Phone',

			'email' => 'Email',

	);



	################

	# Get Email To #

	################

	$results = mysqli_query ( $con,"SELECT * FROM $tbl_forms WHERE form='View Listing Brochure' LIMIT 1" );

	$row = array();

	if ($results !== false ) {

		$row = mysqli_fetch_assoc ($results);

	}

	$to = (@$row ['emails']) ? $row ['emails'] : 'info@TampaRealEstateLink.com';



	####################

	# Prevent Spammers #

	####################

	// Honey Pot Check

	if(@$_GET['comment']!='')

	{

		sleep(rand(2,5));

		header("HTTP/1.0 403 Forbidden");

		exit;

	}

	// IP of Known Spammer Check

		$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

		$ip = end(array_reverse(explode(',',$ip)));

		$curl_handle=curl_init();

		curl_setopt($curl_handle,CURLOPT_URL,'http://www.stopforumspam.com/api?ip='.$ip);

		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);

		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);

		$xml = curl_exec($curl_handle);

		curl_close($curl_handle);

		try { $xml = (array) new SimpleXMLElement($xml); }

		catch(Exception $e) { $xml = array(); }

		if(@$xml['appears']=='yes')

		{

			sleep(rand(2,5));

			header("HTTP/1.0 403 Forbidden");

			exit;

		}



	##################

	# Validate Input #

	##################

	$blanks = '';

	foreach($required as $k => $v)

	{

		if(@$_POST[$k]=='') { $blanks .= '<li>'.$v.'</li>'; }

	}

	if($blanks) { $errMess .= '<div class="errMess">Error - You didn\'t fill in all the required fields. Required fields missing are:<ul>'.$blanks.'</ul></div>'; $inputValid = false; }

	if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) && $email)

	{ $errMess .= '<div class="errMess">Error - The email address you enter is not valid.</div>'; $inputValid = false; }



	##############

	# Send Email #

	##############

	if($inputValid)

	{

		$ViewListingDetails = 'https://'.$_SERVER['HTTP_HOST'].'/result.php?mls='.$mls;

		if(strpos(basename($_SERVER["REQUEST_URI"], ".php"),"result_newhome") !== false)

		{

			$ViewListingDetails = 'https://'.$_SERVER['HTTP_HOST'].'/result_newhome.php?mls='.$mls;

		}



		$headers = "From: " . strip_tags($_POST['email']) . "\r\n";

		$headers .= "MIME-Version: 1.0\r\n";

		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

		if(@$_POST['emailoptout']=='Yes')

		{

			$subject = 'Buyer Lead - A Customer Downloaded a Listing Brochure';

			 

			$message = 'The following person downloaded the Listing Brochure.<br>Property Detail: <a href="'.$ViewListingDetails.'">Go to the Property</a><br><br>First Name: '.$first_name.'<br>Last Name: '.$last_name.'<br>Email: '.$email.'<br>Phone: '.$phone.'<br><br>This person opted into your mailing list.<br>IP Address of Sender: '.$ip.'<br>Country of IP: '.$country.'';

			//echo "<pre>$message</pre>";

			// Not needed now.

			//mail($to,$subject,$message,$headers);

		}

		$subject = 'Listing Brochure '.$mls;

		

		$message = 'Hello ' . $first_name . ',

<br><br>The information you requested is attached.  You can use the following link to return to our website and view the property.

<br><br><table cellpadding="0" cellspacing="0" border="0">

<tr>

 <td style="padding-right:20px;"><img src="' . DEF_IMAGE_URL_PDF . 'images/mls/' . $img_file . '" width="185" alt=""></td>

 <td>' . $city . '

  <br>Price: $' . number_format ( $price ) . '

  <br>Type: ' . $type . '

  ' . (($architectural_style) ? '<br>Style: ' . $architectural_style : '') . '

  <br>Bedrooms: ' . $beds . '

  <br>Bathrooms: ' . $baths . '

  <br>Size: ' . number_format ( $sqft ) . ' sq. ft.

  <br><br><a href="'.$ViewListingDetails.'">View Listing Details</a>

 </td>

</tr>

</table>

<br><br><table cellpadding="0" cellspacing="0" border="0">

<tr>

 <td style="padding-right:20px;"><img src="' . DEF_IMAGE_URL_PDF . 'images/raul-aleman-jennifer-cook189.jpg" alt="Jennifer Cook and Raul Aleman"></td>

 <td>Jennifer Cook & Raul Aleman

  <br>Bahia International Realty

  <br>Tampa, Florida

  <br>United States

  <br>Phone: 813-402-1324

  <br><br><a href="https://' . $_SERVER ['HTTP_HOST'] . '/contact.php">contact us</a>

 </td>

</tr>

</table>

		

<br>Visit our website: <a href="https://www.TampaRealEstateLink.com/">https://www.TampaRealEstateLink.com/</a>

<br><br><b>&#8220;We take care of your Tampa real estate investment from start to finish - Property Management service available.&#8221;</b>

';

		include_once 'func/smtp.php';

		include_once 'inc.brochure-pdf.php';

		//echo "<pre>$message</pre>";

		if(!email(strip_tags($email),$subject,$message,strip_tags($to),'Bahia International Realty',$_SERVER['DOCUMENT_ROOT'].'/pdf/',str_replace(' ','_',$city).'_'.$mls.'.pdf'))

		{ $errMess = '<div class="errMess">Error - there was an internal error sending the listing. Please try again</div>';  }

		else { $succ = true;  }

	}

}

?>



<style>

.form-control {

	border-radius: 0px;

	height: 26px;

/* 	width:85% !important; */

	border-top: 1px solid #7c7c7c;

    border-left: 1px solid #c3c3c3;

    border-right: 1px solid #c3c3c3;

    border-bottom: 1px solid #ddd;

}



#brochureInclusion {

	font-family: 'Lucida Sans', pt_serifregular, PT Serif, Arial, san-serif;

	font-size: 11.5px;

	min-width:247px;

	max-width:247px;

	margin-left:auto;

	margin-right:auto;

}

.getinfo

{

	width:100% !important;

}



.contactformsmaller{

	font-size:10px;

}

</style>

<div id="brochureInclusion">



	<?php

	if(@$succ)

	{

		// $url should be an absolute url

		function redirect($url){

			if (headers_sent()){

				die('<script >window.location.href="' . $url . '";</script>');

			}else{

				header('Location: ' . $url);

				die();

			}

		}

		

		redirect('/thankyou/view-brochure.php');

		//header("Location:/thankyou/view-brochure.php");

	}

	?>

	<div class="row">

		<div class="col-md-12">

			<img alt="getinfo" src="/images/getinfo.png" class="img-responsive getinfo">

		</div>

	</div>



	<div class="row">

	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>

		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">



			<form method="post" name="TAM-ENG" id="TAM-ENG">

				<input type="hidden" name="action" value="send">

				<input type="hidden" name="comment">

				<input type="hidden" name="__vtrftk" value="sid:4021b675018f8fd20f41cbc95ef487dde7ab548a,1466203979">

				<input type="hidden" name="publicid" value="46f6b5ca87544cd4e86fa75df4192586">

				<input type="hidden" name="name" value="TAM-ENG">

				<?php echo @$errMess;?>

						

				<div class="form-group">

					<label for="firstname">First Name </label>

					<input type="text" class="form-control" name="firstname" value="<?=@$_POST['firstname']?>">

				</div>



				<div class="form-group">

					<label for="lastname">Last Name </label> 

					<input type="text" class="form-control" name="lastname" value="<?=@$_POST['lastname']?>">

				</div>



				<div class="form-group">

					<label for="label:Phone">Phone </label> 

					<input type="text" class="form-control" name="label:Phone" value="<?=@$_POST['label:Phone']?>">

				</div>



				<div class="form-group">

					<label for="email">Email </label> 

					<input type="email" class="form-control" name="email" value="<?=@$_POST['email']?>">

				</div>



				<div class="checkbox">

					<label class="contactformsmaller"> 

					<input type="checkbox" id="emailoptout" name="emailoptout" value="Yes" checked> Receive additional information via email. Unsubscribe at any time.

					</label>

				</div>



				<input type="hidden" id='countryid'  name="label:Country_of_IP_Address" value="<?=$country?>">

				<input type="hidden" name="label:Wants_to" value="Buy">

				<input type="hidden" id='countryname' name="label:Country" value="<?=$country?>">

				<input type="hidden" id='countrycode' name="countrycode" value="<?=$country?>">

				<input type="hidden" id='countrycity' name="label:City" value="<?=$country?>">

				<input type="hidden" id='countryip' name="label:IP_Address" value="<?=$curr_user_ip?>">

				<?php

				  $desc = "Form Name: Listing Brochure Request." . "\r\n" . "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ; 

				?>

				<input type="hidden" name="description" value="<?=$desc?>">

				

				<div class="text-center">

					<img id="loading" class="hide" src="/images/spinner.gif"/>

					<div id="postError" class="hide" style="color:red;">An error occurred, please contact administrator or try again.</div>

				</div>

				<button type="submit" name="reqBrochure" id="reqBrochure" class="btn red-btn">Request Brochure</button>

				



			</form>



		</div>

	</div>

</div>

<script>

function checkjQuery(){
	if(window.jQuery){
		console.log('jQuery loaded');
		callbackjQuery();
		return true;
	}

	setTimeout(function(){
		checkjQuery();
	}, 100);
	return false;
}

checkjQuery();

function callbackjQuery(){
	jQuery('#reqBrochure').click( function(e) {

	e.preventDefault();

	jQuery.ajax({

		url: "/ajaxcontrol.php",

		dataType: "json",

		async:false,

		type:'post',

		data: {

			data:'country',

			getdata:'ip2country',

		},

		success: function(data) {

			if(data.success==1){

				jQuery('#countryid').val( data.country );

				jQuery('#countryname').val( data.country );

				jQuery('#countrycode').val( data.country_code );

				jQuery('#countrycity').val( data.city );

				jQuery('#countryip').val( data.country_ip );

			}

		},

		error: function(data) {

			

		}

	});

	if(validateForm() == true)

	{



		var firstname = jQuery("input[name=firstname]").val();

		var upper_firstname =  firstname.charAt(0).toUpperCase() + firstname.substr(1);

		jQuery("input[name=firstname]").val( upper_firstname );

		var lastname = jQuery("input[name=lastname]").val();

		var upper_lastname =  lastname.charAt(0).toUpperCase() + lastname.substr(1);

		jQuery("input[name=lastname]").val( upper_lastname );

		

		jQuery("#loading").removeClass("hide");



		jQuery.post('/vtiger_duplicatoin_check.php', jQuery('#TAM-ENG').serialize(), function(data) {

			if(data.IsDuplicate == "1")

			{

				document.getElementById("TAM-ENG").submit();

			}

			else if(data.IsDuplicate == "0")

			{

				console.log(jQuery('#TAM-ENG').serialize());

				// Not duplicate send to vtiger

				jQuery.post( 'https://www.bahia-realty.com/alexa/modules/Webforms/capture.php', jQuery('#TAM-ENG').serialize(), function(data) {

					if(data.success === true)

					{

						// SUBMIT FORM

						document.getElementById("TAM-ENG").submit();

					}

					else

					{

						console.log(data);

						jQuery("#postError").removeClass("hide");

					}

					jQuery("#loading").addClass("hide");

				},

				'jsonp' //Using jsonp instead json for Cross domain posting

				);

				

			}

		},

		'json' 

	);

		

		

	}

	});
}





function validateForm() {

    var x = document.forms["TAM-ENG"]["firstname"].value;

    if (x == null || x == "") {

        alert("First name must be filled out");

        return false;

    }



    var x = document.forms["TAM-ENG"]["lastname"].value;

    if (x == null || x == "") {

        alert("Last name must be filled out");

        return false;

    }



    var x = document.forms["TAM-ENG"]["label:Phone"].value;

    if (x == null || x == "") {

        alert("Phone number must be filled out");

        return false;

    }



    var x = document.forms["TAM-ENG"]["email"].value;

    if (x == null || x == "") {

        alert("Email must be filled out");

        return false;

    }

    return true;

}



</script>