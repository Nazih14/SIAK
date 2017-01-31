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
class Bipot_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('BipotMhswID', $params['id']);
        }

        if (isset($params['MhswID'])) {
            $this->db->where('MhswID', $params['MhswID']);
        }

        if (isset($params['TahunID'])) {
            $this->db->where('TahunID', $params['TahunID']);
        }

        if (isset($params['gTahun'])) {
            $this->db->group_by('TahunID', $params['gTahun']);
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
            $this->db->order_by('BipotMhswID', 'desc');
        }

        $this->db->select('BipotMhswID,
                             MhswID, 
                             bipotmhsw.Catatan,
                             Dibayar,
                             Besar,
                             Jumlah,
                             TahunID');

        $this->db->select('bipotnama.Nama');

        $this->db->join('bipotnama', 'bipotnama.BIPOTNamaID = bipotmhsw.BIPOTNamaID', 'left');

        $res = $this->db->get('bipotmhsw');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

}
