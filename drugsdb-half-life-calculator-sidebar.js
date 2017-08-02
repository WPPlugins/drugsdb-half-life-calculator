// Drugsdb Half-Life Calculator Widget
function drugsdbChangeTextSidebar(theresult) { 
document.getElementById('drugsdb-result').textContent=theresult;
}
function drugsdbChangeHTMLSidebar(theresult) { 
document.getElementById('drugsdb-result').innerHTML=theresult;
}
function drugsdbShowInlineSidebar() {
document.getElementById('drugsdb-result').style.display='inline';
}
function drugsdbShowBlockSidebar() {
document.getElementById('drugsdb-result').style.display='block';
}
function drugsdbHideSidebar() {
document.getElementById('drugsdb-result').style.display='none';
drugsdbChangeTextSidebar( '' );
}
function drugsdbSubmitSidebar() { 
	var theHL = document.getElementById('drugsdb-drug-name').value;
	var hoursPassed = document.getElementById('drugsdb-hours-passed').value;
	var doseMgs = document.getElementById('drugsdb-amount').value;
	if( isNaN(hoursPassed)===false && isNaN(doseMgs)===false) {
		var HLPassed = hoursPassed / theHL;
		var reductFactor = Math.pow( 0.5 , HLPassed );
		var roundResult = Math.round( (doseMgs * reductFactor), 2 );
		var strResult =  roundResult.toString() + ' mg';
		drugsdbChangeSidebar( strResult );
	}
	else {
		drugsdbChangeSidebar( 'enter numbers only' );	
	}
	drugsdbShowInlineSidebar();
}
function drugsdbSubmitCustomSidebar() { 
	var theHL = document.getElementById('drugsdb-custom-hl').value;
	var doseMgs = document.getElementById('drugsdb-dosage').value;
	if( theHL && doseMgs && theHL !== '0' && doseMgs !== '0' ) {
		if( isNaN(theHL)===false && isNaN(doseMgs)===false) {
			var theOutput = "<br /><br />";
			for (i=1;i<8;i=i+1) {
				var hoursPassed = Math.round( theHL * i, 2);
				var reductFactor = Math.pow( 0.5 , i );
				var rawResult = doseMgs * reductFactor;
				var roundResult = Math.round( rawResult );
				var strPercent = Math.round( (rawResult / doseMgs) * 100 ) + '%';
					if(i===6) { strPercent = '1%'; }
					else if(i===7) { strPercent = '0%'; }
				var strMgs =  roundResult.toString() + ' mg';
			}
			drugsdbChangeHTMLSidebar( theOutput );
			drugsdbShowInlineSidebar();
		}
		else {
			drugsdbChangeTextSidebar( 'enter numbers only' );
			drugsdbShowInlineSidebar();
		}
	}
	else {
		drugsdbChangeTextSidebar( 'can\'t be zero' );
		drugsdbShowInlineSidebar();
	}
}