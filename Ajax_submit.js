/////////////////////////////////// registration ajax submit function /////////////////////////////////////////////////////////////
$("#registration_form").submit(function(e){
                
                var postdata = $(this).serializeArray();
                $('#img').show();
                $('#registration_form').hide();
                $('#nonresponse').show();
                document.getElementById("regtitle").innerHTML = "正在努力注册，请稍后";
                $.ajax({
                    
                    url: 'ajax_process.php',
                    data:postdata,
                    type:"POST",
                    success:function (data){
                    
                    if(data == 1){
                        
                        $('#img').hide();
                        $('#succecced').show();
                        $('#register_form').hide();
                    }
                    
                    else{
                        
                        $('#img').hide();
                        $('#failed').show();
                        $('#register_form').hide();                        
                    }
         
                 
                    }
                    
                    
                });
                
                    e.preventDefault(); //STOP default action
                    e.unbind();
            });


////////////////////////////////// login ajax submit function /////////////////////////////////////////////////////////////////////
$("#loginbutton").submit(function(e){
                //e.preventDefault(); //STOP default action
                var postdata = $(this).serializeArray();
                //$('#img').show();
    
                var myemail = $('#loginEmail').val();  
                var mypassword = $('#loginPassword').val();
    
                $.ajax({
                    
                    url: 'ajax_process.php',
                    data:postdata,
                    type:"POST",
                    success:function (feedback){
                    
                 
                    
                    }
                });
                
                    //e.preventDefault(); //STOP default action
                    e.preventDefault();
                    //e.stopPropagation();
                    e.unbind();
  
            });
//////////////////////////////////////// regis
