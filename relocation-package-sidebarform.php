<?php
function ip2CountrySidebar()
{
    //API docs can be found here at https://freegeoip.net/
    $country = 'N/A';
    $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $access_key = '75f806e7c1b95207c6531dd314b6fba2';
    $api_url = 'http://api.ipapi.com/'.$ip.'?access_key='.$access_key.'';
    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_URL,$api_url);
    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    $results = curl_exec($curl_handle);
    curl_close($curl_handle);
    if(!empty($results))
    {
        $data = json_decode($results);
        $country = $data->country_name;
    }
    return $country;
}
$ip_country = 'N/A';//ip2CountrySidebar();
$curr_user_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

?>
<script  src="js/jquery.redirect.js"></script>
<style>
.form-control {
	border-radius: 0px;
	height: 26px;
	border-top: 1px solid #7c7c7c;
    border-left: 1px solid #c3c3c3;
    border-right: 1px solid #c3c3c3;
    border-bottom: 1px solid #ddd;
}
#sideBarform {
	font-family: 'Lucida Sans', pt_serifregular, PT Serif, Arial, san-serif;
	font-size: 11.5px;
	min-width:247px;
	max-width:247px;
}
.getinfo
{
	width:100% !important;
}

.formsmallfont{
	font-size:10px;
}
.headerImage
{
	width: 250px;
	margin-left: auto;
    margin-right: auto;
}
</style>

<div id="sideBarform">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="headerImage text-center">
            <p style="width:100%; text-align:center; font-family: pt_serifregular,PT Serif,Arial,san-serif; font-weight: bold; font-size: 32px; margin: 20px 0px;">Download Free Guide</p>
        </div>
    </div>
    <div class="hide" id="missingFieldErrMsg">
        <div class="errMess">
            Error - You didn't fill in all the required fields. Required fields missing are:
            <div id="missingFieldsList">

            </div>
        </div>
    </div>

    <form name="TAM-ENG" id="TAM-ENG" action="https://www.bahia-realty.com/alexa/modules/Webforms/capture.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="__vtrftk" value="sid:4021b675018f8fd20f41cbc95ef487dde7ab548a,1466203979">
        <input type="hidden" name="publicid" value="46f6b5ca87544cd4e86fa75df4192586">
        <input type="hidden" name="name" value="TAM-ENG">

        <div class="form-group">
            <label for="firstname">First Name </label> 
            <input type="text" class="form-control reqField" name="firstname" fieldname="First Name" value="<?=@$_POST['firstname']?>">
        </div>

        <div class="form-group">
            <label for="lastname">Last Name </label> 
            <input type="text" class="form-control reqField" name="lastname" fieldname="Last Name" value="<?=@$_POST['lastname']?>">
        </div>

        <div class="form-group">
            <label for="phone">Phone </label> 
            <input type="text" class="form-control reqField" name="label:Phone" fieldname="Phone" value="<?=@$_POST['label:Phone']?>">
        </div>

        <div class="form-group">
            <label for="email">Email </label>
            <input type="email" class="form-control reqField" name="email" id="email" fieldname="Email" value="<?=@$_POST['email']?>">
        </div>

        <div class="checkbox">
            <label class="formsmallfont">
            <input type="checkbox" id="emailoptout" name="emailoptout" value="Yes" checked>
                Receive additional information via email. Unsubscribe at any time.
            </label>
        </div>

        <input type="hidden" id='countryid' name="label:Country_of_IP_Address" value="<?=$ip_country?>">
        <input type="hidden" name="label:Wants_to" value="Buy">
        <input type="hidden" id='countryname' name="label:Country" value="<?=$ip_country?>">
        <input type="hidden" id='countrycode' name="countrycode" value="<?=$ip_country?>">
        <input type="hidden" id='countrycity' name="label:City" value="<?=$ip_country?>">
        <input type="hidden" id='countryip' name="label:IP_Address" value="<?=$curr_user_ip?>">


        <div class="text-center">
            <img id="loading" class="hide" src="/images/spinner.gif"/>
            <div id="postError" class="hide" style="color:red;">An error occurred, please contact administrator or try again.</div>
            <button id="sidebarSubmit" class="btn red-btn">Download</button>
        </div>
    </form>
    
    <form id="sendEmailForm" action="thankyou/relocation-package.php" method="post">
        <input type="hidden" name="sendMailTo" id="sendMailTo" value="">
    </form>
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
    jQuery('#sidebarSubmit').click( function(e) {
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
    // check for missing info
    var errormsg = "";
    var flag = true;
    jQuery("#TAM-ENG .reqField").each(function(index){
        if(jQuery(this).val().trim() == "")
        {
            errormsg += "<li>" + jQuery(this).attr("fieldname") + "</li>";
            flag = false;
        }
    });
    if(flag == false)
    {
        jQuery("#missingFieldsList").html("<ul>" +errormsg + "</ul>");
        jQuery("#missingFieldErrMsg").removeClass("hide");
        return;
    }
    var firstname = jQuery("input[name=firstname]").val();
    var upper_firstname =  firstname.charAt(0).toUpperCase() + firstname.substr(1);
    jQuery("input[name=firstname]").val( upper_firstname );
    var lastname = jQuery("input[name=lastname]").val();
    var upper_lastname =  lastname.charAt(0).toUpperCase() + lastname.substr(1);
    jQuery("input[name=lastname]").val( upper_lastname );
    jQuery('#sidebarSubmit').prop("disabled",true);
    jQuery("#loading").removeClass("hide");
    jQuery("#missingFieldErrMsg").addClass("hide");
    jQuery.post('/vtiger_duplicatoin_check.php', jQuery('#TAM-ENG').serialize(), function(data) {
        if(data.IsDuplicate == "1")
        {
				// jQuery.redirect("thankyou/international-buyers.php",{sendMailTo: jQuery("#email").val()});
				jQuery('#sendEmailForm #sendMailTo').val(jQuery("#email").val());
				jQuery('#sendEmailForm').submit();	
        }
        else if(data.IsDuplicate == "0")
        {
            // Not duplicate send to vtiger
            jQuery.post( 'https://www.bahia-realty.com/alexa/modules/Webforms/capture.php', jQuery('#TAM-ENG').serialize(), function(data) {
                if(data.success === true)
                {
                    // jQuery.redirect("thankyou/international-buyers.php",{sendMailTo: jQuery("#email").val()});
                    jQuery('#sendEmailForm #sendMailTo').val(jQuery("#email").val());
                    jQuery('#sendEmailForm').submit();
                }
                else
                {
                    console.log(data);
                    jQuery("#postError").removeClass("hide");
                }
                jQuery("#loading").addClass("hide");
                jQuery('#sidebarSubmit').prop("disabled",false);
            },
            'jsonp' //Using jsonp instead json for Cross domain posting
            );
        }
    },
    'json' 
    );
    });
}
</script>