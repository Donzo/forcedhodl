<head>
	<title>Forced HODL</title>
	
	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;800&display=swap" rel="stylesheet">
	
	<!-- Web3JS -->
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/js.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/wallet-connect.php'); ?>
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/generate-access-code.php'); ?>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/header.php'); ?>
	<div id='content'>
	
		<h1>Welcome to Forced HODL!</h1>
		<p class='para'>
			This is the hackathon project that lets you <strong>create timelocked Ethereum wallets</strong>. This website will provide you with a keystore file that contains the private key to an Ethereum wallet. <strong>The key to decrypt</strong> this keystore will only be <strong>revealed to users who have the access code after the preset time has elapsed.</strong> Whoa!
		</p>
		
		<h2>Select HODL Time</h2>
		<p class='para'>
			Choose an amount of time you would like to wait for the encryption key for this wallet to be revealed:
		</p> 
		<div id='timeSliderDiv'>
			<div id='tsdHeading'>
				<div id="timeSelectedDiv">
					LOCK WALLET FOR  &nbsp;<span id="timeSelectedDisp">100 </span> &nbsp; <span id='tUnitLabelDisp'> DAYS </span>
				</div>
			</div>
			<div id="timeUnits">
				1 DAY <input type="range" min="1" max="365" value="100" class="slider" id="time" onchange="updateTime()"> 365 DAYS
			</div>
			<div id="tuSelector">
				<input type="radio" id="minutes" class="tUnitButton" name="tUnitSel" value="minutes" onchange="setSliderUnits(this.id)" >
				<label for="minutes" class="tUnit">Minutes</label><br>
				
				<input type="radio" id="days" class="tUnitButton" name="tUnitSel" value="days" onchange="setSliderUnits(this.id)" checked>
				<label for="days" class="tUnit">Days</label><br>
	
				<input type="radio" id="weeks" class="tUnitButton"  name="tUnitSel" value="weeks" onchange="setSliderUnits(this.id)">
				<label for="weeks" class="tUnit">Weeks</label><br>
	
				<input type="radio" id="months" class="tUnitButton" name="tUnitSel" value="months" onchange="setSliderUnits(this.id)">
				<label for="months" class="tUnit">Months</label>
	
				<input type="radio" id="years" class="tUnitButton" name="tUnitSel" value="years" onchange="setSliderUnits(this.id)">
				<label for="years" class="tUnit">Years</label>
			</div>
		</div>
		<div id="tosDiv">
			<input type="checkbox" id="tos" name="tos" value="agree">
			<label for="tos">I understand that this is a hackathon project, for use on testnets, and I will NOT put real money or value into this project.</label><br>
		</div>
		<div id='go-button'>
			<button class='button' id='generate-wallet' onclick = "generateWallet()" >Generate Wallet</button>
		</div>
		<h2>Unlock a Wallet</h2>
		<div id='unlockWallet'>
			<p class='para'>
				You can unlock your existing ForcedHODL wallet here.
				Enter your public key and access code.
				<div id='walletCheckDiv'>
					<label for="pKey">Public Key:</label>
					<input type="text" id="pKeyCheck" name="pKeyCheck">
					<label for="accessCode">Access Code:</label>
					<input type="text" id="accessCodeCheck" name="accessCodeCheck">
				</div>
				<button class='button' id='check-wallet' onclick = "checkWallet()" >Check Wallet</button>
				
			</p>
		</div>
		<h2>Mint an NFT</h2>
		<div id='buyNFT'>
			<p class='para'>
				MINT a ForcedHODL NFT and send it to a wallet.<br/>
				<label for="mintAddress">Address to Mint:</label>
				<input type="text" id="mintAddress" name="mintAddress">
			</p>
			<button class='button' id='mint-NFT' onclick = "mintNFT()" >Mint NFT</button>
		</div>
	</div>
</body>
<footer>
	<input type="hidden" id="myAccessCode" name="myAccessCode" value="<?php echo generateRandomString(); ?>">
</footer>