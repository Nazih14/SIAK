<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bipot extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Bipot_model'));
        $this->load->helper(array('string', 'form'));
    }

    public function index() {
        $this->output->set_content_type('application/json')->set_output(json_encode(array('Message' => 'Nothing Here')));
    }

    public function detail() {
        $params['success'] = 0;
        $ret = $this->Bipot_model->get(array('MhswID' => $this->input->post('MhswID'), 'TahunID' =>  $this->input->post('tahun')));

        $params['success'] = 1;
        $params['data'] = $ret;

        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

    public function group() {
        $this->load->library('form_validation');
        $params['success'] = 0;
        $ret = $this->Bipot_model->get(array('MhswID' => $this->input->post('MhswID'), 'gTahun' => true));

        $params['success'] = 1;
        $params['data'] = $ret;

        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

}

/* End of file Auth.php */
/* Location: .//Applications/MAMP/htdocs/asiweb/apiapp/controllers/Auth.php */



