<?php


	
	$t=time();
	$unlockTime = false;
	$errorMes = "Wallet Not Found...";
	$decryptionCode = "Wallet Not Found...";
	$unlockReady = false;
	$wallet = false;
	
	if (isset($_GET['publicKey']) && $_GET['accessCode']) {

		$wallet = $_GET['publicKey'];
		$accessCode = $_GET['accessCode'];

		//GET DB CONNECTION
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');

		$stmt = $my_Db_Connection->prepare("SELECT * FROM users WHERE wallet = :wallet AND accessCode = :accessCode");
		$stmt->bindParam(':wallet', $wallet);
		$stmt->bindParam(':accessCode', $accessCode);
		$stmt->execute();
		
		while ($row = $stmt->fetch()) {
			$decryptionCode = $row['decryptionCode'];
			$unlockTime = $row['unlockTime'];
		}
		/*$stmt2 = $my_Db_Connection->prepare("UPDATE users SET signature = :signature WHERE ( wallet = :wallet )");
		$stmt2->bindParam(':wallet', $wallet);
		$stmt2->bindParam(':tokenStr', $token);	
		$stmt2->execute();
		//$stmt2 = $my_Db_Connection->prepare("UPDATE users SET tkn = ore + 1 WHERE ( wallet = :wallet )");	*/
		$my_Db_Connection = NULL;
		
		if ($unlockTime <= $t){
			$unlockReady = true;
		}
		//echo $wallet . " added to DB or is already in DB and set token t0 " . $signature;
		
		
		/*
		
		$stmt = $my_Db_Connection->prepare("SELECT * FROM users WHERE wallet = :wallet AND tkn = :token"); 
		$stmt->bindParam(':wallet', $walletAddress);
		$stmt->bindParam(':token', $userToken);
		$stmt->execute();
		$returnThis = NULL;
		$ore = "0";
		
		while ($row = $stmt->fetch()) {
			$ore = $row['ore'];
		}
		
		*/
	}
	else{
		die('Hep me! I ded!');
	}

?>
<head>
	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;800&display=swap" rel="stylesheet">
	<title>CHECK Forced HODL Wallet Generator</title>
	
	
	<!-- Web3JS -->
	<script type="text/javascript" src="/dist/web3.min.js"></script>

	
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/js.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php'); ?>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/header.php'); ?>
	<div id='content'>
		<h1 id='pageHeading'>My Forced HODL Wallet</h1>
		<div id='walletDetails'>
			
				<?php
					if ($unlockReady){
						require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/unlock-ready.php');
					}
					else if ($unlockTime){
						echo "<p class='para'>Your wallet is " . $wallet . "<br/>It will not be ready to unlock until " . gmdate("l jS \of F Y h:i:s A", $unlockTime . "</p>");
					}
					else{
						echo $errorMes;
					}
				?> 
		
	</div>
</body>
<footer>

</footer>