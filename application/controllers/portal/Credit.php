<?php
class Credit extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin')) {
		} else if ($this->session->userdata('admin22')) {
		} else if ($this->session->userdata('bm33')) {
		} else if ($this->session->userdata('pm44')) {
		} else if ($this->session->userdata('pc55')) {
		} else if ($this->session->userdata('or66')) {
		} else if ($this->session->userdata('or77')) {
		} else if ($this->session->userdata('or88')) {
		} else {
			redirect('dashboard/logout');
		}

		$this->load->model('import_model', 'import');
	}




	public function action($page = 'home')
	{
		//$myVar['result'] = $this->session->flashdata('result');
		//$myVar['viewr'] = $this->session->flashdata('viewr');

		$this->load->model('setups');		
		$data['get_lorry'] = $this->setups->get_lorry();

		$this->load->model('credits');
		$data['get_credit'] = $this->credits->retrieveCredit();
		$data['get_creditRemains'] = $this->credits->retrieveCreditRemains();
		
		if ($this->session->userdata('admin')) {
			$sidebar = "sadmin";
		}
		if ($this->session->userdata('admin22')) {
			$sidebar = "admin22";
		}
		if ($this->session->userdata('bm33')) {
			$sidebar = "bookingmanager33";
		}
		if ($this->session->userdata('pm44')) {
			$sidebar = "propertymanager44";
		}
		if ($this->session->userdata('pc55')) {
			$sidebar = "propertycashier55";
		}
		if ($this->session->userdata('or66')) {
			$sidebar = "otherrole66";
		}
		if ($this->session->userdata('or77')) {
			$sidebar = "otherrole77";
		}
		if ($this->session->userdata('or88')) {
			$sidebar = "otherrole88";
		}


		$this->load->view('templates/header');
		$this->load->view('templates/sidebar/' . $sidebar);
		// $this->load->view('credit/' . $page);
		$this->load->view('credit/' . $page, $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/formpages/formjs');
	}

	public function importFile()
	{
		if ($this->input->post('submit')) {

			$path = 'uploads/';
			require_once APPPATH . "/third_party/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			if (empty($error)) {
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				} else {
					$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;

				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i = 0;
					foreach ($allDataInSheet as $value) {
						if ($flag) {
							$flag = false;
							continue;
						}
						$inserdata[$i]['org_name'] = $value['A'];
						$inserdata[$i]['org_code'] = $value['B'];
						$inserdata[$i]['gst_no'] = $value['C'];
						$inserdata[$i]['org_type'] = $value['D'];
						$inserdata[$i]['Address'] = $value['E'];
						$i++;
					}
					$result = $this->import->importdata($inserdata);
					if ($result) {
						echo "Imported successfully";
					} else {
						echo "ERROR !";
					}
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
				}
			} else {
				echo $error['error'];
			}
		}
	}



	public function retrievesEmp(){

		
		if (isset($_POST['emp_lorry'])) {

			$selected_emp_lorry = $_POST['emp_lorry'];

			$temp_array = array();
			$this->load->model('credits');

			$temp_array =  $this->credits->load_emp($selected_emp_lorry);


			echo json_encode($temp_array, JSON_FORCE_OBJECT);

			//echo json_encode(array("msg" => $temp_array));

		} else {
			echo 'no';
		}

	}

	public function retrieveCreditByID(){
	
		if (isset($_POST['inv_no'])) {

			$this->load->model('credits');
			$temp_array =  $this->credits->load_credit_by_ID();
			echo json_encode($temp_array, JSON_FORCE_OBJECT);

		} else {
			echo 'no';
		}

		
	}


	public function uploadExcel(){

        $this->load->model('credits');
       
        if ($this->credits->uploadExcel()) {
            // set flash data
            $this->session->set_flashdata('success', 'Upload Successfully');
            redirect('portal/credit/action/add_credit');
        }


    }



	

    public function add_payment()
    {

        if (isset($_POST['addpay'])) {

            $this->load->model('credits');

            if ($this->credits->add_payment() == true) {
                // set flash data
                $this->session->set_flashdata('success', 'Paid Successfully');
                redirect('portal/credit/action/credit_remain');
            } else {
				$this->session->set_flashdata('error', 'Please check amount again');
                redirect('portal/credit/action/credit_remain');
			}

        }
    }



}
