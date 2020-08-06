<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_inventaris extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('header_model');
		$this->load->model('inventaris_laporan_model');
		$this->load->model('referensi_model');
		$this->load->model('config_model');
		$this->load->model('surat_model');
		$this->modul_ini = 15;
		$this->sub_modul_ini = 61;
		$this->tab_ini = 7;
	}

	public function index()
	{
		$data['pamong'] = $this->surat_model->list_pamong();
		$header = $this->header_model->get_data();

		$data = array_merge($data, $this->inventaris_laporan_model->laporan_inventaris());
		$data['tip'] = 1;
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('inventaris/laporan/table', $data);
		$this->load->view('footer');
	}

	public function cetak($tahun, $penandatangan)
	{
		$data['header'] = $this->config_model->get_data();
		$data['tahun'] = $tahun;
		$data['pamong'] = $this->inventaris_laporan_model->pamong($penandatangan);
		$data = array_merge($data, $this->inventaris_laporan_model->cetak_inventaris($tahun));
		$this->load->view('inventaris/laporan/inventaris_print', $data);
	}

	public function download($tahun, $penandatangan)
	{
		$data['header'] = $this->config_model->get_data();
		$data['tahun'] = $tahun;
		$data['pamong'] = $this->inventaris_laporan_model->pamong($penandatangan);
		$data = array_merge($data, $this->inventaris_laporan_model->cetak_inventaris($tahun));
		$this->load->view('inventaris/laporan/inventaris_excel', $data);
	}

	public function mutasi()
	{
		$data['pamong'] = $this->surat_model->list_pamong();
		$header = $this->header_model->get_data();
		$data['tip'] = 2;
		$header['minsidebar'] = 1;
		$data = array_merge($data, $this->inventaris_laporan_model->mutasi_laporan_inventaris());

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('inventaris/laporan/table_mutasi', $data);
		$this->load->view('footer');
	}

	public function cetak_mutasi($tahun, $penandatangan)
	{
		$data['header'] = $this->config_model->get_data();
		$data['tahun'] = $tahun;
		$data['pamong'] = $this->inventaris_laporan_model->pamong($penandatangan);
		$data = array_merge($data, $this->inventaris_laporan_model->mutasi_cetak_inventaris($tahun));
		$this->load->view('inventaris/laporan/inventaris_print_mutasi', $data);
	}

	public function download_mutasi($tahun, $penandatangan)
	{
		$data['header'] = $this->config_model->get_data();
		$data['tahun'] = $tahun;
		$data['pamong'] = $this->inventaris_laporan_model->pamong($penandatangan);
		$data = array_merge($data, $this->inventaris_laporan_model->mutasi_cetak_inventaris($tahun));
		$this->load->view('inventaris/laporan/inventaris_excel_mutasi', $data);
	}
}