<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        // $cont_subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            $text= "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "sac@ieee.org";

        // Set the email subject.
        $subject = "Message from from $name about SSC'19";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        // $email_content .= "Subject: $cont_subject\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            $text= "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            $text= "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        $text= "There was a problem with your submission, please try again.";
    }

?>


  <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta meta name="viewport" content="width=device-width, user-scalable=no"/>

<title>CONTACT - SSC'19</title>
<link rel="shortcut icon" href="favicon.ico"/>

   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/fitodac/line-awesome/master/dist/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bsnav.min.css">
    <link rel="stylesheet" type="text/css" href="examples.min.css">
 <link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="css/loader.css">
<link rel="stylesheet" href="css/counter.css">

 <style>
body, html {
  height: 100%;
  
}
      .jumbotron{
      	background: url('https://picsum.photos/1400/700?random');
      	color: #fff;
      	height: 600px;
      	display: flex;
      	align-items: center;
      }
.bg {
  /* The image used */
  background: linear-gradient(  rgba(56, 56, 55, 0.7), rgba(0, 0, 0, 0) ), url("css/cover.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  filter: graysale(100%);
  border-bottom: 2px solid #001263;
  color: #fff;
   height: 600px;
   display: flex;
   align-items: center;

  
}
#about {
padding-top:20%;
}
a.link, a.link:hover, a.link:active, a.link:visited{ 
background-color:#fff;
display: block;
margin-top:20px;
border-align:center;
padding:10px; 
border-radius:5px;
text-align: center; 
text-decoration: none;
}

ul.b {
list-style-position: inside;
padding-left:20px;
}

 @media (max-width: 991px) {	
.bg { height: 25%; }
.ssc {
font-size:50px;
}
#about {
padding-top:9%;
}
ul.b {
list-style-position: inside;
padding-left:30px;
}
}

@media (max-width: 640px) {	
.bg { height: 50%; }
.ssc {
font-size:45px;

}
#about {
padding-top:20%;
}
ul.b {
list-style-position: inside;
padding-left:20px;
}
}

.fields {
height:50px;
width:362px;
border:1.5px solid #001263;

border-radius:3px;
font-size:20px;
padding:20px;
color:#333;
pointer: none;
}
article {
  -webkit-columns: 2 200px;
  -moz-columns: 2 200px;
  columns: 2 200px;

}
 @media (max-width: 991px) {	
article {
width:610px;
}

}
 @media (max-width: 640px) {	
article {
width:100%;
}
}
input:focus {
box-shadow: 0 0 15px #001263;
}
textarea {
height:200px;
width:362px;
border:1.5px solid #64dd17;

border-radius:3px;
font-size:20px;
padding:15px;
color:#333;
pointer: none;
}
textarea:focus {
box-shadow: 0 0 15px #001263;
}
label {
margin-left:10px;
font-family: sans-serif;
}
.submit {
color:#fff;
background:#001263;
height:40px;
width:100px;
border-radius:20px;
border: transparent;
font-size:16px;
margin:5px;
}
div a {
text-decoration:none;
color:#64dd17;
}
div a:hover {
text-decoration:none;

}
.fa-facebook {
    padding:10px 15px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;   
    font-size:22px;
    border:1px solid transparent;
}

.fa-facebook:hover {
    background-color: #001263;
    border-radius: 50%;
border:1px solid #64dd17;
box-shadow:0 0 10px #001263
}
.fa-instagram {
padding:10px 12px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
   font-size:22px;
border:1px solid transparent;

}
.fa-instagram:hover {
    background-color: #eb8231;
    border-radius: 50%;
border:1px solid #001263;
box-shadow:0 0 10px #001263
}
.fa-envelope {
padding:10px 10px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
   font-size:22px;
border:1px solid transparent;
}
.fa-envelope:hover {
    background-color: #ff4444;
    border-radius: 50%;
border:1px solid #001263;
box-shadow:0 0 10px #001263
}

    </style>

</head>
<body>


<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div>
   <div class="loader-section section-right"></div></div>


  <div class="navbar navbar-expand-sm bsnav bsnav-sticky bsnav-sticky-slide"><a class="navbar-brand" href="index.html">ieee hyd section</a>
      <button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse justify-content-sm-end">
         <ul class="navbar-nav navbar-mobile mr-0">
<li class="nav-item"><a class="nav-link" href="index.html">HOME</a></li>
    <li class="nav-item dropdown"><a class="nav-link" href="JavaScript:void(0);">ABOUT US <i class="caret"></i></a>
            <ul class="navbar-nav">
 <li class="nav-item"><a class="nav-link" href="about.html">ABOUT SSC'19</a></li>
              <li class="nav-item"><a class="nav-link" href="ourteam.html">OUR TEAM</a></li>
              <li class="nav-item"><a class="nav-link" href="CodeOfConduct.html">CODE OF CONDUCT</a></li>
</ul></li>
<li class="nav-item"><a class="nav-link" href="schedule.html">SCHEDULE</a></li>
<li class="nav-item"><a class="nav-link" href="sbawards.html">SBAWARDS</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.html">OUR GALLERY</a></li>
<li class="nav-item"><a class="nav-link" href="sponsors.html">SPONSORSHIP</a></li>
          <li class="nav-item"><a class="nav-link" href="register.html">REGISTER</a></li>
          <li class="nav-item active"><a class="nav-link" href="">CONTACT</a></li>
</ul>
      </div>
    </div>


    <div class="bg">
      <div class="container">
        <p style="text-align:center;font-size:50px;font-weight:400;">CONTACT US</p>

      </div>

    </div>
    <div id="about" style="">

 <div class="container">
<p style="font-size:30px;font-family: sans-serif;text-align:center; margin-bottom:50px; color:#5d5d5d;">CONTACT US</p>
<article>
<div style="margin-left:10px; font-family: sans-serif; text-size-adjust:none;">
<p style="font-weight:500; font-size:20px;">Dr. Y.VIJAYALATHA REDDY</p>
<span>Chair, SAC, IEEE Hyderabad</span><br>
<span><a href="tel:+919949852992">+91-9949852992</a></span><br>
<span><a href="mailto:vijaya@ieeehydssc.org">vijaya@ieeehydssc.org</a></span><br><br>

<p style="font-weight:500; font-size:20px;">CHAITANYA KURUGANTY</p>
<span>SSR, IEEE Hyderabad</span><br>
<span><a href="tel:+919700335101" >+91-9700335101</a></span><br>
<span><a href="mailto:chaitanya@ieee.org">chaitanya@ieee.org</a></span><br><br>

<p style="font-weight:500; font-size:20px;">G. RAJESH KUMAR</p>
<span>Joint SSR, IEEE Hyderabad</span><br>
<span><a href="tel:+917095400260" >+91-7095400260</a></span><br>
<span><a href="mailto:rajeshkumar@ieee.org">rajeshkumar@ieee.org</a></span><br><br>

<p style="font-weight:500; font-size:20px;">NARENDRA RAMYA</p>
<span>SCT, IEEE India Council</span><br>
<span><a href="tel:+919849440155">+91-9849440155</a></span><br>
<span><a href="mailto:narendraramya@ieee.org">narendraramya@ieee.org</a></span><br><br>



</div><br><br>

<div style="margin-top:50px;">
<p style="color:red; text-align:center;"><?php echo $text; ?></p>
<form action="mailer.php" method="post">
<left><label style="text-align:left;">Full Name <span style="color:red;">*</span></label></left><br>
<input class="fields" type="text" name="name"><br>

<label>Email <span style="color:red;">*</span></label><br>
<input class="fields" type="email" name="email"><br>

<label>Message <span style="color:red;">*</span></label><br>
<textarea name="message"></textarea><br>

<input type="submit" class="submit" value="SUBMIT">
<input type="reset" class="submit" value="RESET">
</form></center>
</div></article><br>
<hr style="background:#64dd17;">
<div style="margin-top:50px;">

<center>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15221.19269251784!2d78.38270916977538!3d17.4932742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9186c9216501%3A0x5b92f2e1fd8fc012!2sJawaharlal+Nehru+Technological+University+Hyderabad!5e0!3m2!1sen!2sin!4v1563688475089!5m2!1sen!2sin" width="100%" height="500" frameborder="0" style="border:1.5px solid #64dd17; border-radius:5px;box-shadow: 0 0 10px #64dd17;" allowfullscreen></iframe>
 <br>
<p style="font-size:25px;font-family: sans-serif;margin:10px;">JAWAHARLAL NEHRU TECHNOLOGICAL UNIVERSITY<br><span style="margin:50px; font-size:18px; font-weight:300;">Kukatpally, Hyderabad</span></p>
</center>
</div>
 </div>
    </div>


    <div class="bsnav-mobile">
      <div class="bsnav-mobile-overlay"></div>
      <div class="navbar"></div>
    </div>

<footer class="footer-basic-centered">
<div>	<p class="footer-company-motto">
&nbsp IEEE Hyderabad Section is one of the most active sections of IEEE in India. IEEE was formally introduced in Hyderabad, in June 1981, when a group of engineers in Hyderabad decided to form an IEEE sub-Section here. This sub-Section was rapidly elevated to a full Section, in 1984 (the year of IEEE Centenary celebrations)</p>
</div>
<hr style="background:grey;" align="center">
<div>		<p class="footer-links"><!--
<a href="mailto:info@ieeehydssc.org">info@ieeehydssc.org |</a>    
<a href="http://www.ieeehydssc.org/home.html">Home</a> |
<a href="http://www.ieeehydssc.org/register.html">Register</a> |
<a href="http://www.ieeehydssc.org/contact.html">Contact</a> |
<a href="http://www.ieeehydssc.org/privacy-policy.html">Privacy Policy</a> |
<a href="http://www.ieeehydssc.org//sitemap.xml">Sitemap</a> -->
<a href="https://www.facebook.com/IEEEHYDSSC/" target="blank"><i class="fa fa-facebook"></i></a> 
<a href="https://www.instagram.com/section_student_congress_2019/" target="_blank"><i class="fa fa-instagram"></i></a> 
<a href="mailto:sac@ieee.org"><i class="fa fa-envelope"></i></a> 
</p>
</div>

<div>	<p class="footer-company-name">
© 2019 IT Team of IEEE Hyderabad Section Student Congress 2019 | All Rights Reserved </p>
</div>

		</footer>

  
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://rawgit.com/fitodac/bsnav/master/dist/bsnav.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="js/main.js"></script>
  <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
<!-- Custom js -->
	<script type="text/javascript" src="js/custom.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
</body>
</html>