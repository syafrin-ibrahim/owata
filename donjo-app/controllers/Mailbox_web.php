<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox_web extends Web_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mailbox_model');
		$this->load->model('mandiri_model');
		$this->load->model('config_model');

		if (!isset($_SESSION['mandiri'])) {
			redirect('first');
		}
	}

	public function index()
	{
		redirect('first/mandiri/1/3');
	}

	public function form()
	{
		if (!empty($subjek = $this->input->post('subjek'))) {
			$data['subjek'] = $subjek;
		}
		$data['desa'] = $this->config_model->get_data();
		$data['individu'] = $this->mandiri_model->get_pendaftar_mandiri($_SESSION['nik']);
		$data['form_action'] = site_url("mailbox_web/kirim_pesan");
		$data['views_partial_layout'] = "web/mandiri/mailbox_form";

		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	public function kirim_pesan()
	{
		$post = $this->input->post();
		$individu = $this->mandiri_model->get_pendaftar_mandiri($_SESSION['nik']);
		$post['email'] = $individu['nik'];
		$post['owner'] = $individu['nama'];
		$post['tipe'] = 1;
		$post['status'] = 2;
		$this->mailbox_model->insert($post);
		redirect('first/mandiri/1/3/2');
	}

	public function baca_pesan($kat = 1, $id)
	{
		$nik = $this->session->userdata('nik');
		if ($kat == 1) {
			$this->mailbox_model->ubah_status_pesan($nik, $id, 1);
		}

		$data['kat'] = $kat;
		$data['owner'] = $kat == 1 ? 'Penerima' : 'Pengirim';
		$data['pesan'] = $this->mailbox_model->get_pesan($nik, $id);
		$data['tipe_mailbox'] = $this->mailbox_model->get_kat_nama($kat);
		$data['views_partial_layout'] = "web/mandiri/mailbox_detail";

		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	public function pesan_read($id = '')
	{
		$nik = $this->session->userdata('nik');
		$this->mailbox_model->ubah_status_pesan($nik, $id, 1);
		redirect("first/mandiri/1/3");
	}

	public function pesan_unread($id = '')
	{
		$nik = $this->session->userdata('nik');
		$this->mailbox_model->ubah_status_pesan($nik, $id, 2);
		redirect("first/mandiri/1/3");
	}
}
