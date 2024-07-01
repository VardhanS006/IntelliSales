<?php    ob_start();
    session_start();
    if (!isset($_SESSION['redirected'])) {
        header('Location: pos.php');
        exit;
    }
    else{
        unset($_SESSION['redirected']);
    }
    require 'dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;
    
    ?>
<html>
    <head>
        <title></title>
        <style>
            #invoice-POS{
                box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
                padding:2mm;
                margin: 0 auto;
                width: 100mm;
                height:170mm;
                font-size:7mm;
                background: #FFF;
                
                        }
            ::selection {background: #f31544; color: #FFF;}
            ::moz-selection {background: #f31544; color: #FFF;}
            h1{
            font-size: 1.5em;
            color: #222;
            }
            h2{font-size: .9em;}
            h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
            }
            p{
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
            }
            
            #top, #mid,#bot{ /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            }

            #top{min-height: 100px;}
            #mid{min-height: 80px;} 
            #bot{ min-height: 50px;}

            #top .logo{
                float: left;
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
                background-size: 60px 60px;
            }
            .clientlogo{
            float: left;
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
                background-size: 60px 60px;
            border-radius: 50px;
            }
            .info{
            display: block;
            //float:left;
            margin-left: 0;
            }
            .title{
            float: right;
            }
            .title p{text-align: right;} 
            table{
                font-size:7mm;
            width: 100%;
            border-collapse: collapse;
            }
            td{
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
            }
            .tabletitle{
            padding: 5px;
            font-size: .70em;
            background: #EEE;
            }
            .service{border-bottom: 1px solid #EEE;}
            .item{width: 24mm;}
            .itemtext{font-size: .5em;}

            #legalcopy{
            margin-top: 5mm;
            }

  
  

        </style>

        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        
    </head>
    <body id="inv">
        <?php
            if (isset($_SESSION['success'])) {
            ?>
                <script>
                    var msg = "<?= $_SESSION['success'] ?>";
                    toastr.success(msg);
                </script>
            <?php
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
            ?>
                <script>
                    var msg = "<?= $_SESSION['error'] ?>";
                    toastr.error(msg);
                </script>
            <?php
                unset($_SESSION['error']);
            }

            if (!(isset($_SESSION['login'])) || !(isset($_GET['sale_id']))){
                header('location:index.php');
            }
            else if($_SESSION['role']=='1'){
                header('location:dashboard.php');
            }
        ?>
        <div id="invoice-POS">
        
            <div class="center" id="top">
                <div class="logo"></div>
                <div class="info">
                    <h2 style="font-size:50px">Intelli Sales</h2>
                </div><!--End Info-->
            </div><!--End InvoiceTop-->
        
            <div  id="mid">
                <div class="info">
                    <h2>Contact Info</h2>
                    <?php
                        include 'connection.php';
                        $userid= $_SESSION['userid'];
                        $sql="select * from users where user_id='".$userid."'";
                        $query=mysqli_query($con,$sql);
                        $userdata = mysqli_fetch_assoc($query);
                    ?>
                    <p>
                        Name : <?=$userdata['name']?></br>
                        Email : <?=$userdata['email']?></br>
                        Phone : <?=$userdata['phone']?></br>
                    </p>
                </div>
            </div><!--End Invoice Mid-->
        
            <div id="bot">
        
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours" style="padding-left:10px">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate" style="padding-left:10px">
                                <h2> Sub Total</h2>
                            </td>
                        </tr>
        
                        <?php
                            $sale_id = base64_decode($_GET['sale_id']);
                            
                            $sql = "select amount from sale where id=".$sale_id;
                            $query = mysqli_query($con,$sql);
                            $saleamnt = mysqli_fetch_assoc($query);

                            $sql1 = "select * from sale_items where sale_id=".$sale_id;
                            $query1 = mysqli_query($con,$sql1);
                            while($data1 = mysqli_fetch_assoc($query1)){
                                $sql2 = "select name from product where product_id=".$data1['product'];
                                $query2 = mysqli_query($con,$sql2);
                                $data2 = mysqli_fetch_assoc($query2);
                                ?>
                                <tr class="service">
                                    <td class="tableitem">
                                        <p class="itemtext"><?= $data2['name']?></p>
                                    </td>
                                    <td class="tableitem">
                                        <p class="itemtext"><?= $data1['quantity']?></p>
                                    </td>
                                    <td class="tableitem">
                                        <p class="itemtext">₹<?= $data1['total_price']?></p>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                        
        
        
                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate">
                                <h2>tax</h2>
                            </td>
                            <td class="payment">
                                <h2>incl.</h2>
                            </td>
                        </tr>
        
                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2><?= $saleamnt['amount']?></h2>
                            </td>
                        </tr>
        
                    </table>
                </div><!--End Table-->
        
                <div id="legalcopy">
                    <p class="legal"><strong>Thank you for your purchase!</strong> Payment is expected within 31 days; please
                        process this invoice within that time. There will be a 5% interest charge per month on late invoices.
                    </p>
                </div>
        
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->

        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        
    </body>
    <?php
        $htmlContent = ob_get_contents();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->render();
        $pdfContent = $dompdf->output();
        
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        
        require 'phpmailer/vendor/autoload.php';
        
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'intellisalessprkrt@gmail.com';
            $mail->Password   = 'vpuv jsrf jzvx jzus';
            // $mail->SMTPSecure = 'tls';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('intellisalessprkrt@gmail.com', 'Intelli-Sales');
            $mail->addAddress('hamoodarif432@gmail.com', $userdata['name']);
            $mail->addReplyTo('intellisalessprkrt@gmail.com', 'SuperKart');

            //Content
            //$mail->isHTML(true);
            $mail->Subject = 'SuperKart: Purchase Successful';
            $mail->Body    = 'Greetings '.$userdata['name'].','.'<br>'.'yugjhjhj';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->addStringAttachment($pdfContent, 'Receipt'.$sale_id.'.pdf', 'base64', 'application/pdf');

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent."."\n"."Mailer Error: {$mail->ErrorInfo}";
        }
    ?>
</html>