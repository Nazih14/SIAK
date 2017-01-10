<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * user Model Class
 *
 * @package     SISBAM
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('MhswID', $params['id']);
        }

        if (isset($params['password'])) {
            $this->db->where('Password', $params['password']);
        }

        if (isset($params['name'])) {
            $this->db->where('Nama', $params['name']);
        }

        if (isset($params['email'])) {
            $this->db->where('Email', $params['email']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('MhswID', 'desc');
        }

        $this->db->select('MhswID,
                             Nama,
                             Email, 
                             Alamat, 
                             RT,
                             RW,
                             KodePos,
                             Propinsi,
                             BatasStudi, 
                             TahunID, 
                             ProgramID,
                             ProdiID,
                             TempatLahir, 
                             TanggalLahir, 
                             StatusAwalID,
                             StatusMhswID, 
                             BatasStudi,
                             Foto, 
                             PenasehatAkademik, 
                             Agama, 
                             Handphone,
                             Kota,
                             Kelamin,
                             NamaAyah,
                             NamaIbu,
                             HandphoneOrtu');

        $res = $this->db->get('mhsw');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

}
