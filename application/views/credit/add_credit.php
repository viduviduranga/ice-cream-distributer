<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Credit List
                    </h1>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="#">Home</a></li><li class="breadcrumb-item active">DataTables</li></ol> -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <?php
    date_default_timezone_set("Asia/Colombo");
    // Return current date from the remote server
    $date = date('d-m-y h:i:s');

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->



                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title">DataTable with default features</h3> -->
                            <div align="right">
                                

                                <a class="btn btn-primary" href="<?php echo base_url(); ?>portal/credit/action/add_credit_process" class="nav-link">
                                Add New Credit
                                </a>

                            </div>

                          
                            


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Lorry</th>
                                        <th>Invoice No</th>
                                        <th>Employee</th>
                                        <th>Shop Name </th>
                                        <!-- <th>Paid </th>
                                        <th>Remining</th> -->
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;
                                            foreach ($get_credit as $get_credits) {
                                            ?> 
                                    <tr>
                                       
                                            <td> <?php echo $i; ?></td>
                                            <td> <?php echo $get_credits->credit_date; ?></td>
                                            <td><?php echo $get_credits->lor_name; ?></td>
                                            <td><?php echo $get_credits->credit_invoice; ?></td>
                                            <td> <?php echo $get_credits->emp_name; ?></td>
                                            <td><?php echo $get_credits->credit_shop; ?></td>                                            
                                           
                                    </tr>
                                   <?php
                                             $i++;
                                            }


                                            ?> 

                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>#</th>
                                        <th>Date</th>
                                        <th>Lorry</th>
                                        <th>Invoice No</th>
                                        <th>Employee</th>
                                        <th>Shop Name </th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Credit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo base_url('portal/credit/importFile'); ?>" enctype="multipart/form-data">
                  
                    <div class="modal-body">

                        <div class="row">

                            <div class="form-group">
                                <label for="user_eno">Date</label>
                                <input type="date" class="form-control" id="credit_date" name="credit_date" placeholder="Product Name">
                            </div>
                           
                            <div class="form-group">
                                <label for="user_eno">Lorry Number</label>
                                <input type="text" class="form-control" id="credit_lorry" name="credit_lorry" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <label for="user_eno">Collector</label>
                                <input type="text" class="form-control" id="credit_collect" name="credit_collect" placeholder="Product Name">
                            </div>
                           
                            <div class="form-group">
                                
                                <input type="hidden" class="form-control" id="credit_cid" name="credit_cid" value="<?php echo $_SESSION['passed_user_national']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_eno">Uploader</label>
                                <input type="file" class="form-control" t name="uploadFile"  accept=".xls, .xlsx" required>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="credit_add" id="credit_add"   class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>