window.onload = function(){

	populate();
	//something.style.cursor = 'pointer';

	//window.setInterval(checkAgain, 5000);

}

function populate(){

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
      var table = document.getElementById('tableForOutput');
      var responseText = xmlhttp.responseText;
      if(responseText != ""){
      	responseText = JSON.parse(xmlhttp.responseText);

				for(x in responseText){
					var row=table.insertRow(-1);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);


					cell1.innerHTML=responseText[x]['name'];
					cell2.innerHTML=responseText[x]['job'];
					cell3.innerHTML=responseText[x]['status'];
				}  

				
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
  xmlhttp.open("GET","page3process.php",true);
  xmlhttp.send();
}
