<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_Cuti extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_cuti');
        $this->load->model('m_user');
        $this->load->model('m_jenis_kelamin');
    }

    public function view_pegawai()
    {
        if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {

            $data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
            $data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
            $data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
            $this->load->view('pegawai/form_pengajuan_cuti', $data);
        } else {

            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function proses_cuti()
    {
        if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {

            $id_user = $this->input->post("id_user");
            $alasan = $this->input->post("alasan");
            $perihal_cuti = $this->input->post("perihal_cuti");
            $hari_cuti = $this->input->post("hari_cuti");
			$tgl_diajukan = date('Y-m-d');
			$jumlah_hari = intval($hari_cuti);
			
			$tanggal_mulai = new DateTime($tgl_diajukan);
			$tanggal_berakhir = clone $tanggal_mulai;
			$tanggal_berakhir->modify("+".($jumlah_hari + 1)." days");
			// $tanggal_berakhir->modify("+{$jumlah_hari} days");
			// $tanggal_berakhir->modify("+1 day");
			
            // $berakhir = $this->input->post("berakhir");
			$berakhir = $tanggal_berakhir->format('Y-m-d');
			
            $id_cuti = md5($id_user . $alasan . $tgl_diajukan);
            $id_status_cuti = 1;

            $hasil = $this->m_cuti->insert_data_cuti('cuti-' . substr($id_cuti, 0, 5), $id_user, $alasan, $hari_cuti, $berakhir, $id_status_cuti, $perihal_cuti);

            if ($hasil == false) {
                $this->session->set_flashdata('eror_input', 'eror_input');
            } else {
                $this->session->set_flashdata('input', 'input');
            }
            redirect('Form_Cuti/view_pegawai');
        } else {

            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
}
