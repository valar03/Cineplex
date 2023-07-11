<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
    include('../header.php');
 
	require_once '../config.php';

    if (!isset($_SESSION['user'])) {
        header('location:login.php');
    }

    $res = mysqli_query($con, "SELECT * FROM tbl_registration WHERE user_id='" . $_SESSION['user'] . "'");
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['user_id'];
        $email = $row['email'];
    }
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
	if(isset($_POST['pwdrst'])){
        $message = '<div>
        <p><b>Hello!</b></p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <br>
        <p><button class="btn btn-primary"><a href="http://localhost:8080/DBMS/ticket3/movie_ticket/passwordreset.php?secret=' . base64_encode($email) . '">Reset Password</a></button></p>
        <br>
        <p>If you did not request a password reset, no further action is required.</p>
       </div>';
 
		require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\email\PHPMailer\src\Exception.php';
        require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\email\PHPMailer\src\PHPMailer.php';
        require 'C:\Users\91944\Desktop\apache\htdocs\DBMS\ticket3\movie_ticket\email\PHPMailer\src\SMTP.php';
 
		$mail = new PHPMailer(true);                            
 
		try {
			//Server settings
			$mail->isSMTP();                                     
			$mail->Host = 'smtp.gmail.com';                      
			$mail->SMTPAuth = true;                             
			$mail->Username = 'valarmathi3690@gmail.com';     
			$mail->Password = 'blackandwhite@369';             
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);                         
			$mail->SMTPSecure = 'ssl';                           
			$mail->Port = 465;                                   
            $email = $email; 
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
                <form id="validate_form" method="post" >  
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" id="email" value="<?php echo $email?>" 
                        data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
                    </div>
                    
                </form>
            </div>
        </div>  
    </div><br><br><br><br><br><br><br><br><br><br>
    
<?php include('../footer.php'); ?>