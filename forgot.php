<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';




if(!isset($_GET['forgot'])|| !$_GET['forgot'] ){

    header('location: index.php');
}

if(itIsMethod('post') ){

    if(isset($_POST['email'])){

        $email =  $_POST['email'] ;

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

       if (email_exists($email)) {
        

        $stmt =   mysqli_prepare($connection , "UPDATE users set token='{$token}' where user_email= ?");
        mysqli_stmt_bind_param($stmt , "s" , $email ) ;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $mail = new PHPMailer(true) ;


        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
        $mail->isSMTP();                                          
        $mail->Host       = Config::SMTP_HOST;                    
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = Config::SMTP_USER;                    
        $mail->Password   = Config::SMTP_PASSWORD;                
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
        $mail->Port       = Config::SMTP_PORT;    
        $mail->isHTML(true);
        
        $mail->setFrom('salaheddib.66@gmail.com' , 'salah eddib');
        $mail->addAddress($email); 

        $mail->Subject ='changing password';
        $mail->Body ='<p>Click to change your password
        <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.'">http://localhost/cms/reset.php?email='.$email.'&token='.$token.'"</a>
        </p>';


        if($mail->send()){
            $emailSend = true ;
        }else{
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

       }

    }


}



?>




<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                    <?php if(!isset($emailSend)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                        <?php else: ?>
                        <h2>Please check your email</h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

