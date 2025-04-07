<?php #add p and change the name of doc to index.php
session_start();
include_once 'dbconnect.php';
?>

<html>
<head>
	<title>quantum.pj main page</title>
	<style>
	    button{
	        display: block;
	        margin: 0 auto;
	    }
	</style>
</head>

<style> 
div.main {
  width:100%;
  overflow:auto;
}
div.main div {
  width:33%;  
  float:left;
}
</style>

<body>
    <div class="main">
        <div style="font-size:1.2vw;">
            <p style="color: purple;">QUANTUM.PJ</p>
				<?php if (isset($_SESSION['usr_id'])) { ?>
        </div>
        <div>
            <p></p>
        </div>
        <div style="text-align: right">
            <p>Signed in as <?php echo $_SESSION['usr_name']; ?></p>
			<p>	<a href="logout.php">Log Out</a> </p>
				<?php } else { ?>
				<a href="login.php">Login</a>
				<a href="register.php">Sign Up</a>
				<?php } ?>
        </div>
    </div>
    
	<hr><br><br>
		<h3 style="text-align: center;">ABOUT US</h3>
		
    <div class="main" style="color: white;">
        <div style="background-color: #A468D5; text-align: center;">
            <h1>50+ teams</h1>
			<h4>participated at our first online hackathon</h4>
        </div>
        <div style="background-color: #9240D5; text-align: center;">
            <h1>150.000+ KZT</h1>
            <h4>generated in revenue for charity by organizing different events</h4>
        </div>
        <div style="background-color: #A468D5; text-align: center;">
            <h1>200+ subscribers</h1>
            <h4>in our instagram account and 100+ in our telegramm</h4>
        </div>
    </div>	
    
    <br><br><br><br><hr><br><br>
    <h1>about the hackathon:</h1>
    <p>it is charitable online event that covers all people from all over the world to address the current problems by inventing digital solutions</p>
    <a href="output.php">REGISTER YOUR TEAM TO HACKATHON</a>
    
    
    <br><br><br><br><hr><br><br>
    <h1>our founder:</h1>
    <div class="main" style="background-color: #3F046F;">
        <div>
            <img src="IMG_9823.JPG" alt="picture of founder, whose name is Altair" style="width:300px;height:200px;"></img>
        </div>
        <div style="color: white">
            <h2 style="text-align: center;">Altair Murat</h2>
            <p>we just wanted to create something different about physics</p>
        </div>
        <div>
            
        </div>
    </div>
    
    <button onclick="window.location.href='teampage.php';" style="font-size: 1.2vw;">more about our team</button>

    <h1 style="color: white; text-align: center;" id="purplee">Wish u good day!!</h1>
    <button type="button"
    onclick="document.getElementById('purplee').style.color='purple'">
    do you know what?</button>
</body>
</html>

