
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronica</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
	<link href="css/contact.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Alata&display=swap" rel="stylesheet">
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<?php
require_once('config/db.php');

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Basic validation
    if (!empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, phone, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $message);
        if ($stmt->execute()) {
            $success = "✅ Thank you for contacting us!";
        } else {
            $error = "❌ Something went wrong. Please try again.";
        }
    } else {
        $error = "⚠️ Email and Message are required.";
    }
}
?>


<body>
	<section id="top">
		<div class="container">
			<div class="row">
				<div class="top_1 clearfix">
					<div class="col-sm-4">
						<div class="top_1l clearfix">
							<p class="mgt col"><i class="fa fa-map-marker col_1"></i>Tortor Sagittis, CA 123456,
								United States</p>
							<p class="col"><i class="fa fa-clock-o col_1"></i> Mon-Fri 09:00 AM - 06:00 PM</p>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="top_1m text-center clearfix">
							<h1 class="mgt"><a href="index.html">Electronica <span>SRS Electrical
										Manufactures</span></a>
							</h1>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="top_1r text-center clearfix">
							<h3 class="mgt"><a href="#"><i class="fa fa-phone col_1"></i> +92 321 1234567 <span>Call
										us now. Technology awaits!</span></a></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="main clearfix">
		<section id="header" class="clearfix">
			<div class="container">
				<div class="row">
					<div class="haeder clearfix">
						<nav class="navbar">
							<div class="navbar-header">
								<button class="navbar-toggle" type="button" data-toggle="collapse"
									data-target=".js-navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="index.html">Electronica</a>
							</div>


							<div class="collapse navbar-collapse js-navbar-collapse">
								<ul class="nav navbar-nav">
									<li><a class="font_tag active_tab" href="index.php">Home</a></li>
									<li><a class="font_tag" href="shop.php">Product</a></li>
									<li><a class="font_tag" href="detail.php">Detail</a></li>
									<li><a class="font_tag" href="blog.php">Blog</a></li>
									<li><a class="font_tag" href="blog_detail.php">Blog Detail</a></li>
									<li><a class="font_tag" href="service.php">Services</a></li>
									<li><a class="font_tag" href="contact.php">Contact Us</a></li>
								</ul>

							</div><!-- /.nav-collapse -->
						</nav>
					</div>
				</div>
			</div>
		</section>


	</div>

	<section id="center" class="clearfix center_contact">
		<div class="container">
			<div class="row">
				<div class="contact_1 clearfix">
					<div class="col-sm-12">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.53925916665!2d-80.29949920266738!3d25.782390733064336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C+FL%2C+USA!5e0!3m2!1sen!2sin!4v1530774403788"
							width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
					</div>
				</div>
				<div class="contact_2 clearfix">
					<div class="col-sm-9">
						<div class="contact_2l clearfix">
							<h6>Home / Contact</h6>
							<h3 class="col_1">CONTACT</h3>
							<p> Have a question, need support, or want to schedule a product testing? Our team is ready
								to help. Whether you're looking for electrical testing solutions, product approvals, or
								system upgrades — we're just one message away.</p>
							<!-- Contact Form Start -->
<form method="POST" action="">
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <h6 class="bold">Your Name</h6>
    <input class="form-control" type="text" name="name">

    <h6 class="bold">Your Phone</h6>
    <input class="form-control" type="text" name="phone">

    <h6 class="bold">Your Email <span class="col_2">*</span></h6>
    <input class="form-control" type="email" name="email" required>

    <h6 class="bold">Your Comment <span class="col_2">*</span></h6>
    <textarea class="form-control form_1" name="message" required></textarea>

    <h5><button type="submit" class="button">SUBMIT CONTACT</button></h5>
</form>
<!-- Contact Form End -->

						</div>
					</div>
					<div class="col-sm-3">
						<div class="contact_2r clearfix">
							<h4 class="col_1">CONTACT INFO</h4>
							<p>We'd love to hear from you - please use the form to send us your message or ideas. Or
								simply pop in for a cup of fresh tea and a cookie:</p>
							<p>
								Tortor Sagittis, CA 123456,
								United States</p>
							<p>Email:  info@srselectrical.com<br>
								Toll-free:  +92 321 1234567</p>
							<hr>
							<p>Opening Hours:<br>
								Monday to Saturday: 9am - 10pm<br>
								Sundays: 10am - 6pm</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="footer">
		<div class="container">
			<div class="row">
				<div class="footer_2 clearfix">
					<div class="col-sm-3">
						<div class="footer_2i clearfix">
							<a class="navbar-brand" href="index.html"> Electronica </a>
							<p class="col">SRS Electrical manufactures quality products like switch gears, fuses,
								capacitors, and resistors. Each item is lab-tested and sent to CPRI for approval before
								market release. Failed products are improved and retested to ensure reliability and
								safety.</p>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="footer_2i1 clearfix">
							<h4 class="mgt col">Departments</h4>
							<hr>
							<ul>
								<li><a class="col" href="#">Product Manufacturing</a></li>
								<li><a class="col" href="#">Quality Assurance</a></li>
								<li><a class="col" href="#">Electrical Testing</a></li>
								<li><a class="col" href="#">Mechanical Testing</a></li>
								<li><a class="col" href="#">Environmental Testing</a></li>
								<li><a class="col" href="#">Re-Manufacturing Unit</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="footer_2i1 clearfix">
							<h4 class="mgt col">Head Office</h4>
							<hr>
							<p class="col">
								SRS Electrical Appliances
								Plot #23, Industrial Zone, Gulberg Tech Park
								Tortor Sagittis, CA 123456,
								United States<br>

								📧 info@srselectrical.com
								<br>
								📞 +92 321 1234567
							</p>

							<p class="col">Mon-Thu: 9:30 – 21:00<br>
								Fri: 6:00 – 21:00<br>
								Sat: 10:00 – 15:00</p>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="footer_2i1 clearfix">
							<h4 class="mgt col">Quick Links</h4>
							<hr>
							<ul>
								<li><a class="col" href="#">Gallery</a></li>
								<li><a class="col" href="#">FAQs</a></li>
								<li><a class="col" href="#">Contacts</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="footer_3 clearfix">
					<div class="col-sm-7">
						<div class="footer_3l clearfix">
							<p class="mgt col">© 2025 Your Website Name. All Rights Reserved | Design by <a class="col"
									href="#">Laiba Sajjad</a></p>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="footer_3r clearfix">
							<ul class="mgt">
								<li><a href="#">Home</a></li>
								<li><a href="#">What we do</a></li>
								<li><a href="#">About</a></li>
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Team</a></li>
								<li><a href="#">News</a></li>
								<li><a href="#">Contacts</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>

</html>