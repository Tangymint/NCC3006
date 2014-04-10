/*	Author: Rohit Menon
	Matric No. U1222512H
	Lab group: SSP3
*/

// JS function to check the value of name input.
function validateName() {
	
	// Get the target node of the event
    var init = document.getElementById("custName");
    console.log("init  = "  + init);
    var name = init.value;
    if(name == "" || (name.match(/^\s*$/))) {
    	alert("You did not enter a name \n Name field cannot be left empty");
    	init.focus();
    	return false;
    }
    else
    	return true;		    
}

// JS function to check the value of inputs.

function validateInput () {
	var apples = document.getElementById("apples").value;
	var oranges = document.getElementById("oranges").value;
	var bananas = document.getElementById("bananas").value;
		
	if (isNaN(apples) || (apples == "") || (apples == null) ){
		alert("The quantity for apples is invalid");
		document.getElementById("apples").focus();
		document.getElementById("cost").value = 'NaN';
		return false;
	}
	

	if (isNaN(oranges) || (oranges == "") || (oranges == null) ){
		alert("The quantity for oranges is invalid");
		document.getElementById("oranges").focus();
		document.getElementById("cost").value = 'NaN';
		return false;
	}

	if (isNaN(bananas) || (bananas == "") || (bananas == null) ){
		alert("The quantity for bananas is invalid");
		document.getElementById("bananas").focus();
		document.getElementById("cost").value = 'NaN';
		return false;
	}

	// Compute the cost to two decimal places
	else {
		document.getElementById("cost").value = totalCost = ((apples * 0.69) + 
															(oranges * 0.59) + 
															(bananas * 0.39)).toFixed(2);
		return true;
	}
}

// JS function to check for payment
function validatePayment () {

	var payment = "";

	if (document.getElementById("visa").checked) {
		payment = "visa";
		return true;
	}
	else if (document.getElementById("mastercard").checked) {
		payment = "Master Card";
		return true;
	}
	else if (document.getElementById("discover").checked) {
		payment = "Discover";
		return true;
	}

	else {
		alert("Error! Enter a valid payment option");
		document.getElementById("visa").focus();
		return false;
	}
}