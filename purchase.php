<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase</title>
</head>

<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content-header">
                <div class="row" style="border-bottom:2px solid black">
                    <div class="col-sm-6 col-lg-12 col-md-12">
                        <h1>Purchase</h1>
                    </div><!-- /.col -->
                </div>
            </div>

            <form action="confirm.php" method="post" class="p-3 rounded rounded-lg" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="form-group col-lg-2 col-md-2 col-sm-6">
                        <label>Purchase No:-</label>
                    </div>
                    <?php
                        include 'connection.php';
                        $sql = "select p_id from purchase order by p_id desc limit 1";
                        $query = mysqli_query($con, $sql);

                        $data = mysqli_fetch_assoc($query);
                        $prchsno = 1;
                        if($data){
                            $prchsno = $data['p_id']+1;
                        }
                    
                    ?>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6">
                        <input type="text" class="form-control" name="p_no" value="<?=$prchsno?>" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6">
                        <label>Date:-</label>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6">
                        <input type="date" class="form-control" name="pdate" value='<?=date('Y-m-d')?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2 col-md-2 col-sm-6">
                        <label>Supplier:-</label>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6">
                        <select name="sup" id="sup" class="form-control"onchange="checksplr(this)" >
                            <option value="">Select Supplier</option>
                        <?= selectsup() ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6">
                        <label>Warehouse:-</label>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6">
                        <select name="ware" id="ware" class="form-control" onchange="wareadd(this)">
                            <option value="">Select Warehouse</option>
                        <?= selectware() ?>
                        </select>
                    </div>

                    <input type="hidden" name="ttlqty">
                    <input type="hidden" name="ttlamtcheck">
                </div>

            <div class="row mt-3">
                <table class="table table-bordered form-group">
                    <thead class="text-center bg-dark text-sm">
                        <tr>
                            <th>SR. NO.</th>
                            <th>CATEGORY</th>
                            <th>SUB-CATEGORY</th>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                            <th>QUANTITY</th>
                            <th>COST(PER UNIT)</th>
                            <th>TOTAL AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody id="prdcttable" class="text-center text-sm text-bold">
                        <tr id="row_1">
                            <td><b>1</b></td>
                            <td class="cat">
                                <select class="form-control select2" name="cat[]" id="cat1" onchange="checkcat(this,1)">
                                    <option value="">Select Category</option>
                                <?= SelectCat()?>
                                </select>
                            </td>
                            <td class="subcat">
                                <select class="form-control select2" name="subcat[]" id="subcat1" onchange="checkcat(this,1)">
                                    <option value="">Select Sub-Category</option>
                                </select>
                            </td>
                            <td class="brnd">
                                <select class="form-control select2" name="brnd[]" id="brnd1" onchange="checkcat(this,1)">
                                    <option value="">Select Brand</option>
                                </select>
                            </td>
                            <td class="prdt">
                                <select class="form-control select2" name="prdct[]" id="prdct1" onchange="checkcat(this,1)">
                                    <option value="">Select Product</option>
                                </select>
                            </td>
                            <td class="qty">
                                <input type="number" class="form-control text-right" name="qty[]" id="qty1" onchange="checkcat(this,1)">
                            </td>
                            <td name="cost" id="cost1">
                                <input type="number" class="form-control cost text-right" name="cst[]" id="cst1" onchange="checkcat(this,1)">
                            </td>
                            <td id="totl1" name="totl1">
                                <input type="number" class="form-control ttlamnt text-right" id="ttl1" name="ttl[]" readonly>
                            </td>
                        </tr>
                    </tbody>
                    <tr class="">
                        <td colspan=6></td>
                        <td>
                            <input type="text" class="form-control text-center text-bold bg-dark" value="TOTAL:-" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control text-right text-bold bg-dark" id="totalamnt" name="totlamt" readonly>
                        </td>
                    </tr>
                </table>
            </div>

                <button class="form-control btn btn-dark mt-2 col-lg-2 col-md-2 col-sm-6 float-right" id="confirm" type="submit" name="cnfrm" onclick="confirm('Are you sure You want to Finalize this purchase?')">Confirm</button>
                <button class="btn btn-info mt-2 mr-3 col-lg-2 col-md-2 col-sm-6 float-right" id="reset" name="reset" onclick="confirm('Reset all the data?')">Reset All</button>
                <button class="btn btn-primary mt-2 col-lg-2 col-md-2 col-sm-6" id="addrow" name="add_p" type="button">Add Row</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    
    <script>
        var count = 2;
        $(document).ready(function(){

            $('#addrow').click(function(){
                $('#prdcttable').append('<tr id="row_'+count+'"><td><b>'+count+'</b></td><td class="cat"><select class="form-control select2" name="cat[]" id="cat'+count+'" onchange="checkcat(this,'+count+')"><option value="">Select Category</option>'+"<?= SelectCat()?>"+'</select></td><td class="subcat"><select class="form-control select2" name="subcat[]" id="subcat'+count+'" onchange="checkcat(this,'+count+')"><option value="">Select Sub-Category</option></select></td><td class="brnd"><select class="form-control select2" name="brnd[]" id="brnd'+count+'" onchange="checkcat(this,'+count+')"><option value="">Select Brand</option></select></td><td class="prdt"><select class="form-control select2" name="prdct[]" id="prdct'+count+'" onchange="checkcat(this,'+count+')"><option value="">Select Product</option></select></td><td class="qty"><input type="number" class="form-control text-right" name="qty[]" id="qty'+count+'" onchange="checkcat(this,'+count+')"></td><td name="cost" id="cost'+count+'"><input type="number" class="form-control cost text-right" name="cst[]" id="cst'+count+'" onchange="checkcat(this,'+count+')"></td><td id="totl'+count+'" name="totl'+count+'"><input type="number" class="form-control ttlamnt text-right" id="ttl'+count+'" name="ttl[]" readonly></td></tr>');
                $('.select2').select2();
                count++;
            });

            $('#reset').click(function(){
                $('#prdcttable').html('<tr id="row_1"><td><b>1</b></td><td class="cat"><select class="form-control select2" name="cat[]" id="cat1" onchange="checkcat(this,1)"><option value="">Select Category</option>'+"<?= SelectCat()?>"+'</select></td><td class="subcat"><select class="form-control select2" name="subcat[]" id="subcat1" onchange="checkcat(this,1)"><option value="">Select Sub-Category</option></select></td><td class="brnd"><select class="form-control select2" name="brnd[]" id="brnd1" onchange="checkcat(this,1)"><option value="">Select Brand</option></select></td><td class="prdt"><select class="form-control select2" name="prdct[]" id="prdct1" onchange="checkcat(this,1)"><option value="">Select Product</option></select></td><td class="qty"><input type="number" class="form-control text-right" name="qty[]" id="qty1" onchange="checkcat(this,1)"></td><td name="cost" id="cost1"><input type="number" class="form-control cost text-right" name="cst[]" id="cst1" onchange="checkcat(this,1)"></td><td id="totl1" name="totl1"><input type="number" class="form-control ttlamnt text-right" id="ttl1" name="ttl[]" readonly></td></tr>');
                $('.select2').select2();
                $('#totalamnt').val("");
                count=2;
            });

            $('#confirm').click(function(){
                
                var ttlqty=0;
                var ttlamt="";
                for(var i=1;i<count;i++){
                    ttlqty=eval($('#qty'+i).val()+'+'+ttlqty);
                    ttlamt= $('#ttl'+i).val() + ttlamt;
                }
                $('input[name="ttlqty"]').val(ttlqty);
                $('input[name="ttlamtcheck"]').val(ttlamt);

            });
        });

        function checkcat(cat,id) {
            var cate = cat.value;
            if(cate==null)
            {
                cate=cat;
            }

            if(cat.name=="cat[]")
            {
                if (cate != "")
                {
                    $.ajax({
                        type:'post',
                        url:'prchsdata.php',
                        data:{cate:cate},
                        success:function(data){
                            
                            $('#subcat'+id).html(data);
                            $('#brnd'+id).html('<option value="">Select Brand</option>');
                            $('#prdct'+id).html('<option value="">Select Product</option>');
                            $('#cst'+id).val("");
                            $('#ttl'+id).val("");
                        }
                    });
                }
                else
                {
                    $('#subcat'+id).html('<option value="">Select Sub-Category</option>');
                    $('#brnd'+id).html('<option value="">Select Brand</option>');
                    $('#prdct'+id).html('<option value="">Select Product</option>');
                    $('#cst'+id).val("");
                    $('#ttl'+id).val("");
                }
            }

            else if(cat.name=="subcat[]")
            {
                if (cate != "")
                {
                    $.ajax({
                        type:'post',
                        url:'prchsdata.php',
                        data:{subcate:cate},
                        success:function(data){
                            $('#brnd'+id).html(data);
                            $('#prdct'+id).html('<option value="">Select Product</option>');
                            $('#cst'+id).val("");
                            $('#ttl'+id).val("");
                        }
                    });
                }
                else
                {
                    $('#brnd'+id).html('<option value="">Select Brand</option>');
                    $('#prdct'+id).html('<option value="">Select Product</option>');
                    $('#cst'+id).val("");
                    $('#ttl'+id).val("");
                }
            }

            else if(cat.name=="brnd[]")
            {
                if (cate != "")
                {
                    $.ajax({
                        type:'post',
                        url:'prchsdata.php',
                        data:{brnd:cate},
                        success:function(data){
                            $('#prdct'+id).html(data);
                            $('#cst'+id).val("");
                            $('#ttl'+id).val("");
                        }
                    });
                }
                else
                {
                    $('#prdct'+id).html('<option value="">Select Product</option>');
                    $('#cst'+id).val("");
                    $('#ttl'+id).val("");
                }
            }

            else if(cat.name=="prdct[]")
            {
                if (cate != "")
                {
                    $.ajax({
                        type:'post',
                        url:'prchsdata.php',
                        data:{prdct:cate,rowid:id},
                        success:function(data){
                            $('#cost'+id).html(data);
                            $('#ttl'+id).val($('#qty'+id).val()*$('#cst'+id).val());
                        }
                    });
                }
                else
                {
                    $('#cst'+id).val("");
                    $('#ttl'+id).val("");
                }
            }

            else if((cat.name=="qty[]")||(cat.name=="cst[]"))
            {
                if ($('#cst'+id).val() != "")
                {
                    $('#ttl'+id).val($('#qty'+id).val()*$('#cst'+id).val());
                }
                else{
                    $('#ttl'+id).val("");
                }
            }
            ttlchange();
        }

        function ttlchange(){
            var ttlamt=0.0;
            for(var i=1;i<count;i++){
                ttlamt=eval($('#ttl'+i).val()+'+'+ttlamt);
            }
            $('#totalamnt').val(ttlamt);
        }
    </script>

    <?php
    function SelectCat()
    {
        
        include 'connection.php';
        $sql = "select * from category where parent_id = 0";
        $query = mysqli_query($con, $sql);
        $sub_cate = '';
        while ($data = mysqli_fetch_assoc($query)) {
            $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
        }
        echo $sub_cate;
    }
    function selectsup()
    {
        
        include 'connection.php';
        $sql = "select * from supplier";
        $query = mysqli_query($con, $sql);
        $sub_cate = '';
        while ($data = mysqli_fetch_assoc($query)) {
            $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
        }
        echo $sub_cate;
    }
    function selectware()
    {
        
        include 'connection.php';
        $sql = "select * from warehouse";
        $query = mysqli_query($con, $sql);
        $sub_cate = '';
        while ($data = mysqli_fetch_assoc($query)) {
            $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
        }
        echo $sub_cate;
    }
    ?>
</body>

</html>