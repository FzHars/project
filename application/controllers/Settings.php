<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}

	public function view_super_admin()
	{
		$this->load->view('super_admin/settings');
	}

	public function view_admin()
	{
		$data['admin_data'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->result_array();
		$this->load->view('admin/settings', $data);
	}

	public function view_pegawai()
	{
		$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
		$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();

		$jenis_kelamin_map = [];
		foreach ($data['jenis_kelamin'] as $jk) {
			$jenis_kelamin_map[$jk['id_jenis_kelamin']] = $jk['jenis_kelamin'];
		}

		// Menambahkan data jenis_kelamin ke dalam data pegawai
		foreach ($data['pegawai_data'] as &$pegawai) {
			$pegawai['jenis_kelamin'] = $jenis_kelamin_map[$pegawai['id_jenis_kelamin']];
		}

		$this->load->view('pegawai/settings', $data);
	}

	public function edit_admin()
	{
		$id_user = $this->input->post("id_user");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$email = $this->input->post("email");
		$id_user_level = 2;

		$hasil = $this->m_user->update_user_admin($id_user, $username, $email, $password, $id_user_level);

		if ($hasil == false) {
			$this->session->set_flashdata('eror', 'eror');
			redirect('Settings/view_admin');
		} else {
			$this->session->set_flashdata('input', 'input');
			redirect('Settings/view_admin');
		}
	}
	public function lengkapi_data()
	{
		$id = $this->input->post("id");
		$nama_lengkap = $this->input->post("nama_lengkap");
		$no_telp = $this->input->post("no_telp");
		$alamat = $this->input->post("alamat");
		$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
		$nip = $this->input->post("nip");
		$pangkat = $this->input->post("pangkat");
		$jabatan = $this->input->post("jabatan");



		$hasil = $this->m_user->update_user_detail($id, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $nip, $pangkat, $jabatan);

		if ($hasil == false) {
			$this->session->set_flashdata('eror', 'eror');
			redirect('Settings/view_pegawai');
		} else {
			$this->session->set_flashdata('input', 'input');
			redirect('Settings/view_pegawai');
		}
	}


	public function settings_account_super_admin()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if ($password == $re_password) {
			$hasil = $this->m_user->update_user($id, $username, $password);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_edit', 'eror_edit');
				redirect('Settings/view_super_admin');
			} else {
				$this->session->set_flashdata('edit', 'edit');
				redirect('Settings/view_super_admin');
			}
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_super_admin');
		}
	}

	public function settings_account_admin()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if ($password == $re_password) {
			$hasil = $this->m_user->update_user($id, $username, $password);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_edit', 'eror_edit');
				redirect('Settings/view_admin');
			} else {
				$this->session->set_flashdata('edit', 'edit');
				redirect('Settings/view_admin');
			}
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_admin');
		}
	}

	public function settings_account_pegawai()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if ($password == $re_password) {
			$hasil = $this->m_user->update_user($id, $username, $password);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_edit', 'eror_edit');
				redirect('Settings/view_pegawai');
			} else {
				$this->session->set_flashdata('edit', 'edit');
				redirect('Settings/view_pegawai');
			}
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_pegawai');
		}
	}
}
