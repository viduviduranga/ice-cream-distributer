<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Invoice Payament</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Invoice Payament</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php
// Return current date from the remote server
$date = date('d-m-y h:i:s');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">User Role Assign</h3>


                </div>
                <!-- /.card-header -->
                <div class="card-body">


                <form method="post" action="<?php echo base_url('portal/credit/add_payment'); ?>" name="upload_excel" enctype="multipart/form-data">
                        <div class="modal-body">


                            <div class="row">

                                <div class="form-group">
                                    <label>Select Invoice Number</label>
                                    <select class="form-control select2 select2" data-dropdown-css-class="select2"
                                        id="inv_no" name="inv_no" style="width: 100%;" onchange="loadCredits()">
                                        <option disabled selected="selected">Select Invoice Number</option>
                                        <?php $i = 0;

                                    foreach ($get_creditRemains as $row) {

                                        ?>
                                        <option value="<?php echo $row->credit_id; ?>">
                                            <?php echo $row->credit_invoice; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="user_note">Shop Name</label>
                                        <input type="text" class="form-control" id="shop_name" name="shop_name"
                                            placeholder="Shop Name" readonly>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="user_note">Date</label>
                                        <input type="text" class="form-control" id="date" name="date" placeholder="date"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button id="paybtn" onclick="show()" type="button" class="btn btn-success" data-dismiss="modal">Pay</button>
                        </div>

                </div>

            </div>


            <div class="modal-body" id="bottomsec" style="display: none;">


                    <div class="row">

                        <div class="col">

                            <div class="form-group">
                                <label for="user_eno">Date</label>
                                <input type="date" class="form-control" id="credit_date" name="credit_date"
                                    placeholder="Product Name">
                            </div>
                        </div>

                        <div class="col">


                            <div class="form-group">
                                <label>Select Lorry</label>
                                <select class="form-control select2 select2" data-dropdown-css-class="select2"
                                    id="emp_lorry" name="emp_lorry" style="width: 100%;" onchange="loadEmp()">
                                    <option disabled selected="selected">Select Lorry</option>
                                    <?php $i = 0;

                                foreach ($get_lorry as $get_lorrys) {

                                    ?>

                                    <option value="<?php echo $get_lorrys->lor_id; ?>">
                                        <?php echo $get_lorrys->lor_name; ?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="user_eno">Collector</label>
                                <select class="form-control select2 select2" data-dropdown-css-class="select2"
                                    id="credit_collect" name="credit_collect" style="width: 100%;">

                                </select>

                                <!-- <input type="text" class="form-control" id="credit_collect" name="credit_collect" placeholder="Product Name"> -->
                            </div>
                        </div>

                        <div class="col">                         
                            <div class="form-group">
                                <label for="user_note">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Amount" step="0.01">
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="credit_cid" name="credit_cid"
                            value="<?php echo $_SESSION['passed_user_national']; ?>">
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="addpay" name="addpay" class="btn btn-primary"
                      >Save changes</button>


                    </form>




        </div>



</div>
</div>

</div>

</section>

</div>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>


<script type="text/javascript">

    function loadCredits() {

        var shop_name = document.getElementById('shop_name');
        var date = document.getElementById('date');

        var inv_no = document.getElementById('inv_no').value;

        var url = '<?php echo base_url('portal/credit/retrieveCreditByID'); ?>';

        $.post(url, { inv_no: inv_no },
            function (data) {
                if (data != 'no') {

                    var obj = JSON.parse(data);

                    var i = 0;
                    $.each(obj, function (key, value) {

                        shop_name.value = obj[0]["credit_shop"];
                        date.value = obj[0]["credit_date"];

                        // $('#credit_id').append('<option value="'+obj[i]["credit_id"]+'">'+obj[i]["credit_id"]+ " - " +obj[i]["credit_shop"]+'</option>');
                        // i++;
                    })

                }
                else if (data == 'no') {
                    console.log("NOT SAVED");
                }
            });

    }

         function show(){


            var inv_no = document.getElementById("inv_no");
            inv_no.disable = true;

            var x = document.getElementById("bottomsec");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }


        }

        

           
        function loadEmp(){


var emp_lorry = document.getElementById('emp_lorry').value;

var credit_collect = document.getElementById('credit_collect');


// console.log(emp_lorry);                                

var url = '<?php echo base_url('portal/credit/retrievesEmp'); ?>';

        $.post(url, { emp_lorry:emp_lorry },
            function (data){
            if(data!='no'){

                var obj = JSON.parse(data); 
                                                                
                //alert(obj[0]["emp_name"]);

                $('#credit_collect').empty();
                var i = 0;
                $.each(obj,function(key,value){
                    $('#credit_collect').append('<option value="'+obj[i]["emp_id"]+'">'+(obj[i]["emp_role_id"]==1 ? "Sales Rep" : "Collector")+ " - " +obj[i]["emp_name"]+'</option>');
                    i++;
                })
        
            }
        else if(data=='no'){
        console.log("NOT SAVED");
            }
            });

                }


</script>