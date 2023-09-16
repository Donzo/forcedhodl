<?php

	require_once "vendor/autoload.php";

	use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
	use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
	use Sop\CryptoEncoding\PEM;
	use kornrunner\Keccak;

	$config = [
	    'private_key_type' => OPENSSL_KEYTYPE_EC,
	    'curve_name' => 'secp256k1'
	];
	
	$res = openssl_pkey_new($config);

	if (!$res) {
	    echo 'ERROR: Fail to generate private key. -> ' . openssl_error_string();
	    exit;
	}

	openssl_pkey_export($res, $priv_key);

	$key_detail = openssl_pkey_get_details($res);
	$pub_key = $key_detail["key"];

	$priv_pem = PEM::fromString($priv_key);

	$ec_priv_key = ECPrivateKey::fromPEM($priv_pem);

	$ec_priv_seq = $ec_priv_key->toASN1();

	$priv_key_hex = bin2hex($ec_priv_seq->at(1)->asOctetString()->string());
	$priv_key_len = strlen($priv_key_hex) / 2;
	$pub_key_hex = bin2hex($ec_priv_seq->at(3)->asTagged()->asExplicit()->asBitString()->string());
	$pub_key_len = strlen($pub_key_hex) / 2;

	$pub_key_hex_2 = substr($pub_key_hex, 2);
	$pub_key_len_2 = strlen($pub_key_hex_2) / 2;

	$hash = Keccak::hash(hex2bin($pub_key_hex_2), 256);

	$wallet_address = '0x' . substr($hash, -40);
	$wallet_private_key = '0x' . $priv_key_hex;
	
	$t=time();
	$unlockTime = $t + $_GET['unlockTime'];
	$decryptionCodeStub = $wallet_address . $accessCode;
	$decryptionCode = hash('sha256', $decryptionCodeStub);
	
	if (isset($_GET['unlockTime']) && $_GET['accessCode']) {
		$wallet = $wallet_address;
		$accessCode = $_GET['accessCode'];

		//GET DB CONNECTION
		require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');

		$stmt = $my_Db_Connection->prepare("INSERT IGNORE INTO users (wallet, accessCode, timeMade, unlockTime, decryptionCode) VALUES(:wallet, :accessCode, :timeMade, :unlockTime, :decryptionCode)");
		$stmt->bindParam(':wallet', $wallet);
		$stmt->bindParam(':accessCode', $accessCode);
		$stmt->bindParam(':timeMade', $t);
		$stmt->bindParam(':unlockTime', $unlockTime);
		$stmt->bindParam(':decryptionCode', $decryptionCode);
		
		$stmt->execute();
		/*$stmt2 = $my_Db_Connection->prepare("UPDATE users SET signature = :signature WHERE ( wallet = :wallet )");
		$stmt2->bindParam(':wallet', $wallet);
		$stmt2->bindParam(':tokenStr', $token);	
		$stmt2->execute();
		//$stmt2 = $my_Db_Connection->prepare("UPDATE users SET tkn = ore + 1 WHERE ( wallet = :wallet )");	*/
		$my_Db_Connection = NULL;
		//echo $wallet . " added to DB or is already in DB and set token t0 " . $signature;
	}
	else{
		die('Hep me! I ded!');
	}
	$checkLink = "https://forcedhodl.com/check-wallet?publicKey=" .$wallet_address . "&accessCode=" . $accessCode;

?>
<head>
	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;800&display=swap" rel="stylesheet">
	<title>Forced HODL Wallet Generator</title>
	
	
	<!-- Web3JS -->
	<script type="text/javascript" src="/dist/web3.min.js"></script>
	<!-- QR JS -->
	<script type="text/javascript" src="/qrcodejs/jquery.min.js"></script>
	<script type="text/javascript" src="/qrcodejs/qrcode.js"></script>
	
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/js.php'); ?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/css/style.php'); ?>

</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/header.php'); ?>
	<div id='content'>
		<h1 id='pageHeading'>My Forced HODL Wallet</h1>
		<div id='walletDetails'>
			<p class='para'>
				TIME: <?php echo gmdate("l jS \of F Y h:i:s A", $t);?><br/>
				UNLOCK TIME:  <?php echo gmdate("l jS \of F Y h:i:s A", $unlockTime);?><br/>
				<span id='access-code'>
					ACCESS CODE:  <?php echo $_GET['accessCode']?><br/>
					YOU MUST HAVE YOUR ACCESS CODE AND PUBLIC KEY TO RETRIEVE YOUR DECRYPTION KEY!!!!!!
				</span>
			</p>
		
			<div id='pubKey'>
				<div class='sHeader'>Public Wallet Address:</div>
					<?php echo $wallet_address; ?>
					<div id="qrPublicAddress" style="width:200px; height:200px; margin-top:15px;"></div>	
				</p>
			</div>
		</div>
	
		<div id='keystoreEncyDiv'>
			<div class='sHeader'>QR Code of Key Store File:</div>
			<div id="qrcode" style="width:200px; height:200px; margin-top:15px;"></div>
			<div id='keystoreTxt'></div>
		</div>
		
		<div id='checkLinkDiv'>
			<h2>Check Maturity or Get Decryption Code Here</h2>
			<div id='walletCheckLink'>
				<a href='<?php echo $checkLink;?>' target='_blank'><?php echo $checkLink; ?></a>;
			</div>
		</div>
		
		<button class='button' onclick="printIt()">Print Wallet</button>
		<button class='button' onclick="downloadFile()">Download Wallet</button>
	</div>
	<a id="downloadAnchorElem" style="display:none"></a>
</body>
<footer>
	<input type="hidden" id="pk" name="pk" value="<?php echo $wallet_private_key; ?>">
	<script>
		createKeyStore();
	</script>
	
	<script type="text/javascript">
		var qrcode = new QRCode(document.getElementById("qrcode"), {
			width : 200,
			height : 200
		});
		

		
		var qrcode2 = new QRCode(document.getElementById("qrPublicAddress"), {
			width : 200,
			height : 200
		});
		
		function makeKeyStoreQR () {	
			qrcode2.makeCode("<?php echo $wallet_address; ?>");
			qrcode.makeCode(qrOfKeyStore);
		}
		makeKeyStoreQR();
	</script>
</footer>