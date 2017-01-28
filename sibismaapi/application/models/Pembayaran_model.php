<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Pembayaran Model Class
 *
 * @package     SISBAM
 * @subpackage  Models
 * @category    Models
 * @author      bopas
 */
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('BayarMhswID', $params['id']);
        }

        if (isset($params['MhswID'])) {
            $this->db->where('MhswID', $params['MhswID']);
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
            $this->db->order_by('BayarMhswID', 'desc');
        }

        $this->db->select('BayarMhswID,
                             TahunID,
                             MhswID, 
                             Bank, 
                             BuktiSetoran,
                             Tanggal,
                             Keterangan,
                             Jumlah,
                             TahunID');

        $res = $this->db->get('bayarmhsw');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

}
