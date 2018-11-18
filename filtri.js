function brisiFiltre(){
	var prazno1 = document.getElementById("1--").selected;
	var prazno2 = document.getElementById("2--").selected;
	if(prazno1 == false || prazno2 == false){
		if(prazno1 == false){
			document.getElementById("1--").selected = true;
		}
		else {
			document.getElementById("2--").selected = true;
		}
	}
}