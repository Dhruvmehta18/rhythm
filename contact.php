<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="contact.css">
	<title></title>
	<?php
	session_start();
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
	?>
</head>
<body>
<div class="main">
<div class="container">
<p id="ab"> Talk to a Human<br>
	<span id="cd"><br>You're not going to hit a ridiculously long phone
	    menu <br>when you call us. At choice screening,
	     we provide <br>exceptional service we'd want to 
	    experience ourselves!</span></p>
</div>
<div class="bottom-container">
	<div class="first">
		<i class="material-icons md-18">face </i>
		<p>OUR BRANCHES</p>
		<p>Head Office<br>
			Lanka Industrial Estate,<br>
			Andheri, Mumbai<br><br>
			Northern Division Office<br>
			Automation Drive, Jordan road,
			Delhi<br><br>
			Southern Division Office<br>
			Office no. 4, 15th street,<br>
			Bengaluru.
		</p>
	</div>
	<div class="second">
		<i class="material-icons md-18">phone</i>
		<p>CALL US AT</p>
		<p>Help and Support<br>
			8872613820<br><br>
			Northern Division Office<br>
			9136281100<br><br>
			Southern Division Office<br>
			9136281110
		</p>
	</div>
	<div class="third">
		<i class="material-icons md-18">email
		</i>
		<p>GIVE YOUR FEEDBACK</p>
		<p>Respond for propoal<br>
		info@rhythmgroup.com<br><br>
		Feedback Us at<br>
		feedback@rhythmgroup.com<br><br>
		Employment Opportunities
		careers@rhythmgroup.com
		</p>
	</div>
	<div class="fourth">
		<i class="material-icons md-18">email
		</i>
		<p>FOLLOW US ON</p>
		<p>Twitter: @rhythm_play<br><br>
		Facebook: @rhythm_group<br><br>
		Instagram: @insta_rhythm
		</p>
	</div>
</div>
</div>
</body>
</html>
<?php
  }
  else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
    header('Location: error.html');
} 
?>