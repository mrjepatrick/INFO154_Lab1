/*******************************************************************************
   Name   : jep322_INFO154_Lab1a.js
   Purpose: INFO154 - Lab1 - Part a
   Author : Jeremy Patrick
   Date   : July 6, 2013
*******************************************************************************/



/*******************************************************************************
 * Alphabet validation script for Lab1a
 ******************************************************************************/

    function checkAlpha(){
        ////////////////////
        // Validate the keyword
        if ( document.alphaForm.keyword.value === '' ){
            alert('Please make an entry for validation');
            return false;
        } else {
            var alphabet = 'abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var validChar = false;

            for(var x=0; x<(document.alphaForm.keyword.value).length; ++x ){
                for(var y=0; y<(alphabet).length; ++y ){
                    // If, for any value of alphabet, the input value is matched, set validChar to true
                    if(document.alphaForm.keyword.value[x] === alphabet[y]){
                        validChar = true;
                    }
                }
                if(validChar){
                    // validChar means character was found
                    // Reset validChar checker
                    validChar = false;
                } else {
                    // False means not found, so fail out
                    alert('"'+document.alphaForm.keyword.value[x]+'" is not an alphabetic character.');
                    return false;
                }
            }
            alert('"'+document.alphaForm.keyword.value+'" is a valid alphabetic entry.');
            return true;
        }
    }


