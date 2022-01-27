<?php
class Home extends CI_Controller {

        function __construct()
        {
		parent::__construct();
		

            if($this->session->userdata('admin')){
		
		    }
		    else if ($this->session->userdata('admin22')){
			
		    }

		    else if ($this->session->userdata('bm33')){
			
			}
			else if ($this->session->userdata('pm44')){
			
			}
			else if ($this->session->userdata('pc55')){
			
			}
			else if ($this->session->userdata('or66')){
			
			}
			else if ($this->session->userdata('or77')){
			
			}
			else if ($this->session->userdata('or88')){
			
			}
		    else{
			redirect('dashboard/logout');
		    }
                        

        } 




        public function index($page = 'home')
        { 


		$sidebar="";

                if ( ! file_exists(APPPATH.'views/pages/dashboard/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }
		

		if ($this->session->userdata('admin')) {
			$sidebar="sadmin";
		}
		if ($this->session->userdata('admin22')) {
			$sidebar="admin22";
		}
		if ($this->session->userdata('bm33')) {
			$sidebar="bookingmanager33";
		}
		if ($this->session->userdata('pm44')) {
			$sidebar="propertymanager44";
		}
		if ($this->session->userdata('pc55')) {
			$sidebar="propertycashier55";
		}
		if ($this->session->userdata('or66')) {
			$sidebar="otherrole66";
		}
		if ($this->session->userdata('or77')) {
			$sidebar="otherrole77";
		}
		if ($this->session->userdata('or88')) {
			$sidebar="otherrole88";
		}
		

       


        
		$this->load->view('templates/header');
		
			

		$this->load->view('templates/sidebar/'.$sidebar);
		
                $this->load->view('pages/dashboard/home');
		$this->load->view('templates/footer');
		$this->load->view('templates/homejs');






	}
	




	public function retrive_profile_data(){

		$this->load->model('users');
		if($this->users->retrive_profile_data()){ 
	
		}
	
	    }



   
        
}
