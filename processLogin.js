var request;
var toggle = 0;
$("form").on("submit" , function(event) {

  /* stop form from submitting normally */
  event.preventDefault();

  /* get some values from elements on the page: */
   var values = $(this).serialize();

  /* Send the data using post and put the results in a div */
   request = $.ajax({
      url: "processLogin.php",
      type: "post",
      data: values,
      success: function(response){
					
					var obj = JSON.parse(response);
					
					if(obj.valid == 1){
						window.location = "page1.php";
					}
					else{
						//Change Login in 
						//console.log(response);
					 	if(toggle == 0){
							$('<div class="control-group"><!-- label  --><label class="control-label">Incorrect Username/Password</label></div>').insertBefore('#labelDiv');	
							$("#encassedDiv").attr('class', 'control-group error');
							toggle = 1;
						}
					}
      },
      error:function(){
          //$("#result").html('there is error while submit');
      }   
    });

   
});
