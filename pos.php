<?php    ob_start();
    session_start();
    include 'razorpay/Razorpay.php';
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="superkart_assets/site_title.png" type="image/x-icon" />

    <link rel="stylesheet" href="userdashboard/bootstrap.min.css">

    <link rel="stylesheet" href="userdashboard/animate.css">

    <link rel="stylesheet" href="userdashboard/owl.carousel.min.css">
    <link rel="stylesheet" href="userdashboard/owl.theme.default.min.css">

    <link rel="stylesheet" href="userdashboard/select2.min.css">

    <link rel="stylesheet" href="userdashboard/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="userdashboard/fontawesome.min.css">
    <link rel="stylesheet" href="userdashboard/all.min.css">


    <link rel="stylesheet" href="userdashboard/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    
</head>

<body>
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

        if (!(isset($_SESSION['login']))){
        header('location:index.php');
        }
        
    ?>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    <div class="main-wrappers">

        <div class="header">

            <div class="header-left active">
                <a href="pos.php" class="logo logo-normal">
                    <img src="superkart_assets/logo png.png" alt="">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item nav-searchinputs">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#">
                            <div class="searchinputs">
                                <input type="text" placeholder="Search">
                                <div class="search-addon">
                                    <span><i data-feather="search" class="feather-14"></i></span>
                                </div>
                            </div>

                        </form>
                    </div>
                </li>

                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);" id="btnFullscreen">
                        <i data-feather="maximize"></i>
                    </a>
                </li>

                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);">
                        <i data-feather="settings"></i>
                    </a>
                </li>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info">
                            <span class="user-letter">
                                <img src="user_img/<?= $_SESSION['img'] ?>" alt="" class="img-fluid">
                            </span>
                            <span class="user-detail">
                                <span class="user-name"><?= $_SESSION['login'] ?></span>
                                <span class="user-role">User</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="user_img/<?= $_SESSION['img'] ?>" alt="">
                                    <span class="status online"></span>
                                </span>
                                <div class="profilesets">
                                    <h6><?= $_SESSION['login'] ?></h6>
                                    <h5>User</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0"
                                href="index.php"><img
                                    src="icons/right-from-bracket-solid.svg"
                                    class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="page-wrapper ms-0">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 tabs_wrapper">
                        <div class="page-header mb-0">
                            <div class="page-title mb-0">
                                <h4>Categories</h4>
                            </div>
                        </div>
                        <!-- Categories -->
                        <ul class=" tabs owl-carousel owl-theme owl-product  border-0">
                            <?php
                                include 'connection.php';
                                $sql = "select * from category where parent_id != 0 order by parent_id";
                                $query = mysqli_query($con, $sql);
                                
                                while ($data = mysqli_fetch_assoc($query)) {
                                    ?>
                            <li id="<?=$data['name']?>" onclick="checkpro('<?=$data['id']?>','<?=$data['name']?>')">
                                <div class="product-details" style="height:130px">
                                    <img src="sub_cat_image/<?=$data['image']?>" alt="img" style="min-height:60px;max-height:60px;" class="mt-2">
                                    <h6 class="a-truncate-cut text-center" aria-hidden="true" style="height: 2.6em;"><?=$data['name']?></h6>
                                </div>
                            </li>
                            <?php
                                }
                            ?>

                        </ul>

                        <!-- Products -->
                        <div class="tabs_container" id="productsshow">
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="order-list">
                            <div class="orderid">
                                <h4>Order List</h4>
                                <?php
                                    include 'connection.php';
                                    $sql = "select id from sale order by id desc limit 1";
                                    $query = mysqli_query($con, $sql);

                                    $data = mysqli_fetch_assoc($query);
                                    $saleno = 1;
                                    if($data){
                                        $saleno = $data['id']+1;
                                    }
                                
                                ?>
                                <h5 class="trnsctn" id="<?=$saleno?>">Transaction id : #<?=$saleno?></h5>
                            </div>
                        </div>
                        <div class="card card-order">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal"
                                            data-bs-target="#create"><i class="fa fa-plus me-2"></i>Add Customer</a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="select-split ">
                                            <div class="select-group w-100">
                                                <select class="select" id="custselect" onchange="custselect(this)">
                                                    <option value="">Select Customer</option>
                                                    <?=selectcust()?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="select-split">
                                            <div class="select-group w-100">
                                                <select class="select">
                                                    <option>Product</option>
                                                    <option>Barcode</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-end">
                                            <a class="btn btn-scanner-set" onclick="alert('COMING SOON!!!')"><img
                                                    src="icons/barcode-solid.svg"
                                                    alt="img" class="me-2">Scan bardcode</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0">
                                <div class="totalitem">
                                    <h4 id="cartitms"></h4>
                                    <a href="javascript:void(0);"></a>
                                </div>
                                <div class="product-table" id="procart">
                                    
                                    
                                </div>
                            </div>
                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0 pb-2">
                                <div class="setvalue mr-2">
                                    <ul>
                                        <li class="total-value">
                                            <h5>Total </h5>
                                            <h6 class="carttotal"></h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="setvaluecash">
                                    <ul>
                                        <li style="width:50%">
                                            <a href="javascript:void(0);" id="cash" class="paymentmethod">
                                                <img src="icons/money-bill-wave-solid.svg"
                                                    alt="img" class="me-2">
                                                Cash
                                            </a>
                                        </li>
                                        <li style="width:50%">
                                            <a href="javascript:void(0);" id="online" class="paymentmethod">
                                                <img src="icons/money-check-solid.svg"
                                                    alt="img" class="me-2">
                                                Online Payment
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="setvalue mr-2">
                                    <ul>
                                        <li class="total-value">
                                            <h5>Payment Mode </h5>
                                            <h6 class="p_mode"></h6>
                                        </li>
                                    </ul>
                                </div>
                                <a class="btn btn-totallabel disabled" id="chckout" >
                                    <h5>Checkout</h5>
                                    <h6 class="carttotal"></h6>
                                </a>

                                <div class="btn-pos">
                                    <ul>
                                        <li>
                                            <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img
                                                    src="icons/clock-solid.svg"
                                                    alt="img" class="me-1">Recent Transactions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_customer2.php" method="post" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" id="catname" onfocusout="Checkname(this)" required>
                                <span id="error_msg" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="ph" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="add" placeholder="Address" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success form-control" name="submit" type="submit" id="submit">Save changes</button>
                    </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="recents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recent Transactions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabs-sets">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="sale-tab" data-bs-toggle="tab"
                                    data-bs-target="#sale" type="button" aria-controls="sale"
                                    aria-selected="true" role="tab">Sale</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="sale" role="tabpanel"
                                aria-labelledby="sale-tab">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img
                                                    src="icons/magnifying-glass-solid.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                                <th>Payment Mode</th>
                                                <th>Payment Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'connection.php';
                                                $sql = "select * from sale where user_id=".$_SESSION['userid'];
                                                $query = mysqli_query($con, $sql);
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $sl_id=$data['id'];
                                                    $sql2 = "select name from customer where id=".$data['customer'];
                                                    $query2 = mysqli_query($con, $sql2);
                                                    $data2=mysqli_fetch_assoc($query2);
                                            ?>
                                                <tr>
                                                    <td><?=$data['date']?></td>
                                                    <td><?=$data2['name']?></td>
                                                    <td><?=$data['amount']?></td>
                                                    <td><?=$data['payment_mode']?></td>
                                                    <td><?=$data['payment_status']?></td>
                                                    <td><button class="btn btn-info" id="sale<?=$data['id']?>" onclick="Viewsale(<?=$data['id']?>,<?=$data['customer']?>,'<?=$data['amount']?>','<?=$data['payment_mode']?>','<?=$data['payment_status']?>')">View</button></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmsale" tabindex="-1" aria-labelledby="Confirm Sale" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetails">Cart Checkout</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="confirmsale.php" method="post" enctype="multipart/form-data">
                        <div id="saleform"></div>

                        <div class="pt-3 pb-2" id="modal-ftr">
                            <div id="paymnt">
                                <div type="button" class="btn btn-primary" style="float:right" id="rzp-button1">Pay Now</div>
                                <span class="badge bg-warning text-dark" style="font-size:13px;float:right;margin:7px 20px 0px 0px" id="paymnt_status">PENDING</span>
                                <span class="m-2" style="float:right">Payment Status: </span>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success" name="submit" type="submit" id="chckot">CheckOut(Confirm)</button>
                            <span class="text-danger" id="chckdsable"></span>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <script src="userdashboard/js/jquery-3.6.0.min.js"></script>

    <script src="userdashboard/js/feather.min.js"></script>

    <script src="userdashboard/js/jquery.slimscroll.min.js"></script>

    <script src="userdashboard/js/bootstrap.bundle.min.js"></script>

    <script src="userdashboard/js/jquery.dataTables.min.js"></script>
    <script src="userdashboard/js/dataTables.bootstrap4.min.js"></script>

    <script src="userdashboard/js/select2.min.js"></script>

    <script src="userdashboard/js/owl.carousel.min.js"></script>

    <script src="userdashboard/js/sweetalert2.all.min.js"></script>
    <script src="userdashboard/js/sweetalerts.min.js"></script>

    <script src="userdashboard/js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function(){
            $('#chckout').click(function(){
                var custr = $('#custselect').val();
                var t_id=$('.trnsctn').attr('id');
                var ctotal=$('.carttotal').html();
                var pmode=$('.p_mode').html();
                
                $.ajax({
                    type: 'post',
                    url: 'confirmsalemodal.php',
                    data: {cust:custr,t_id:t_id,ctotal:ctotal,pmode:pmode,t_itm:$('#cartitms').html()},
                    success: function(data) {
                        $('#saleform').html(data);
                        $('#orderdetails').html('Cart Checkout');
                    }
                });

                $('#confirmsale').modal('show');

                if(pmode=="ONLINE"){
                    // $('#paymnt').html('<div type="button" class="btn btn-primary" style="float:right" id="rzp-button1">Pay Now</div><span class="badge bg-warning text-dark" style="font-size:13px;float:right;margin:7px 20px 0px 0px" id="paymnt_status">PENDING</span><span class="m-2" style="float:right">Payment Status: </span>');
                    $('#modal-ftr').css({'display':'block'});
                    $('#paymnt').css({'display':'block'});
                    $('#chckot').addClass('disabled');
                    $('#chckdsable').html('Payment Incomplete!');
                }
                else{
                    $('#modal-ftr').css({'display':'block'});
                    $('#paymnt').css({'display':'none'});
                    $('#chckot').removeClass('disabled');
                    $('#chckdsable').html('');
                }
            });

            

            $('#cash').click(function(){
                $('#cash').addClass('border-primary text-primary');
                $('#online').removeClass('border-primary text-primary');
                $('.p_mode').html('CASH');
                $.ajax({
                    type: 'post',
                    url: 'carttotal.php',
                    data: {cust:$('#custselect').val()},
                    success: function(data) {
                        $('.carttotal').html(data+"₹");
                        if(data>0){
                            $('#chckout').removeClass('disabled');
                            $('#chckout').removeClass('online');
                        }
                        else{
                            $('#chckout').removeClass('disabled');
                            $('#chckout').addClass('disabled');
                        }
                    }
                });
            });
            
            $('#online').click(function(){
                $('#online').addClass('border-primary text-primary');
                $('#cash').removeClass('border-primary text-primary');
                $('.p_mode').html('ONLINE');
                $.ajax({
                    type: 'post',
                    url: 'carttotal.php',
                    data: {cust:$('#custselect').val()},
                    success: function(data) {
                        $('.carttotal').html(data+"₹");
                        if(data>0){
                            $('#chckout').removeClass('disabled');
                            $('#chckout').removeClass('online');
                            $('#chckout').addClass('online');
                        }
                        else{
                            $('#chckout').removeClass('disabled');
                            $('#chckout').addClass('disabled');
                        }
                    }
                });
            });
        });

        function Checkname(category_name) {
            var nam = category_name.value;

            if (nam == null) {
                nam = category_name;
            }

            if (nam != "") {
                $.ajax({
                    type: 'post',
                    url: 'Duplicate_verify.php',
                    data: {customer: nam},
                    success: function(data) {
                        if (data == 1) {
                            $('#submit').attr('disabled', 'disabled');
                            $('#error_msg').text('Already exist');
                            $('#error_msg').removeClass('text-success').addClass('text-danger');
                            $('#catname').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#submit').removeAttr('disabled');
                            $('#error_msg').text('Valid Name');
                            $('#error_msg').removeClass('text-danger').addClass('text-success');
                            $('#catname').removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                });
            }
        }

        function checkpro(subcat,sbnm) {
            if (subcat != "") {
                $.ajax({
                    type: 'post',
                    url: 'productlist.php',
                    data: {sub_id: subcat,sub_name:sbnm},
                    success: function(data) {
                        
                        if (data == 1) {
                            $('#productsshow').html('<div class="text-center mt-5"><img src="superkart_assets/nopro.png" style="height:230px;width:260px"><h4 class="text-secondary">Currently, No Products in this Category</h4></div>');
                        } else {
                            $('#productsshow').html(data);
                        }
                    }
                });
            }
        }

        function procart(proid,act) {
            if (proid != "") {
                if($('#custselect').val()!=""){
                    var custr = $('#custselect').val();
                    $.ajax({
                        type: 'post',
                        url: 'add2cart.php',
                        data: {proid:proid,cust:custr,act:act},
                        success: function(data) {
                            if(data=="increase"){
                                var prc=$('#pric'+proid).html();
                                var qty=eval($('#qty'+proid).val()+'+'+1);
                                var ttl=eval(qty+'*'+prc);
                                $('#qty'+proid).val(qty);
                                $('#ttl'+proid).html(ttl);
                                
                            }
                            else if(data=="decrease"){
                                if($('#qty'+proid).val()>=1){
                                    var prc=$('#pric'+proid).html();
                                    var qty=eval($('#qty'+proid).val()+'-'+1);
                                    var ttl=eval(qty+'*'+prc);
                                    $('#qty'+proid).val(qty);
                                    $('#ttl'+proid).html(ttl);
                                }
                                else{
                                    alert("dffd");
                                }
                                
                            }
                            else{
                                $('#procart').html(data);
                            }
                            var ttlitms=$('.product-lists').length;
                            if(ttlitms==1){
                                $('.totalitem').html('<h4 id="cartitms">Total items : 0</h4><a href="javascript:void(0);" onclick="delcart()">Clear all</a>')
                                $('#cartitms').html("Total items : "+ttlitms);
                            }
                            else{
                                $('#cartitms').html("Total items : "+ttlitms);
                            }

                            $.ajax({
                                type: 'post',
                                url: 'carttotal.php',
                                data: {cust:custr},
                                success: function(data) {
                                    $('.carttotal').html(data+"₹");
                                    if(data>0 && $(".p_mode").html()!=""){
                                        $('#chckout').removeClass('disabled');
                                    }
                                    else{
                                        $('#chckout').removeClass('disabled');
                                        $('#chckout').addClass('disabled');
                                    }
                                }
                            });
                        }
                    });
                }
                else{
                    alert('Please Select Customer First');
                    $('.totalitem').html("");
                    $('.carttotal').html("0.00₹");

                    $('#chckout').removeClass('disabled');
                    $('#chckout').addClass('disabled');
                }
            }
        }

        function custselect(custid) {
            if (custid.value != "") {
                $.ajax({
                    type: 'post',
                    url: 'add2cart.php',
                    data: {cust:custid.value},
                    success: function(data) {
                        $('#procart').html(data);
                        var ttlitms=$('.product-lists').length;
                        if(ttlitms>=1){
                            $('.totalitem').html('<h4 id="cartitms">Total items : 0</h4><a href="javascript:void(0);" onclick="delcart()">Clear all</a>')
                            $('#cartitms').html("Total items : "+ttlitms);
                            $.ajax({
                                type: 'post',
                                url: 'carttotal.php',
                                data: {cust:custid.value},
                                success: function(data) {
                                    $('.carttotal').html(data+"₹");
                                    if(data>0 && $(".p_mode").html()!=""){
                                        $('#chckout').removeClass('disabled');
                                    }
                                    else{
                                        $('#chckout').removeClass('disabled');
                                        $('#chckout').addClass('disabled');
                                    }
                                }
                            });
                        }
                        else{
                            $('.totalitem').html("");
                            $('.carttotal').html("0.00₹");

                            $('#chckout').removeClass('disabled');
                            $('#chckout').addClass('disabled');
                        }
                    }
                });
            }
            else{
                $('#procart').html("");
                $('.totalitem').html("");
                $('.carttotal').html("0.00₹");

                $('#chckout').removeClass('disabled');
                $('#chckout').addClass('disabled');
            }
        }

        function delcart(proid){
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to Remove all the items from the cart?',
                buttons: {
                    delete: function () {
                        var custr = $('#custselect').val();
                        $.ajax({
                            type: 'post',
                            url: 'delcart.php',
                            data: {cust:custr,proid:proid},
                            success: function(data) {
                                if(data=="all"){
                                    $('#procart').html("");
                                    $('.totalitem').html("");
                                    $('.carttotal').html("0.00₹");
            
                                    $('#chckout').removeClass('disabled');
                                    $('#chckout').addClass('disabled');
                                }
                                else{
                                    $('#procart').html(data);
                                    var ttlitms=$('.product-lists').length;
                                    if(ttlitms>=1){
                                        $('.totalitem').html('<h4 id="cartitms">Total items : 0</h4><a href="javascript:void(0);" onclick="delcart()">Clear all</a>')
                                        $('#cartitms').html("Total items : "+ttlitms);
                                        $.ajax({
                                            type: 'post',
                                            url: 'carttotal.php',
                                            data: {cust:custr},
                                            success: function(data) {
                                                $('.carttotal').html(data+"₹");
                                                if(data>0 && $(".p_mode").html()!=""){
                                                    $('#chckout').removeClass('disabled');
                                                }
                                                else{
                                                    $('#chckout').removeClass('disabled');
                                                    $('#chckout').addClass('disabled');
                                                }
                                            }
                                        });
                                    }
                                    else{
                                        $('.totalitem').html("");
                                        $('.carttotal').html("0.00₹");
            
                                        $('#chckout').removeClass('disabled');
                                        $('#chckout').addClass('disabled');
                                    }
                                }
                            }
                        });
                    },
                    cancel: function () {
                        
                    }
                    
                }
            });
            
        }

        function Viewsale(s_id,cst,amnt,pmode,pstatus) {
            
            var custr = cst;
            var t_id=s_id;
            var ctotal=amnt;
            var pmode=pmode;
            var pstatus=pstatus;

            $.ajax({
                type: 'post',
                url: 'viewsale.php',
                data: {cust:custr,t_id:t_id,ctotal:ctotal,pmode:pmode,pstatus:pstatus},
                success: function(data) {
                    console.log('asdasdasd');
                    $('#saleform').html(data);
                    $('#modal-ftr').css({'display':'none'});
                    $('#orderdetails').html('Order Details');
                }
            });

            $('#confirmsale').modal('show');
        }

        $('#rzp-button1').click(function(e){

            var ctotal = $("#ctotal").val();
            var t_id = $("#t_id").val();
            var cstid = $('#cstname').val();
            $.ajax({
                type: 'post',
                url: 'orderamnt.php',
                data: {ctotal:ctotal,t_id:t_id,cstid:cstid},
                
                success: function(data) {
                    console.log(data);
                    var splitData = data.split(',');
                    var receivedAmount = splitData[0];
                    var receivedReceiptId = splitData[1];
                    var phne = splitData[2];
                    // var cstnme = splitData[3];
                    console.log(receivedAmount);

                    var options = {
                        
                        "amount": receivedAmount,
                        "currency": "INR",
                        "name": "SuperKart",
                        "description": "Online Transaction",
                        "image": "superkart_assets/logo png.png",
                        "order_id": receivedReceiptId,
                        "handler": function (response){
                            console.log(response.razorpay_payment_id);
                            console.log(response.razorpay_order_id);
                            console.log(response.razorpay_signature)
                        },
                        "prefill": {
                            "name": cstid,
                            "contact":"0091" + phne,
                            "email":"jhjuhg@jg.com"
                        },
                        "notes": {
                            "address": "Razorpay Corporate Office"
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.captured', function (response){
                        console.log(response.error.description);
                        console.log(response.error.code);
                        console.log(response.error.source);
                        console.log(response.error.step);
                        console.log(response.error.reason);
                        alert(response.error.metadata.order_id);
                        alert(response.error.metadata.payment_id);
                    });
                    var rzp1 = new Razorpay(options);

                    rzp1.open();
                    e.preventDefault();
                }
            });
        });
    </script>
    <?php
    function selectcust()
    {
        include 'connection.php';
        $sql21 = "select * from customer";
        $query21 = mysqli_query($con, $sql21);
        $sub_cate = '';
        while ($data21 = mysqli_fetch_assoc($query21)) {
            $sub_cate .= "<option value='" . $data21['id'] . "'>" . $data21['name'] . "</option>";
        }
        echo $sub_cate;
    }
    ?>
    
</body>

</html>