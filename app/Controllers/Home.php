<?php namespace App\Controllers;

use App\Models\InformasiModel;
use Config\Services;

class Home extends BaseController
{
	protected $M_informasi;
	protected $request;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
	  	$this->M_informasi = new InformasiModel($this->request);
	}

	// Halaman utama aplikasi
	public function index()
	{
		$data ['title']   = "App-PMB | Home";
		$data ['tanggal'] = $this->M_informasi->first();
		return view('v_home/index', $data);
	}

}
