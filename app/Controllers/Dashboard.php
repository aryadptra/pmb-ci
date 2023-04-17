<?php namespace App\Controllers;

class Dashboard extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
	}

	// Halaman Dashboard
	public function index()
	{
		$data ['title']  = "App-PMB | Dashboard";
		$data ['page']   = "dashboard";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');
		return view('v_dashboard/index', $data);
	}

	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}

}

/* End of file Dashboard.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/Dashboard.php */
