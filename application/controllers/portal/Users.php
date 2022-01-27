<?php
class Users extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin')) { } else if ($this->session->userdata('admin22')) { } else if ($this->session->userdata('bm33')) { } else if ($this->session->userdata('pm44')) { } else if ($this->session->userdata('pc55')) { } else if ($this->session->userdata('or66')) { } else if ($this->session->userdata('or77')) { } else if ($this->session->userdata('or88')) { } else {
			redirect('dashboard/logout');
		}

	
	}




	public function account($page = 'home')
	{
		if (!file_exists(APPPATH . 'views/pages/dashboard/usermanagement/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		if ($this->session->userdata('admin')) {
			$sidebar = "sadmin";
		}
		if ($this->session->userdata('admin22')) {
			$sidebar = "admin22";
		}
		

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar/' . $sidebar);
		$this->load->view('pages/dashboard/usermanagement/' . $page);
		$this->load->view('templates/footer');
		$this->load->view('templates/formpages/formjs');
	}

	public function role($page = 'home')
	{
		if (!file_exists(APPPATH . 'views/pages/dashboard/usermanagement/role/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		if ($this->session->userdata('admin')) {
			$sidebar = "sadmin";
		}
		if ($this->session->userdata('admin22')) {
			$sidebar = "admin22";
		}
		

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar/' . $sidebar);
		$this->load->view('pages/dashboard/usermanagement/role/' . $page);
		$this->load->view('templates/footer');
		$this->load->view('templates/formpages/formjs');
	}

	public function retrive_profile_data()
	{

		$this->load->model('users');
		if ($this->users->retrive_profile_data()) { }
	}

	function newuserinsert()

	{

		if (isset($_POST['addnew_user'])) {

			$this->load->model('adduser');
			$check = $this->adduser->user_nic_verifi();

			if ($check) {
				if ($this->adduser->new_user_insert()) {

					// set flash data
					$this->session->set_flashdata('success', 'New User Added Successfully');
					redirect('portal/users/account/addnew');
				}
			} else {

				// set flash data
				$this->session->set_flashdata('warning', 'Already User in This NIC');
				redirect('portal/users/account/addnew');
			}
		}
	}


	function newroleinsert()

	{

		if (isset($_POST['addnew_role'])) {

			$this->load->model('adduser');


			if ($this->adduser->new_role_insert()) {

				// set flash data
				$this->session->set_flashdata('success', 'New Role Added Successfully');
				redirect('portal/users/role/addrole');
			}
		}
	}

	function useredit()

	{

		if (isset($_POST['edit_user'])) {

			$this->load->model('adduser');


			if ($this->adduser->edituser()) {

				// set flash data
				$this->session->set_flashdata('success', 'User Details Edited Successfully');
				redirect('portal/users/account/edituser');
			} else {

				$this->session->set_flashdata('error', ' Error Occur When Editing Please Try Again');
				redirect('portal/users/account/edituser');
			}
		}
	}



	function userroleedit()

	{

		if (isset($_POST['edit_user'])) {

			$this->load->model('adduser');


			if ($this->adduser->edituserrole()) {

				// set flash data
				$this->session->set_flashdata('msg_user', 'New User Added Successfully');
				redirect('portal/users/account/edituser');
			}
		}
	}



	function assignrole()

	{

		if (isset($_POST['assign_role'])) {

			$this->load->model('adduser');


			if ($this->adduser->assignrole()) {

				// set flash data
				$this->session->set_flashdata('success', 'New Role Assigned Successfully');
				redirect('portal/users/role/assign');
			} else {
				$this->session->set_flashdata('error', 'Error Occured in Role Assign Please Try Again');
				redirect('portal/users/role/assign');
			}
		}
	}
	function assignproperty()

	{

		if (isset($_POST['assign_role'])) {

			$this->load->model('adduser');
			// $assign=$this->adduser->verifyassign();
			if ($this->adduser->verifyassign()) {
				$this->session->set_flashdata('error', 'Property Already Assigned to this User');
				redirect('portal/users/role/assignproperty');
			} else {
				if ($this->adduser->assignproperty()) {

					// set flash data
					$this->session->set_flashdata('success', 'Property Successfully Assigned');
					redirect('portal/users/role/assignproperty');
				}
			}
		}
	}

	function deleteuser()

	{

		if (isset($_POST['delete_user'])) {

			$this->load->model('adduser');


			if ($this->adduser->deleteuser()) {

				// set flash data
				$this->session->set_flashdata('success', 'User Account Deleted Successfully');
				redirect('portal/users/account/deleteuser');
			} else {

				$this->session->set_flashdata('error', 'User Account Delete Failed. Please Try Again');
				redirect('portal/users/account/deleteuser');
			}
		}
	}


	function changeuserpassword()

	{

		if (isset($_POST['change_password'])) {

			$this->load->model('adduser');


			if ($this->adduser->changepassword()) {

				// set flash data
				$this->session->set_flashdata('success', 'User Password Changed Successfully');
				redirect('portal/users/account/changeuserpassword');
			} else {

				$this->session->set_flashdata('error', 'User Password Change Failed. Please Try Again');
				redirect('portal/users/account/changeuserpassword');
			}
		}
	}

	function assignupdate()

	{

		if (isset($_POST['assign_role'])) {

			$this->load->model('adduser');


			if ($this->adduser->updateassign()) {

				// set flash data
				$this->session->set_flashdata('success', 'User Assigned to a New Property Successfully');
				redirect('portal/users/role/editassignedproperty');
			}
		}
	}


	public function load_table()
	{
		$this->load->model('adduser');

		$this->adduser->getUsers();
	}
	public function load_user()
	{

		if (isset($_POST['get_user_list'])) {

			$selected_userr_nic = $_POST['get_user_list'];

			$temp_array = array();
			$this->load->model('adduser');
			$temp_array =  $this->adduser->load_user_from_db($selected_userr_nic);


			echo json_encode(array("msg" => $temp_array));
		} else {
			echo 'no';
		}
	}
	public function load_role()
	{

		if (isset($_POST['get_user_role'])) {

			$selected_userr_nic = $_POST['get_user_role'];

			$temp_array = array();
			$this->load->model('adduser');
			$temp_array =  $this->adduser->load_role_from_db($selected_userr_nic);


			echo json_encode(array("msg" => $temp_array));
		} else {
			echo 'no';
		}
	}

	public function load_role1()
	{

		if (isset($_POST['get_user'])) {

			$selected_userr_nic = $_POST['get_user'];

			$temp_array = array();
			$this->load->model('adduser');
			$temp_array =  $this->adduser->load_role_from_db1($selected_userr_nic);


			echo json_encode(array("msg" => $temp_array));
		} else {
			echo 'no';
		}
	}

	function deleteuserrole()

	{

		if (isset($_POST['delete_userrole'])) {

			$this->load->model('adduser');


			if ($this->adduser->deleteuserrole()) {

				// set flash data
				$this->session->set_flashdata('msg_user', 'New User Added Successfully');
				redirect('portal/users/role/delete');
			}
		}
	}




	public function more_user()
	{

		if (isset($_POST['get_user_list'])) {

			$selected_userr_nic = $_POST['get_user_list'];

			$temp_array = array();
			$this->load->model('adduser');
			$temp_array =  $this->adduser->more_user_details($selected_userr_nic);


			echo json_encode(array("msg" => $temp_array));
		} else {
			echo 'no';
		}
	}
}
