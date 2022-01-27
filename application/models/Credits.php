<?php
class Credits extends CI_Model
{

    public function retrieveEmp()
    {
        return $this->db->get('employers')->result();
    }


    
    public function retrieveCredit()
    {
        return $this->db->select('*')->from('credit')
        ->join('lorry', 'lorry.lor_id = credit.credit_lorry')
        ->join('employers', 'employers.emp_id = credit.credit_collect')->get()->result();
    }

    
    public function get_lorrysalesEmp()
    {
        $arr['emp_role_id'] = EMP_ROLE_SALES_REP;
        return $this->db->get_where('employers', $arr)->result();
    }

    public function get_lorrycollectorEmp()
    {
        $arr['emp_role_id'] = EMP_ROLE_COLLECTORS;
        return $this->db->get_where('employers', $arr)->result();
    }

    
    function load_emp($emp_lorry){

		$d_array = array();

        $arr = array(
            'emp_lorry' => $emp_lorry,            
        );
		
		$this->db->select('*')->from('employers')->where($arr);

		$queryEE = $this->db->get()->result();
	
        return $queryEE;

		// if ($queryEE->num_rows() > 0) {
	
		// 	$d_array[0]= $queryEE->row()->emp_id;
		// 	$d_array[1]= $queryEE->row()->emp_role_id;		
		// 	$d_array[2]= $queryEE->row()->emp_name;
		
		// 	return $d_array;
               

        // 	}
		// 	else{
	
		// 	 return "no";
			
		// 	}
	
	
	 }

     
    function load_collectors($emp_lorry){

		$d_array = array();

        $arr = array(
            'emp_lorry' => $emp_lorry,
            'emp_role_id' => EMP_ROLE_COLLECTORS,
        );
		
		$this->db->select('*')->from('employers')->where($arr);
		$queryEE = $this->db->get();
	
		if ($queryEE->num_rows() > 0) {
	
			$d_array[0]= $queryEE->row()->emp_id;
			$d_array[1]= $queryEE->row()->emp_role_id;		
			$d_array[2]= $queryEE->row()->emp_name;
		
			return $d_array;
        	}
			else{
	
			 return "no";
			
			}
	
	 }


     public function check_if_not_exists($arr)
     {

        //  if($this->db->get_where('credit', $arr)->result()){
        //         return true;
        //      }else{
        //          return false;
        //      }   

       return $this->db->get_where('credit', $arr)->result();
                 }


     
    public function uploadExcel(){

        if(isset($_POST["Import"])){
		

            echo $filename=$_FILES["file"]["tmp_name"];
            
    
             if($_FILES["file"]["size"] > 0)
             {

                
                $credit_date = "";
                $emp_lorry = "";
                $credit_collect = "";
                $emp_cid = "";

                    $credit_date = $this->input->post('credit_date');
                    $emp_lorry = $this->input->post('emp_lorry');
                    $credit_collect = $this->input->post('credit_collect');
                    $emp_cid = $this->session->userdata('passed_user_national');
    
                  $file = fopen($filename, "r");
                  $i=0;
                  while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
                  {  

                    if($i == 0){

                    }
                    else{
                         
                    $invoiceNo = $emapData[0];
                    $shopName = $emapData[1];
                    $creditAmount = $emapData[2];

                    $insert_to_exceldb = array(

                        'credit_lorry' => $emp_lorry,
                        'credit_collect' => $credit_collect,
                        'credit_date' => $credit_date,
                        'credit_cid' => $emp_cid,
                        'credit_invoice' => $invoiceNo,
                        'credit_shop' => $shopName,
                        'credit_amount' => $creditAmount,
                    );


                    $this->db->insert('credit', $insert_to_exceldb);

                    // $temp = $this->check_if_not_exists($insert_to_exceldb);

                    // if($temp){
                      
                    // }else{
                    //     $this->db->insert('credit', $insert_to_exceldb);
                    // }

                    // $this->db->insert('credit', $insert_to_exceldb)->where("credits NOT IN(".$this->db->get_where('credit', $insert_to_exceldb)->row().")", FALSE);

                    
                        
                    }
                   
                    $i++;

                 }
                 fclose($file);
                 return true;
                
             }
        }	 

    }

}
