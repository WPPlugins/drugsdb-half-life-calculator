// Drugsdb Half-Life Calculator Widget
function drugsdbChangeTextShortcode(theresult) { 
document.getElementById('drugsdb-result-shortcode').textContent=theresult;
}
function drugsdbChangeHTMLShortcode(theresult) { 
document.getElementById('drugsdb-result-shortcode').innerHTML=theresult;
}
function drugsdbShowInlineShortcode() {
document.getElementById('drugsdb-result-shortcode').style.display='inline';
}
function drugsdbShowBlockShortcode() {
document.getElementById('drugsdb-result-shortcode').style.display='block';
}
function drugsdbHideShortcode() {
document.getElementById('drugsdb-result-shortcode').style.display='none';
drugsdbChangeTextShortcode( '' );
}
function drugsdbSubmitCustomShortcode() { 
	var theHL = document.getElementById('drugsdb-custom-hl-shortcode').value;
	var doseMgs = document.getElementById('drugsdb-dosage-shortcode').value;
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
				theOutput = theOutput + hoursPassed + ' hours - ' + strMgs + ' / ' + strPercent + "<br />";
			}
			drugsdbChangeHTMLShortcode( theOutput );
			drugsdbShowInlineShortcode();
		}
		else {
			drugsdbChangeTextShortcode( 'enter numbers only' );
			drugsdbShowInlineShortcode();
		}
	}
	else {
		drugsdbChangeTextShortcode( 'can\'t be zero' );
		drugsdbShowInlineShortcode();
	}
}