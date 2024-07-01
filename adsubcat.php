<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sub-Category Manager</title>
</head>

<body>
    <div class="content-wrapper">
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-header content-header">
                    <div class="row" style="border-bottom:2px solid black">
                        <div class="col-sm-6 col-lg-12 col-md-12">
                            <h1>Add Sub-Category</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="add_sub_category.php" method="post" class="p-3 rounded rounded-lg row" enctype="multipart/form-data">

                        <div class="form-group col-lg-7 col-md-7 col-sm-12">
                            <label for="">Select Category</label>
                            <select name="cate_id" id="" class="form-control">
                                <option value="">Please choose Category</option>
                                <?= SelectSubCat() ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-7 col-md-7 col-sm-12">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Enter Sub-Category Name" id="catname" onfocusout="Checkname(this)">
                            <span id="error_msg" class="text-danger"></span>
                        </div>
                        <div class="form-group col-lg-7 col-md-7 col-sm-12">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <button class="btn btn-outline-success form-control mt-3 col-lg-7 col-md-7 col-sm-12" type="submit" name="submit" id="submit">Add Sub-Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
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

    function SelectSubCat()
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
    ?>

    <script>
         function Checkname(category_name) {
            var nam = category_name.value;

            if (nam == null) {
                nam = category_name;
            }

            if (nam != "") {
                $.ajax({
                    type: 'post',
                    url: 'Duplicate_verify.php',
                    data: {sub_cat: nam},
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
    </script>

    <?php include "footer.php"; ?>
</body>

</html>