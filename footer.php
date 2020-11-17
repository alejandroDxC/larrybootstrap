
<p>Design uses <a href="http://concisecss.com/">Concise CSS Framework</a></p>
<p class="">
    <?php // Printthe current date and time...Set the timezone:
          date_default_timezone_set('America/New_York');
          print date('g:i a l F j');
          ob_end_flush(); 
    ?>
</p>
</div>

</body>
<script src="./includes/js/jquery-3.5.1.min.js" ></script>
<script src="./includes/js/application.js" accesskey=""></script>

<script type="text/javascript">
                     
           document.getElementById("exitoRegister").style.display="none";
           
            function  validate(){

//             var afirst = document.register.first.value;
//             if (afirst.length =="" || isNaN(afirst) == false) {
//                 alert('Please Enter A Valid First Name');
//
//                            document.register.first.focus();
//
//                            }
//
//                 var alast = document.register.last.value;
//                 if(alast.length=="" && isNaN(alast) == false){
//
//                            alert('Please Enter A Valid Last Name')
//
//                            document.register.last.focus();
//                       }
//
//                    var  aemail = document.register.email.value;
//                    if(aemail.length==""){
//
//                        alert('Please Enter A Valid Email');
//
//                            document.register.email.focus();
//
//                            }
//
//
//                    var auser = document.register.userName.value;
//                    if(auser.length==""){
//
//                             alert('Please Enter A UserName');
//
//                             document.register.userName.focus();
//
//                            }
//
//
//                var pass1 = document.register.password1.value;
//                var pass2 = document.register.password2.value;
//                    if(pass1.length == ""){
//
//                            alert('Please Enter A Password');
//
//                            document.register.password1.focus();
//
//                            }else{
//
//                        if (pass1!=pass2) {
//
//                                alert('Your Passwords Not Match :/');
//
//                                document.register.password1.focus();
//                                }
//                                    }


                     document.getElementById("exitoRegister").style.display="inline"

                      }

        </script>
</html>