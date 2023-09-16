<style type="text/css">
		html,body {
			background-color: #403d39;
			color: #eb5e28;
			font-family: 'Sen', sans-serif;
			margin: 0;
			padding: 0;
			font-size: 14pt;
			word-wrap: break-word;
		}
		img{
			max-width: 100%;
			height: auto;
		}
		#content{
			margin: .5em 2em;
			padding: .5em 2em;
		}
		.para{
			line-height:150%;
			background-color: #252422;
			padding: 2em;
		}
		#timeSelectedDiv{
			text-align: center;
			display:flex;
			justify-content: center;
			font-size: 2em;
		}
		#timeUnits{
			text-align: center;
			display:flex;
			justify-content: center;
			width: 100%;
			margin-top:2em;
		}
		#tuSelector{
			text-align: center;
			display:flex;
			justify-content: center;
		}
		.slider{
			width:60%;
			height: 25px; 
		}
		.tUnit{
			margin-right:2em;
			margin-top:2em;
		}
		.tUnitButton{
			margin-top:2em;
			margin-right:.5em;
		}
  		#tosDiv{
  			background-color:#eb5e28;
  			color:#252422;
  			padding: 2em;
  			margin-top:2em;
  		}
		#privKey{
			background: #C72C27;
			color: #FFE9B5;
			font-size: .8em;
		}
		#keystoreEncyDiv{
			background: #fffcf2;
			color: #252422;
		}
		#pubKey{
			background: #ccc5b9;
			color: #eb5e28;
		}
		.sHeader{
			font-size: 2em;
			margin-bottom: .5em;
		}
		#privKey, #pubKey, #keystore, #keystoreEncyDiv{
			margin: 1em .5em;
			padding: 2em .5em;
		}	
		.button{
  			background-color: #28b5eb;
			border: none;
			color: #fffcf2;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			font-size: 16px;
			margin: 1em;
			font-family: 'Sen', sans-serif;
			border-radius: 25px;
  		}
		input, select, textarea {
			font-family: 'Sen', sans-serif;
			font-size: 100%;
			padding: 1em;
		}
		#access-code{
			background-color: #fffcf2;
			margin-top:1em;
			font-size:1.5em;
		}
		#keystoreTxt{
			margin-top:2em;
		}
		#header-banner{
			height:200px;
			background-color: #ccc5b9;
			display: flex;
			justify-content: center;
		}
		#header-image{

		}
		#header-image img{
			height: 100%;
		}
		#timeSliderDiv{
			margin:1em;
			background-color: #fffcf2;
			color:#28b5eb;
			border-radius: 25px;
			padding:1em 0;
		}
		#tsdHeading{
			color: #eb5e28;
		}
		#walletCheckDiv{
			margin:1em;
			padding:1em;
			background-color:#D8BFD8;
			color:#252422;
		}
		#walletCheckLink{
			margin:1em;
			padding:1em;
			background-color:#D8BFD8;
			color:#252422;
		}
		/* Tall Screen */
		@media only screen 
		  and (min-height: 1200px) { 

		}
		@media print {
			body {
				margin: .1em;
				padding: .1em;
				font: 12pt Georgia, "Times New Roman", Times, serif;
				line-height: 1.3;
				background:#FFFFFF;
				color: #000000;
			}
			#pageHeading{
				display:none;
			}
			#header-banner{
				display: none;
			}
			.sHeader{
				font-size: 1.2em;
			}
			#privKey, #pubKey, #keystore, #keystoreEncyDiv{
				margin: 0;
				margin-bottom: 2em;
				padding: 0;
				background:#FFFFFF;
				color: #000000;
			}
			.button{
				display: none;
			}
			#keystore{
				display: none;
			}
			#keystoreTxt{
				font-size:.7em;
			}
			#access-code{
				font-size:1em;
			}
			#checkLinkDiv{
				display:none;
			}
		}
	</style>