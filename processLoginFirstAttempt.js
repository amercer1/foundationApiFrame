function processLogin(){
	console.log("Testing");

	var login = document.getElementById("login");
	var loginInput = login.value;
	console.log("LoginInput is " + loginInput);

	var password = document.getElementById("inputPassword");

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
			for(var x=0;x< 10000000000000;x++); 
			console.log("LINE 38");
      if(responseText != ""){
      	responseText = JSON.parse(xmlhttp.responseText);
				console.log(responseText);

				//window.location = "page1.php"
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
			else{
				console.log("LINE 64");
			}

    }
		else{
			console.log("FAIL FAIL FAIL FAIL FAIL FAIL");

		}
  }
  var query = "?login=" + loginInput + "&password=" + passwordInput;
  console.log(query);
  xmlhttp.open("POST","processLogin.php" + query,true);

  xmlhttp.send();
}

