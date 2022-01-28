<!-- Content Wrapper. Contains page content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View Credit Summary</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Credit Summary</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <?php
date_default_timezone_set("Asia/Colombo");
// Return current date from the remote server
$date = date('d-m-y h:i:s');



?>

<?php if(isset($_GET['credit_id'])){$select_id = $_GET['credit_id'];}else{$select_id = 0;}?>

<?php 


$credit_amount = 0;
$credit_shop = "";
foreach ($get_credit as $row) {
  if($row->credit_id== $select_id) {

    $credit_amount = $row->credit_amount;
    $credit_shop = $row->credit_shop;

  }  
}


?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default" id="summarycard">
        <div class="card-header">
          <h3 class="card-title">View Credit Summary</h3>

          <input class="btn btn-primary" style="float: right;" type="button" value="Print" onclick="printDiv()"> 

        </div>

        <script>
        function printDiv() {
            var divContents = document.getElementById("summarycard").innerHTML;
            window.print();
        }
    </script>


<div class="card text-center">
        <div class="card-header">Inovice Credit ID : <?php echo $_GET['credit_id']; ?></div>
        <div class="card-body">
        
        <ul class="list-group">
        <li class="list-group-item list-group-item-warning">Credit Amount : Rs. <?php echo $credit_amount; ?> </li>
        <li class="list-group-item list-group-item-success">Credit Shop  : <?php echo $credit_shop; ?></li>
    
      </ul>

        </div>
      </div>


        <!-- /.card-header -->
        <form method="post" action="<?php echo base_url('portal/setup/update_lorry'); ?>">
         
          <div class="card-body">
          
          
          <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>                                       
                                        <th>Employee Name</th>
                                        <th>Lorry Name</th>                                       
                                        <th>CP Amount</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;
                                    foreach ($retrieveCreditDetails as $row) {
if($row->cp_inv_id== $select_id){

                                    ?>
                                        <tr>

                                            <td> <?php echo $i; ?></td>
                                        
                                            <td><?php echo $row->cp_date; ?></td>
                                            <td><?php echo $row->emp_name; ?></td>
                                            <td><?php echo $row->lor_name; ?></td>
                                            <td><?php echo $row->cp_amount; ?></td>
                                                                                               

                                        </tr>
                                    <?php
                                        $i++;
                                      }   }


                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>#</th>
                                        <th>Date</th>                                       
                                        <th>Employee Name</th>
                                        <th>Lorry Name</th>                                       
                                        <th>CP Amount</th>
                                    </tr>
                                </tfoot>
                            </table>



            </div>

        </form>
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
     

      <!-- /.row -->
    </div>
    <!-- /.card-body -->

</div>
<!-- /.card -->
</div>
</section>
</div>
