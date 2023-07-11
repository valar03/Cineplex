<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
    include('header.php');
 
	require_once 'config.php';

 ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
 .error
 {
   color: red;
   font-weight: 700;
 } 
</style>
<?php
	if(isset($_POST['sub'])){
        $message = '<div>
        <p><b>Hello!</b></p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <br>
        <p><button class="btn btn-primary"><a href="http://localhost:8080/DBMS/ticket3/movie_ticket/passwordreset1.php">Reset Password</a></button></p>
        <br>
        <p>If you did not request a password reset, no further action is required.</p>
       </div>';
 
		require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\PHPMailer\src\Exception.php';
        require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\PHPMailer\src\PHPMailer.php';
        require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\PHPMailer\src\SMTP.php';
 
		$mail = new PHPMailer(true);                            
 
		try {
			//Server settings
			$mail->isSMTP();                                     
			$mail->Host = 'smtp.gmail.com';                      
			$mail->SMTPAuth = true;                             
			$mail->Username = 'valarmathi3690@gmail.com';     
			$mail->Password = 'gxctnwcyzqlugmhv';             
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);                         
			$mail->SMTPSecure = 'ssl';                           
			$mail->Port = 465;                                   
            $email = $_POST['email']; 
            $_SESSION['email']=$email;
			//Send Email
			$mail->setFrom('valarmathi3690@gmail.com');
 
			//Recipients
			$mail->addAddress($email);              
			$mail->addReplyTo('valarmathi3690@gmail.com');
 
			//Content
			$mail->isHTML(true);                                  
			$mail->Subject = "Account registration confirmation";
			$mail->Body    = $message;
 
			$mail->send();
 
		} catch (Exception $e) {
			$_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			$_SESSION['status'] = 'error';
		}
 
	}
 ?>

<body>
    <div class="container">  
        <div class="table-responsive">  
            <h3 align="center">Forgot Password</h3><br/>
            <div class="box">
                <form action="" method="post" >  
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" id="email" 
                        data-parsley-type="email" data-parsley-trigger="keyup" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="sub" value="Send Password Reset Link" class="btn btn-success" onclick="cmail()" />
                    </div>
                    
                </form>
            </div><?php
            if(isset($_SESSION['result']))
                {
                    echo $_SESSION['result'];//displaying session message
                    unset($_SESSION['result']);//removing session message
                }
                ?>
        </div>  
    </div><br><br><br><br><br><br><br><br><br><br>
    <script>
        function cmail(){
            alert("Check you email!");
        }
        </script>
    
<?php include('footer.php'); ?>