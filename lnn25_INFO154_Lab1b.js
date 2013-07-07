/*******************************************************************************
   Name   : Lab1b.js
   Purpose: INFO154 - Lab1 - Part b
   Author : Le Nguyen
   Date   : July 7, 2013
*******************************************************************************/



/*******************************************************************************
 * Numeric validation script for Lab1b
 ******************************************************************************/

function checkB() {
    ////////////////////
    // Validate the number
  if (document.bForm.number.value === '') {
        alert('Please make an entry for validation');
        return false;
    } else {
		var originalString = document.bForm.number.value;
	/////////////////////
	// first test, check if its a number or not ( without comma)
			if (isNaN(originalString) == false )
				{
					alert (originalString +' is a number');
					return false;
				}
	/////////////////////
	// 2nd test, with comma, a string with comma immediately 
	// fail the test if it contain non numeric char
			else {
						var lstReplace = originalString.replace(/\,/g,'');	
						if (isNaN(lstReplace) == true )
							{
								alert (originalString+' is not a number');
							}
						else {
	//	before come to next test, we need to remove all the numbers
	//  after "." , also fail the string that contain the 1st "," at 5th or higher
						var shortString = originalString.substring(0, originalString.indexOf("."));
						if (originalString.indexOf(".")  > -1 && originalString.indexOf(".") <originalString.indexOf(",")){
							alert(originalString+' is not a valid number');
							return false;}
						if(originalString.indexOf(",") >=4 ){
							alert(originalString +' is not a valid number');
							return false;}
						
	// 3rd test, reserver all the number, find out if 
	// comma place at 4th,7th,10th... respectively or not
						var flip = "";
						var valid = true;
						for (var i=shortString.length-1; i>=0; i--){
							flip += shortString[i];
							}
							var index = [];
							var list = [4,8,12,16,20,24] //can be a loop of i=4, i< shortString.length, i+4;
							for ( i=0; i< flip.length; i++)
								{
								if (flip[i] === ",") index.push(i+1);
								}
	///////////////////////////////////////////
	///////////////////////////////////////////							
							for (  i=0; i < index.length; i++){
								if (index[i] != list[i]){
									valid = false;
									break;}
								}
		
							if ( valid === false){
								alert (originalString+' is not a valid number');}
							else{
								alert (originalString+' is a valid number');}	
					}
	return false;
}}}
		
		
   
