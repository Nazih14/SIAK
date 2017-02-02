 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('User_model'));
        $this->load->helper(array('string', 'form'));
    }

    public function index() {
        $this->output->set_content_type('application/json')->set_output(json_encode(array('Message' => 'Nothing Here')));
    }

    public function login() {
        $this->load->library('form_validation');
        $params['success'] = 0;
        $params['message'] = 'Authentication Failed'; 
        $this->form_validation->set_rules('UserId', 'ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('UserPassword', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            $data['login'] = $this->input->post('UserId');
            $data['password'] = $this->input->post('UserPassword');


            $ret = $this->User_model->get($data);

            if (!empty($ret)) {
                $arr_res = array(
                      'id' => $ret['MhswID'],
                    'name' => $ret['Nama'],
                    'foto' => $ret['Foto'],
                    'pob' => $ret['TempatLahir'],
                    'dob' => $ret['TanggalLahir'],
                    'status' => $ret['StatusMhswID'],
                    'program' => $ret['ProgramID'],
                    'prodi' => $ret['ProdiID'],
                    'agama' => $ret['agama_nama'],
                    'email' => $ret['Email'],
                    'angkatan' => $ret['TahunID'],
                    'batasstudi' => $ret['BatasStudi'],
                    'pembimbing' => $ret['dosen_nama'],
                    'phone' => $ret['Handphone'],
                    'alamat' => $ret['Alamat'],
                    'rt' => $ret['RT'],
                    'rw' => $ret['RW'],
                    'pos' => $ret['KodePos'],
                    'propinsi' => $ret['Propinsi'],
                    'kota' => $ret['Kota'],
                    'kelamin' => $ret['kelamin_nama'],
                    'statusid' => $ret['StatusAwalID'],
                    'ayah' => $ret['NamaAyah'],
                    'ibu' => $ret['NamaIbu'],
                    'hp' => $ret['HandphoneOrtu'],
                );

                $params['success'] = 1;
                $params['message'] = '';
                $params['data'] = $arr_res;
            } else {
                $params['message'] = 'Username or password incorrect';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

    public function logout() {
        $params['success'] = 0;
        $params['message'] = 'Failed';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            $data['id'] = $this->input->post('id', TRUE);
            $data['name'] = $this->input->post('name', TRUE);
            $data['email'] = $this->input->post('email', TRUE);

            $ret = $this->User_model->get($data);

            if (count($user) > 0) {
                $params['success'] = 1;
                $params['message'] = '';
            } else {
                $params['success'] = 1;
                $params['message'] = 'You are not logged in';
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

}

/* End of file Auth.php */
/* Location: .//Applications/MAMP/htdocs/asiweb/apiapp/controllers/Auth.php */