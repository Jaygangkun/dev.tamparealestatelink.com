<?php

include_once 'func/rewrite_defines.php';

?>

<div class="container-fluid footerbackgroundcolor1">

	<div class="container">
		<?php
		if(!@$fb_share_btn){
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="text-right" style="margin-top: 20px;">
						<!-- Load Facebook SDK for JavaScript -->
						<div id="fb-root"></div>
						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=257161318600965&autoLogAppEvents=1"></script>

						<!-- Your like button code -->
						<!-- <div class="fb-like" data-href="https://www.facebook.com/BahiaInternationalRealty/" data-width="" data-layout="button" data-action="like" data-size="small" data-share="false"></div>
						<div class="fb-share-button" data-href="https://www.facebook.com/BahiaInternationalRealty/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> -->
						<div class="fb-like" data-href="https://www.facebook.com/BahiaInternationalRealty/" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<div class="footer">

				<div class="row">

					<div class="col-md-12">

						<div class="row">

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/apollo-beach.php">Apollo Beach</a></li>

										<li><a href="/Apollo-Beach/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Apollo-Beach/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Apollo-Beach/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/brandon.php">Brandon</a></li>

										<li><a href="/Brandon/<?=TYPES_single_family?>">Homes</a></li>

										<!-- <li><a href="/Brandon/<?=TYPES_condo?>">Condos</a></li> -->

										<li><a href="/Brandon/<?=TYPES_townhomes?>">Townhomes</a></li>

                                        <li>&nbsp;</li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/carrollwood.php">Carrollwood</a></li>

										<li><a href="/areas/Carrollwood/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/Carrollwood/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/Carrollwood/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/clearwater.php">Clearwater</a></li>

										<li><a href="/Clearwater/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Clearwater/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Clearwater/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>



							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/clearwater-beach.php">Clearwater Beach</a></li>

										<li><a href="/Clearwater-Beach/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Clearwater-Beach/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Clearwater-Beach/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/indian-rocks-beach.php">Indian Rocks Beach</a></li>

										<li><a href="/Indian-Rocks-Beach/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Indian-Rocks-Beach/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Indian-Rocks-Beach/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/lutz.php">Lutz</a></li>

										<li><a href="/Lutz/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Lutz/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Lutz/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/new-tampa.php">New Tampa</a></li>

										<li><a href="/areas/New-Tampa/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/New-Tampa/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/New-Tampa/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/palm-harbor.php">Palm Harbor</a></li>

										<li><a href="/Palm-Harbor/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Palm-Harbor/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Palm-Harbor/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/riverview.php">Riverview</a></li>

										<li><a href="/Riverview/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Riverview/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Riverview/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>



							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/seminole.php">Seminole</a></li>

										<li><a href="/Seminole/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Seminole/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Seminole/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/south-tampa.php">South Tampa</a></li>

										<li><a href="/areas/south-tampa/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/south-tampa/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/south-tampa/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/st-petersburg.php">St Petersburg</a></li>

										<li><a href="/St-Petersburg/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/St-Petersburg/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/St-Petersburg/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>



							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/st-pete-beach.php">St Pete Beach</a></li>

										<li><a href="/St-Pete-Beach/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/St-Pete-Beach/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/St-Pete-Beach/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>



							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/tampa.php">Tampa</a></li>

										<li><a href="/Tampa/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Tampa/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Tampa/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/tierra-verde.php">Tierra Verde</a></li>

										<li><a href="/Tierra-Verde/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Tierra-Verde/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Tierra-Verde/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/town-n-country.php">Town 'N Country</a></li>

										<li><a href="/areas/Town-N-Country/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/Town-N-Country/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/Town-N-Country/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/treasure-island.php">Treasure Island</a></li>

										<li><a href="/Treasure-Island/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/Treasure-Island/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/Treasure-Island/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/valrico.php">Valrico</a></li>

										<li><a href="/Valrico/<?=TYPES_single_family?>">Homes</a></li>

										<!--<li><a href="/Valrico/<?=TYPES_condo?>">Condos</a></li>-->

										<li><a href="/Valrico/<?=TYPES_townhomes?>">Townhomes</a></li>

                                        <li>&nbsp;</li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/wesley-chapel.php">Wesley Chapel</a></li>

										<li><a href="/areas/Wesley-Chapel/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/Wesley-Chapel/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/Wesley-Chapel/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/westchase.php">Westchase</a></li>

										<li><a href="/areas/Westchase/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/areas/Westchase/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/areas/Westchase/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/<?=SPECIAL_Premium?>">Luxury Homes</a></li>

										<li><a href="/<?=SPECIAL_Premium?>/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/<?=SPECIAL_Premium?>/<?=TYPES_condo?>">Condos</a></li>

                                        <li>&nbsp;</li>

									</ul>

								</div>

							</div>



							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/<?=SPECIAL_Golf?>">Golf Courses</a></li>

										<li><a href="/<?=SPECIAL_Golf?>/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/<?=SPECIAL_Golf?>/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/<?=SPECIAL_Golf?>/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/waterfront.php">Waterfront Homes</a></li>

										<li><a href="/waterfront-homes.php">Homes</a></li>

										<li><a href="/waterfront-condos.php">Condos</a></li>

										<li><a href="/waterfront-townhomes.php">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

										<li><a href="/<?=SPECIAL_Gated?>">Gated Community</a></li>

										<li><a href="/<?=SPECIAL_Gated?>/<?=TYPES_single_family?>">Homes</a></li>

										<li><a href="/<?=SPECIAL_Gated?>/<?=TYPES_condo?>">Condos</a></li>

										<li><a href="/<?=SPECIAL_Gated?>/<?=TYPES_townhomes?>">Townhomes</a></li>

									</ul>

								</div>

							</div>

                            

							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">

								<div class="footer-linklist">

									<ul>

                                        <li><span style="color: #3b393e; font-weight: bold; border-bottom: 1px solid #CFCCC8;">Other Categories</span></li>

										<li><a href="/<?=SPECIAL_Pool?>/<?=TYPES_single_family?>">Pool

												Homes</a></li>

										<li><a href="/<?=SPECIAL_Horses?>">Horses</a></li>

                                        <li><a href="/zip-code-search.php">Zip Code Search</a></li>

									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

	</div>

</div>

<div class="container-fluid footerbackgroundcolor2">

	<div class="container footer2">

		<div class="row">

			<div class="text-center footer2links"> 

				<ul>

					 <li><a href="/featured-listings.php">Featured Listings</a></li>

                     <li><a href="/management.php">Property Management</a></li>

				</ul>

		  </div>

			<div class="text-center footer2links"> 

				<ul>

					 <li><a href="/">Home</a></li>

					 <li><a href="/property-search.php">Search</a></li>

					 <li><a href="/about.php">About</a></li>

					 <li><a href="/our-team.php">Meet The Team</a></li>

					 <li><a href="/contact.php">Contact Us</a></li>

					 <li><a href="/relocation-package.php">RELOCATING TO TAMPA BAY</a></li>

				</ul>

		  </div>

			

			<div class="text-center footer2links"> 

				<ul>

					 <li><a href="/testimonials.php">Testimonials</a></li>

					 <li><a href="/listing-your-home-for-sale.php">Listing Your Home For Sale</a></li>

					 <li><a href="/mortgage-calculator.php">Mortgage Calculator</a></li>

					 <li><a href="/preconstruction.php">Preconstruction</a></li>

				</ul>

			</div>



			<div class="text-center footer2links"> 

				<ul>

					 <li><a href="/foreclosure.php">Foreclosure Homes</a></li>

					 <li><a href="/listing-notification.php">Free MLS Listing Notifier</a></li>

					 <li><a href="/international-buyers.php">International Buyers</a></li>

				</ul>

			</div>

			

			<div class="text-center footer2info"> 

				<ul>

					 <li><a href="#">(813) 402-1324</a></li>

					 <li><a href="/contact.php">Contact Us</a></li>

					 <li><a href="https://plus.google.com/+Tamparealestatelink">Bahia International Realty</a></li>

				</ul>

			</div>

			

			<div class="text-center footer2info"> 

				<ul>

					 <li><a>&copy; Copyright <?=date("Y",time())?>. Bahia International Realty. All Rights Reserved.</a></li>

					 <li><a href="/privacy.php">Privacy Policy</a>/<a href="/terms.php">Terms of Use</a></li>

				</ul>

			</div>

			

		</div>

	</div>				

</div>                    





<script>


if(!normalSelect)

{

	function checkjQueryFooter(){
		if(window.jQuery){
			console.log('jQuery footer loaded');
			callbackjQueryFooter();
			return true;
		}

		setTimeout(function(){
			checkjQueryFooter();
		}, 100);
		return false;
	}

	checkjQueryFooter();

	function callbackjQueryFooter(){
		if(jQuery.fn.selectBox){
			jQuery('select').selectBox({

				mobile:true,

				menuSpeed:'normal',

				menuTransition:'slide'

				});
			}
		}
}

</script>









</body>

</html>