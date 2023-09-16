<script>
	var unlockTime = 60*60*24*1;
	var dataStr = null;
	
	function setSliderUnits(e){
		var slider = document.getElementById("timeUnits");
		var tulbldisp = document.getElementById("tUnitLabelDisp");
		
		var minutesT = "<div id='timeUnits'>1 MINUTE &nbsp;<input type='range' min='1' max='10' value='5' class='slider' id='time' onchange='updateTime()'> &nbsp; 10 MINUTES</div>";
		var daysT = "<div id='timeUnits'>1 DAY &nbsp; <input type='range' min='1' max='365' value=183' class='slider' id='time' onchange='updateTime()'> &nbsp; 365 DAYS</div>";
		var weeksT = "<div id='timeUnits'>1 WEEK &nbsp; <input type='range' min='1' max='100' value='50' class='slider' id='time' onchange='updateTime()'> &nbsp; 100 WEEKS</div>";
		var monthsT =  "<div id='timeUnits'>1 MONTH &nbsp; <input type='range' min='1' max='36' value='6' class='slider' id='time' onchange='updateTime()'> &nbsp; 36 MONTHS</div>";
		var yearsT =  "<div id='timeUnits'>1 YEAR &nbsp; <input type='range' min='1' max='18' value='9' class='slider' id='time' onchange='updateTime()'> &nbsp; 18 YEARS</div>";
		
		if (e == "days"){
			console.log('1');
			slider.innerHTML = daysT;
			tulbldisp.innerHTML = "Days";
			
		}
		else if (e == "weeks"){
		console.log('2')
			slider.innerHTML = weeksT;
			tulbldisp.innerHTML = "Weeks";
		}
		else if (e == "months"){
			slider.innerHTML = monthsT;
			tulbldisp.innerHTML = "Months";
		}
		else if (e == "years"){
			slider.innerHTML = yearsT;
			tulbldisp.innerHTML = "Years";
		}
		else if (e == "minutes"){
			slider.innerHTML = minutesT;
			tulbldisp.innerHTML = "Minutes";
		}
		
		updateTime(e);
		
		
	}
	function updateTime(e){
		var tsd = document.getElementById("timeSelectedDisp");
		tsd.innerHTML = document.getElementById("time").value;
		
		if (!e){
			e = document.querySelector('input[name="tUnitSel"]:checked').value;
		}
		
		if (e == "days"){
			unlockTime = 60*60*24* document.getElementById("time").value;
			console.log('days ' +  document.getElementById("time").value + ' and unlock time = ' + unlockTime);
		}
		else if (e == "weeks"){
			unlockTime = 60*60*24*7*document.getElementById("time").value;
			console.log('weeks ' +  document.getElementById("time").value + ' and unlock time = ' + unlockTime);
		}
		else if (e == "months"){
			unlockTime = 60*60*24*30.437*document.getElementById("time").value;
			console.log('months ' +  document.getElementById("time").value + ' and unlock time = ' + unlockTime);
		}
		else if (e == "years"){
			unlockTime = 60*60*24*365.25*document.getElementById("time").value;
			console.log('years ' +  document.getElementById("time").value + ' and unlock time = ' + unlockTime);
		}
		else if (e == "minutes"){
			unlockTime = 60 * document.getElementById("time").value;
			console.log('minutes ' +  document.getElementById("time").value + ' and unlock time = ' + unlockTime);
		}
		
		
		
	}
	async function generateWallet(wallet) {
		var myAccessCode = document.getElementById("myAccessCode").value;
		
		if (document.getElementById('tos').checked) {
			window.location.href = 'https://forcedhodl.com/wallet-generator?unlockTime=' + unlockTime + '&accessCode=' + myAccessCode;
		} 
        else {
			alert("You must agree to the TOS to use this application.");
		}
		
		/*
		fetch('/code/php/signin.php?wallet=' + wallet + "&signature=" + signature)
		.then(response => response.text())
   		.then((response) => {
       		console.log(response);
       		if (response.trim() == "Signer Match!"){
       			gameLoad();
       		}
       		else{
       			alert(response);
       		}
		})*/
	}
	function checkWallet(){
		var accessCodeCheck = document.getElementById("accessCodeCheck").value;
		var pKeyCheck = document.getElementById("pKeyCheck").value;
		
		window.location.href = 'https://forcedhodl.com/check-wallet?publicKey=' + pKeyCheck + '&accessCode=' + accessCodeCheck;
	}
	var myKeyStore = null;
	var qrOfKeyStore = null;
	
	function createKeyStore(){
		var pWord = "<?php echo $decryptionCode;?>";
		var pk = document.getElementById('pk').value
		//Create Web3 Object
		let web3 = new Web3(Web3.givenProvider);
		var JsonWallet = web3.eth.accounts.encrypt(pk, pWord);
		myKeyStore = JsonWallet;
		console.log(myKeyStore);
		dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(myKeyStore));
		qrOfKeyStore = JSON.stringify(myKeyStore);
		document.getElementById('keystoreTxt').innerHTML = qrOfKeyStore;
		pk.value = "";
	}
	
	function downloadFile(){
		var dlAnchorElem = document.getElementById('downloadAnchorElem');
		dlAnchorElem.setAttribute("href",     dataStr     );
		dlAnchorElem.setAttribute("download", "eth-wallet-keystore.json");
		dlAnchorElem.click();
	}
	function printIt(){
		document.getElementById('pageHeading').innerHTML = "My Paper Wallet";
		window.print();
	}
	function mintNFT(){
		connectMyWallet();
	}
</script>