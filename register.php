    <?php
    $page_title ='register';

    require_once('validarEmail.php');
    //require_once('connect.php');

    if(isset($_POST['submit'])){
             $errors =  array();
             /*validamos el nombre*/
               if(empty($_POST['first']) || is_numeric($_POST['first'])){
                    $errors[] ="you forgot enter your First Name";
               }else{
                      $name = trim($_POST['first']);
               }

                       if(empty($_POST['last']) || is_numeric($_POST['last'])){

                            $errors[] = "you forgot enter your Last Name";

                               }else{

                                    $last = trim($_POST['last']);
                               }

                               if(empty($_POST['gender'])){

                                      $errors[]= "you forgot enter your Gender";

                               }else{

                                    $gender = trim($_POST['gender']);

                               }

                               if(empty($_POST['age'])){

                                      $errors[] = "you forgot enter your Age Range";

                               }else{

                                    $age = trim($_POST['age']);

                               }


                             // Check that they were born before this
                             if ($_POST['year'] >= date('Y') ) {
                                 print '<p class="error">Either you entered your birth year wrong or you come from the'
                                 . ' future!</p>';
                                 $okay = false;
                             }

                             if ( is_numeric($_POST['year']) && (strlen($_POST['year']) == 4) ) {
                                 if ($_POST['year'] < date('Y')) {
                                     $age = date('Y') - $_POST['year'];
                                  } else {
                                      print '<p class="error"> Either you entered your birth year wrong or you come from the
                                             future!</p>';
                                      $okay = false;
                                  } // End of 2nd conditional.

                             } else { // Else for 1st conditional.
                                 print '<p class="error"> Please enter the year you were born as four digits.</p>';
                                 $okay = false;
                             } // End of 1st conditional.

                             if(empty($_POST['terms'])){

                                      $errors[] = "you forgot acept the term of use!! U_U____.i.";

                             } else {

                               echo	$terms = $_POST['terms'];

                            }


                            // Validate the color:
                               switch ($_POST['color']) {
                                   case 'red':
                                       $color_type = 'primary';
                                       break;
                                   case 'yellow':
                                       $color_type = 'primary';
                                       break;
                                   case 'green':
                                       $color_type = 'secondary';
                                       break;
                                   case 'blue':
                                       $color_type = 'primary';
                                       break;
                                   default:
                                       print '<p class="error">Please select your favorite color.</p>';
                                       $okay = false;
                                       break;
                               }

                            /* validamos el Email */
               if(empty($_POST['email'])){

                      $errors[] = "you forgot enter your email" ;

               }else{

                     $validarmail = comprobar_email($_POST['email']);

                     if($validarmail == 1){

                     $mail = trim($_POST['email']);

                       } else {

                               $errors[] = 'ingrese un email valido';

                               }

               }

                       /*validamos el username*/
               if(empty($_POST['userName'])){

                      $errors[] = "you forgot enter your username";

               }else{

                      $username = trim($_POST['userName']);

                       }

                                       /*validamos el password y validamos la confirmacion*/
               if(empty($_POST['password1'])){

                      $errors[] = " you forgot enter your password!! " ;


               }else{

                       if($_POST['password1'] == $_POST['password2']){

                       $password = trim($_POST['password1']);

               }else{

                      $errors[] = " your password and match against the confirmed password!!";

                        }

               }




               if(!empty($errors)){

               echo '<h1 id="mainhead"> Error!!! </h1>'

                   .'<p class="error"> The Following Errors Has Occurred </p>';

               foreach($errors as $msg){

                       echo '<p class="error">'.$msg.'</p><br />';

               }

                echo '<p class="error">Please Try Again</p>';

            }

            if ($_POST['color'] == 'red') {
                $color_type = 'primary';

            } elseif ($_POST['color'] == 'yellow') {
                $color_type = 'primary';
            } elseif ($_POST['color'] == 'green') {
                $color_type = 'secondary';
            } elseif ($_POST['color'] == 'blue') {
                $color_type = 'primary';
            } else { // Problem!
                print '<p class="error">Please select your favorite color.</p>';
                $okay = false;
            }


               if(empty($errors)){
                   print "<p>Your favorite color is a $color_type color.</p>";

               $query = "select nickName from usuario where nickName ='".$username."'";

               $result = @mysql_query($query);

                       if(@mysql_num_rows($result) == 0){

                              $now = date("Y/m/d");

                              $encrip = md5($password);

                          $sql = "insert into usuarios(firstName,lastName,gender,age,email,nickName,pass,terms,dateRegistration)values('".$name."',
                                 '".$last."','".$gender."','".$age."','".$mail."','".$username."','".$encrip."','".$terms."','".$now."')";

                              $result = @mysql_query($sql);



                              $cabeceras  = 'MIME-Version: 1.0' . "\r\n";

                  $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                  $scrubbed = array_map('spam_scrubber', $_POST);

                   // Minimal form validation:
                  if (!empty($scrubbed['name']) && !empty($scrubbed['email']) && !empty($scrubbed['comments']) ) {

                      // Create the body:
                     $body = "Name: {$scrubbed['name']}\n\nComments:{$scrubbed['comments']}";

    /*$mensaje ="
    <html>
    <head>
      <title>Thanks for register</title>
    </head>
    <body>
    <center>
    <b> Data confirmation: </b>"."<br>"."<br />

       <table border='0' width='50%'>
         <tr>
          <td>
         <b>First Name:  &nbsp; </b>
          </td>
          <td>".
           $_POST["first"]."
          </td>
         </tr>
         <tr>
          <td>
            <b>Last Name:  &nbsp;  </b>
          </td>
          <td>"
                 .$_POST["last"]."
          </td>
         </tr>
         <tr>
          <td>
            <b>Gender:  &nbsp; </b>
          </td>
          <td>
           ".$_POST["gender"]."
          </td>
         </tr>
         <tr>
           <td>
           <b>Age:  &nbsp;  </b>
           </td>
           <td>
           ".$_POST["age"]."
           </td>
         </tr>
             <tr>
               <td>
                <b> e-mail:  &nbsp;</b>
               </td>
               <td>"
               .$_POST["email"]."
               </td>
               </tr>
               <tr>
                  <td>
                  <b> nickname : &nbsp;</b>
                  </td>

               <td>".$_POST["userName"]."</td>
               </tr>
               <tr>
               <td>
               <b> comments: &nbsp;</b>
               </td>
                        </tr>
                <tr>
                    <td>
                     <b>password: &nbsp;</b>
                    </td>
                        <td>
                      ".$_POST["password1"]."
                </td>

               </tr>
               <tr>
               <td><b>Date Registration:</b></td>

               <td>".$now."</td>
               </tr>
          </table>  </b><br>"."<br>"."


    </body>
    </html>
    ";

            mail($_POST["email"],"Info confirmation",$body,$cabeceras);*/

                     if($result!=""){

                $url ="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

                if(substr($url, -1) == "/" OR(substr($url,-1)=='\\')){

                   $url =substr($url,0,-1);

                }

            $url .='/thanks.php';

            header("location: $url");

                    exit();

                    }else{

                      $message='<font color="red"> you could not be registered due to a application error. we apologize for the inconvenience.                    </font>'.mysql_error();

                    }

               }else{

                    echo $message='<p> <font color="red"> That username is already taken </font> </p>';

                    }

                        mysql_close();


            }else{

                    echo $message = '<p> <font color="red"> please try again </font> </p>';

                    }

    }

    }
    define('TITLE', 'Register');
    include 'header.php';
    ?>

    
        
        
        <div class='row'>
                   <div class='span5 columns'>
                       <legend> <h4> kokito's form for dumbass things: </h4> </legend>
                   </div>
        </div>
        
  
        <form name="register" action="<?php echo $_SERVER['PHP_SELF'];?>"
              method="post" onsubmit="validate()" autocomplete="false"
              class=''>
               <div class='row'>

                   <div class='span4 columns'>
                       <fieldset id="first"> First Name:                   
                           <input id="first" name="first" value="<?php if(isset($_POST['first'])) echo $_POST['first']; ?>"/>
                       </fieldset>
<!--                       <div class='alert-message error '>
                           <a class="close" href='#'>x</a>
                           omg
                       </div>-->
                   </div>
                   <div class='span4 columns'>
                       <fieldset id="last"> Last Name:
                           <input id="last" name="last" value="<?php if(isset($_POST['last'])) echo $_POST['last']; ?>"/>
                        </fieldset>
                   </div>
                   <div class='span4 columns'>
                       <fieldset id="gender"> Gender: 
                            M<input type="radio" id="gender" name="gender" value="male" />  
                            F<input type="radio" id="gender" value="female" checked="checked" />
                        </fieldset>     
                   </div>
                   <div class='span4 columns'> 
                       <fieldset id="birth"> Date of birth: 
                           <input type="date" id='birth' name="birth" value="" />
                       </fieldset>
                   </div>
               </div>
            <div class='row'>
                <div class='span4 columns'>
                       <fieldset id="email"> Email adress:                   
                           <input id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                       </fieldset>
                   </div>
                <div class='span4 columns'>
                       <fieldset id="userName"> User name:                   
                           <input id="userName" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"/>
                       </fieldset>
                </div>
                <div class='span4 columns'>
                       <fieldset id="password"> Password: 
                           <input id="password" type="password" name="password" value=""/>
                       </fieldset>
                </div>
                <div class='span4 columns'>
                       <fieldset id="password2"> 
                           Confirm Password: <input id="password2" type="password" name="password2" value=""/>
                       </fieldset>
                </div>
            </div>
            <div class='row'>
                <div class='span4 columns'>
                    Browsers:
                   <input list="browsers" placeholder="navegadores"><br>
                          <datalist id="browsers">
                              <option value="Internet Explorer">
                              <option value="Firefox">
                              <option value="Chrome">
                              <option value="Opera">
                              <option value="Safari">
                          </datalist>
                </div>    
                <div class='span4 columns'>
                    <fieldset id="color"> 
                        Favorite color:
                        <input type="color" id="color" placeholder="favorite color">
                    </fieldset>    
                </div>
                <div class='span4 columns'> 
                    <fieldset id="color"> 
                        rare  field #1:
                        <input id="datetime-local" name="datetime-local" type="datetime-local" placeholder="datetime">
                    </fieldset>
                </div>
                <div class='span4 columns'> 
                    <fieldset id="image">
                        Imagen:
                        <input id="image" type="image" placeholder="image">
                    </fieldset>
                </div>
            </div>
            <div class='row'>
                <div class='span4 columns'> 
                    <fieldset id="month">
                        month:
                        <input id='month'type="month" placeholder="month">
                    </fieldset>
                </div>
                <div class='span4 columns'> 
                    <fieldset id="number">
                       number:
                        <input id="number" type="number" placeholder="number">
                    </fieldset>
                </div>
                <div class='span4 columns'> 
                    <fieldset id="range">
                        range:
                        <input id="range" type="range" placeholder="range">
                    </fieldset>
                </div>
                <div class='span4 columns'> 
                    <fieldset id="tel">
                        Imagen:
                        <input id="tel" type="tel" placeholder="tel">
                    </fieldset>
                </div>
            </div>
            <div class='row'>
                <div class='span5 columns'> 
                    <fieldset id="time">
                        time:
                        <input id="time" type="time" placeholder="time" >
                    </fieldset>
                </div>
                <div class='span5 columns'> 
                    <fieldset id="url">
                        url:
                        <input id="url" type="url" placeholder="url" >
                    </fieldset>
                </div>
                <div class='span5 columns'> 
                    <fieldset id="week">
                        week:
                        <input id="week" type="week" placeholder="week" >
                    </fieldset>
                </div>
            </div>
            <div class='row'>
                <div class='span8 columns'>  
                    <input class="btn primary" type="submit" value="Submit">
                </div>
                <div class='span8 columns'>  
                    <input class="btn " type="reset" value="reset">
                </div>
            </div>
        </form>          
        
        <div class='alert-message success' id='exitoRegister'>
            <a class="close" href='#'>x</a>
                           formulario ingresado con exito buena esa campeon!!!!!!!
        </div>
    <?php
        include './footer.php';