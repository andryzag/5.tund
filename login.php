<?php 
	
	require("../../config.php");
	require("functions.php");
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		
	}
	

	//echo hash("sha512", "b");
	
	
	//GET ja POSTi muutujad
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//echo strlen("äö");
	
	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupGender = "";
	$loginEmail ="";
	$loginEmailError = "";
	$loginPassword = "";
	$loginPasswordError = "";
	
	

	// on üldse olemas selline muutja
	if( isset( $_POST["loginEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["loginEmail"] ) ){
			
			$loginEmailError = "See väli on kohustuslik";
			
		} else {
			
			// email olemas 
			$loginEmail = $_POST["loginEmail"];
			
		}
		
	} 
	
		// on üldse olemas selline muutja
	if( isset( $_POST["loginPassword"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["loginPassword"] ) ){
			
			$loginPasswordError = "See väli on kohustuslik";
			
		} else {
			
			// email olemas 
			$loginPassword = $_POST["loginPassword"];
			
		}
		
	} 
	
		if( isset( $_POST["signupEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
			
			// email olemas 
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "Parool on kohustuslik";
			
		} else {
			
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			
			// kas parooli pikkus on väiksem kui 8 
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
			
			}
			
		}
		
	}
	
	
	// GENDER
	if( isset( $_POST["signupGender"] ) ){
		
		if(!empty( $_POST["signupGender"] ) ){
		
			$signupGender = $_POST["signupGender"];
			
		}
		
	} 
	
	// peab olema email ja parool
	// ühtegi errorit
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		
		// KASUTAN FUNKTSIOONI
		signUp($signupEmail, $password);
		
	
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
	  ) {
		  
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
	}
	
	
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>

<h1 style="color:Red;">Logi sisse</h1>
	<form method="POST">
		<p style="color:red;"><?=$error;?></p>
		
		
		<input name="loginEmail" placeholder="E-post" value="<?=$loginEmail;?>"><?php echo $loginEmailError; ?>
		
		<br><br>
		
		<input type="password" name="loginPassword" placeholder="Parool"><?php echo $loginPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Logi sisse">
	</form>
	
	
	<h1>Loo kasutaja</h1>
	<form method="POST">
		
	
		
		
		<input type="username" name="signupEmail" placeholder="E-Post"> <?php echo $signupEmailError; ?>
		<br>
		
		
		
		<br>
		<input type="password" name="signupPassword" placeholder="Parool"> <?php echo $signupPasswordError; ?>
		<br><br>
		
			<?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Male<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="male"> Male<br>
		<?php } ?>
		
		<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked> Female<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Female<br>
		<?php } ?>
		
		<?php if($signupGender == "other") { ?>
			<input type="radio" name="signupGender" value="other" checked> Other<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="other"> Other<br>
		<?php } ?>
		<br>
		<input type="submit" value="Loo kasutaja">
		
		
		
		
	</form>

</body>
</html>