function login(evt) {
	evt.preventDefault();

	var data = new FormData($("#loginForm")[0]); 

    $.ajax({
    	type:"POST",
    	url:"controllers/login.php",
      data:data,
      cache:false,
    	contentType: false,
    	processData: false

    }).done(function(res){
        var res = JSON.parse(res);

        if (res.success=="1") {
          // function resultado(){ 
          //   swal({
          //     title: "Success!",
          //     type: "success",
          //     timer: 700,
          //     showConfirmButton: false
          //   }, function(){
          //         window.location.href = "panel.php";
          //   });
          // } 
          window.location.href = "panel.php";
          resultado(res.success);
          
        }else{
            var errors = (res.hasOwnProperty("errors"))? res.errors : null;
            if (errors!= null) {
              $.each(errors, function(i,value){
                $('.'+i).parent().children('span').text(value).show().css({"color":"red","font-size":"13px"});
              });
            }else {
              alert(res.message);
            }
          }


      }).fail(function(a,b,c){
      	alert(c);
      });
        
}