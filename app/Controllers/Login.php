<?php namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController  
{
	protected $encrypter;
	protected $form_validation;
	protected $M_user;
	protected $session;

	public function __construct()
	{
		$this->encrypter = \Config\Services::encrypter();
		$this->form_validation =  \Config\Services::validation();
		$this->M_user = new UserModel();
		$this->session = \Config\Services::session();
	}

	// Halaman Login
	public function index()
	{
		$data ['title']   = "App-PMB | Login";
		return view('v_login/index', $data);
	}

	// Pengecekan User
	public function cekUser()
	{
		$email	 	= $this->request->getPost('email');
		$password	= $this->request->getPost('password');

		//Validasi 
		$cek_validasi = [ 
			'email' => $email,
			'password' => $password
		];

		//Cek Validasi, Jika Data Tidak Valid 
		if ($this->form_validation->run($cek_validasi, 'login') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'login_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {

			//Cek Data user berdasarkan email
			$cekUser = $this->M_user->where('email', $email)->first();
			$ciphertext = $cekUser['password'];

			//Jika user ada
			if ($cekUser) {
				//Cek password
				$p = $this->encrypter->decrypt(base64_decode($ciphertext));
				
				//Jika password benar
				if ($password == $p) {
					$newdata = [
	                    'id'        => $cekUser['id'],
	                    'role_id'   => $cekUser['role_id'],
	                    'nama'      => $cekUser['nama'],
	                    'email'     => $cekUser['email']
	                ];
	                $this->session->set($newdata);
	                //Cek role_id apakah Admin atau Member
	                if ($cekUser['role_id'] == 1) {
	                    //Admin
	                    $validasi = [
	                        'success'   => true,
	                        'link'   => base_url('dashboard')
	                        ];
	                    echo json_encode($validasi);
	                } else {
	                    //Member
	                    $validasi = [
	                        'success'   => true,
	                        'link'   => base_url('pendaftaran/cekStatusPendaftaran')
	                        ];
	                    echo json_encode($validasi);
	                }
				} 
				//Password salah
				else {
					$validasi = [
						'error'   => true,
					    'login_error' => [
					    		'password' => 'Password Salah!'
					    	]
					];
					echo json_encode($validasi);
				}
				
			} 

			//Dan jika user tidak ada
			else {
				$validasi = [
					'error'   => true,
				    'login_error' => [
				    		'email' => 'Email Tidak Terdaftar!'
				    	]
				];
				echo json_encode($validasi);
			}

		}
	}

}

/* End of file Login.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/Login.php */
