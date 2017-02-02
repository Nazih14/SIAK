<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * user Model Class
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
            $this->db->where('MhswID', $params['id']);
        }

        if (isset($params['login'])) {
            $this->db->where('mhsw.Login', $params['login']);
        }

        if (isset($params['password'])) {
            $this->db->where('mhsw.Password', $params['password']);
        }

        if (isset($params['name'])) {
            $this->db->where('mhsw.Nama', $params['name']);
        }

        if (isset($params['email'])) {
            $this->db->where('mhsw.Email', $params['email']);
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

        $this->db->select('program.Nama as program_nama,
                            dosen.Nama as dosen_nama,
                            agama.Nama as agama_nama, 
                            kelamin.Nama as kelamin_nama, 
                            statussipil.Nama as statussipil_nama, 
                            statusmhsw.Nama as status_mhsw,
                            mhsw.Kota, mhsw.Propinsi, mhsw.Foto,
                            mhsw.KodePos, mhsw.Login, mhsw.Email,
                            mhsw.Alamat, mhsw.Nama, mhsw.Handphone, mhsw.MhswID,
                            mhsw.TempatLahir, mhsw.TanggalLahir, mhsw.StatusMhswID,
                            mhsw.ProgramID, mhsw.ProdiID, mhsw.TahunID, mhsw.BatasStudi,
                            mhsw.RT, mhsw.RW, mhsw.StatusAwalID, mhsw.NamaIbu, mhsw.NamaAyah,
                            mhsw.HandphoneOrtu'
                            );
        $this->db->join('program', 'mhsw.ProgramID = program.ProgramID', 'left');
        $this->db->join('agama', 'mhsw.Agama = agama.Agama', 'left');
        $this->db->join('kelamin', 'mhsw.Kelamin = kelamin.Kelamin', 'left');
        $this->db->join('statussipil', 'mhsw.StatusSipil = statussipil.StatusSipil', 'left');
        $this->db->join('statusmhsw', 'mhsw.StatusMhswID = statusmhsw.StatusMhswID', 'left');
        $this->db->join('dosen', 'mhsw.PenasehatAkademik = dosen.Login', 'left');

        $res = $this->db->get('mhsw');
        if (isset($params['id']) OR isset($params['login'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

}
