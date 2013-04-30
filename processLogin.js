function processLogin(){

	var login = document.getElementById("inputLogin");
	var loginInput = login.value;

	var password = document.getElementBy("inputPassword");

	var passwordInput = password.value;

  var xmlhttp;  // The variable that makes Ajax possible!

  try{
    // Opera 8.0+, Firefox, Safari
    xmlhttp = new XMLHttpRequest();
  } catch (e){
    // Internet Explorer Browsers
    try{
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
      }
    }
  }
  // Create a function that will receive data sent from the server
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4){
      var retultDiv = document.getElementById('resultDiv');
      var responseText = xmlhttp.responseText;
      console.log("WHAT WE GOT: " + responseText);
      if(responseText != ""){
      	responseText = JSON.parse(xmlhttp.responseText);

/*
	if(searchValue == ""){
	resultDiv.innerHTML = "";
				}
				else{
					var newline = "";
      		var numberOfReturnedResults= 0;
					for(x in responseText){
						newline = newline + "<div class=searchResult onclick=clickedDiv(\""+ responseText[x] +"\")>" + responseText[x] + "<br /></div>";
						numberOfReturnedResults++;
					}
					if(numberOfReturnedResults >0){
       			resultDiv.innerHTML =  newline;
					}
					else{
  					resultDiv.innerHTML = "";
					}
      	}

*/
      }

    }
  }
  var query = "?login=" + loginInput + "&password=" + passwordInput;
  xmlhttp.open("GET","getterms.php" + query,true);
  xmlhttp.send();
}

