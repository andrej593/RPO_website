function onloadFunkcija(){
	document.getElementById("stranConsoles").style.display = "none";
	document.getElementById("stranUsers").style.display = "none";
	document.getElementById("stranMyOffers").style.display = "none";
	document.getElementById("stranProfile").style.display = "none";
	document.getElementById("izbranGames").style.backgroundColor = "#616161";
}
			
function prikaziGames(){
	document.getElementById("stranGames").style.display = "block";
	document.getElementById("stranConsoles").style.display = "none";
	document.getElementById("stranUsers").style.display = "none";
	document.getElementById("stranMyOffers").style.display = "none";
	document.getElementById("stranProfile").style.display = "none";
	
	document.getElementById("izbranGames").style.backgroundColor = "#616161";
	document.getElementById("izbranConsoles").style.backgroundColor = "#e00c04";
	document.getElementById("izbranUsers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranMyOffers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranProfile").style.backgroundColor = "#e00c04";
}	
			
function prikaziConsoles(){
	document.getElementById("stranGames").style.display = "none";
	document.getElementById("stranConsoles").style.display = "block";
	document.getElementById("stranUsers").style.display = "none";
	document.getElementById("stranMyOffers").style.display = "none";
	document.getElementById("stranProfile").style.display = "none";
	
	document.getElementById("izbranGames").style.backgroundColor = "#e00c04";
	document.getElementById("izbranConsoles").style.backgroundColor = "#616161";
	document.getElementById("izbranUsers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranMyOffers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranProfile").style.backgroundColor = "#e00c04";
}
			
function prikaziUsers(){
	document.getElementById("stranGames").style.display = "none";
	document.getElementById("stranConsoles").style.display = "none";
	document.getElementById("stranUsers").style.display = "block";
	document.getElementById("stranMyOffers").style.display = "none";
	document.getElementById("stranProfile").style.display = "none";
	
	document.getElementById("izbranGames").style.backgroundColor = "#e00c04";
	document.getElementById("izbranConsoles").style.backgroundColor = "#e00c04";
	document.getElementById("izbranUsers").style.backgroundColor = "#616161";
	document.getElementById("izbranMyOffers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranProfile").style.backgroundColor = "#e00c04";
}
			
function prikaziMyOffers(){
	document.getElementById("stranGames").style.display = "none";
	document.getElementById("stranConsoles").style.display = "none";
	document.getElementById("stranUsers").style.display = "none";
	document.getElementById("stranMyOffers").style.display = "block";
	document.getElementById("stranProfile").style.display = "none";
	
	document.getElementById("izbranGames").style.backgroundColor = "#e00c04";
	document.getElementById("izbranConsoles").style.backgroundColor = "#e00c04";
	document.getElementById("izbranUsers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranMyOffers").style.backgroundColor = "#616161";
	document.getElementById("izbranProfile").style.backgroundColor = "#e00c04";
}
			
function prikaziProfile(){
	document.getElementById("stranGames").style.display = "none";
	document.getElementById("stranConsoles").style.display = "none";
	document.getElementById("stranUsers").style.display = "none";
	document.getElementById("stranMyOffers").style.display = "none";
	document.getElementById("stranProfile").style.display = "block";
	
	document.getElementById("izbranGames").style.backgroundColor = "#e00c04";
	document.getElementById("izbranConsoles").style.backgroundColor = "#e00c04";
	document.getElementById("izbranUsers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranMyOffers").style.backgroundColor = "#e00c04";
	document.getElementById("izbranProfile").style.backgroundColor = "#616161";
}

function brisiFiltre1(){
	var prazno1 = document.getElementById("1g--").selected;
	var prazno2 = document.getElementById("2g--").selected;
	if(prazno1 == false || prazno2 == false){
		if(prazno1 == false){
			document.getElementById("1g--").selected = true;
			document.getElementById("2g--").selected = true;
		}
		else {
			document.getElementById("2g--").selected = true;
		}
	}
}
			
function brisiFiltre2(){
	var prazno1 = document.getElementById("1c--").selected;
	if(prazno1 == false){
		document.getElementById("1c--").selected = true;		
	}
}
			
function brisiFiltre3(){
	var prazno1 = document.getElementById("1u--").selected;
	if(prazno1 == false){
		document.getElementById("1u--").selected = true;
	}
}

