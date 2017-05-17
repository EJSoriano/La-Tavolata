#!/usr/local/php5/bin/php-cgi
<?php require_once('required.php') ?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Contact Us</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="reset.css">
		<link rel="stylesheet" href="layout.css">
		<link rel="stylesheet" href="style/social.css">
	</head>

	<body>
	<?php include 'header.php' ?>
		<main>
 			<div class="contactMain">
 				<h1>La Tavolata</h1>

				<div class="contactBlock">
				<div class="contactText">
					<p>11688 South St #106<br/>Artesia<br />CA 90701<br/>Phone: (562) 924-8000</p>
				</div>
					<br />

					<a href="https://goo.gl/maps/pACCWvYjokM2" target="_blank"><img src="Images/maps.png" alt="maps" class="img-maps" /></a>

					<section id="social">
						<p>Follow us on</p>
						<ul class="soc">
							<li><a title="Yelp" class="soc-yelp" href="https://www.yelp.com/biz/la-tavolata-artesia?utm_campaign=www_business_share_popup&utm_medium=copy_link&utm_source=(direct)" target="_blank"></a></li>
							<li><a title="Facebook" class="soc-facebook" href="https://www.facebook.com/latavolatacafe/" target="_blank"></a></li>
							<li><a title="Foursquare" class="soc-foursquare" href="http://4sq.com/mTrKz6" target="_blank"></a></li>
							<li><a title="Google" class="soc-googleplus" href="https://www.google.com/#q=La+Tavolata&lrd=0x80dd2da125c66959:0xd85a3abea0b35830,1," target="_blank"></a></li>
							<li><a title="Tripadvisor" class="soc-tripadvisor soc-icon-last" href="https://www.tripadvisor.com/Restaurant_Review-g29112-d4557003-Reviews-La_Tavolata-Artesia_California.html" target="_blank"></a></li>
						</ul>
					</section>
				</div>
			</div>
		</main>
		<?php include 'footer.php'; ?>
	</body>
</html>
