<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\InformasiModel;
use Config\Services;

class Pendaftaran extends BaseController 
{
	protected $encrypter;
	protected $form_validation;
	protected $M_user;
	protected $M_pendaftaran;
	protected $M_fakultas;
	protected $M_prodi;
	protected $session;
	protected $request;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
		$this->encrypter = \Config\Services::encrypter();
		$this->form_validation =  \Config\Services::validation();
		$this->M_user = new UserModel();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_fakultas = new FakultasModel($this->request);
		$this->M_prodi = new ProdiModel($this->request);
		$this->M_informasi = new InformasiModel($this->request);
		$this->session = \Config\Services::session();
	}

	// Input data pendaftaran saat pembuatan akun
	private function _inputPendaftaran()
	{
		//Cek Maksimal ID User
		$max = $this->M_user->selectMax('id')->first();
		$idUser = $max['id'];

		//Cek Nomor Pendaftaran
		$maxPendaftaran = $this->M_pendaftaran->selectMax('nomor_pendaftaran')->first();
		if ($maxPendaftaran['nomor_pendaftaran'] == "") {
			$nomor_pendaftaran = 200817001;
		} else {
			$nomor_pendaftaran = $maxPendaftaran['nomor_pendaftaran'] + 1;
		}
		

		$data = [ 
			'user_id' => $idUser,
			'nomor_pendaftaran' => $nomor_pendaftaran,
			'tanggal_lahir' => date('Y-m-d'),
			'tahap_satu' => 'Belum',
			'tahap_dua' => 'Belum',
			'tahap_tiga' => 'Belum',
			'status_pendaftaran' => 'Belum Selesai'
		];

		//Simpan Data Pendaftaran
		$this->M_pendaftaran->save($data);
	}

	// Halaman pendaftaran - buat akun
	public function index()
	{
		$data ['title']   = "App-PMB | Pendaftaran";

		//Cek tanggal pendaftaran
		$tanggal = $this->M_informasi->first();
		$sekarang = date('Y-m-d');

		$data ['tgl_buka']   = $tanggal['tgl_buka'];
		$data ['tgl_tutup']   = $tanggal['tgl_tutup'];

		if ($sekarang < $tanggal['tgl_buka']) {
			return view('v_pendaftaran/belum', $data);
		}
		else if($sekarang >= $tanggal['tgl_buka'] && $sekarang <= $tanggal['tgl_tutup']){
			return view('v_pendaftaran/index', $data);
		} 
		else {
			return view('v_pendaftaran/tutup', $data);
		}
	}

	public function daftarAkun()
	{
		$nama 		= $this->request->getPost('nama');
		$email	 	= $this->request->getPost('email');
		$password	= $this->request->getPost('password');
		$comfirm_password	= $this->request->getPost('comfirm_password');
	
		//Validasi daftar akun pendaftaran
		$cek_validasi = [ 
			'nama' => $nama,
			'email' => $email,
			'password' => $password,
			'comfirm_password' => $comfirm_password
		];

		//Cek Validasi, Jika Data Tidak Valid 
		if ($this->form_validation->run($cek_validasi, 'daftar_akun') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'daftar_akun_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Data User
			$data = [ 
				'role_id' => 2,
				'nama' => strtoupper($nama),
				'email' => $email,	
				'password' => base64_encode($this->encrypter->encrypt($password))
			];
			//Simpan Data User
			$this->M_user->save($data);

			//Input data pendaftaran
			$this->_inputPendaftaran();

			$validasi = [
				'success'   => true,
				'link'   => base_url('login')
			];
			echo json_encode($validasi);
		}
	}

	// Cek status pendaftaran peserta
	public function cekStatusPendaftaran()
	{
		$user_id = $this->session->get('id');
		//Cek pendaftaran Berdasarkan user_id
		$cekStatus = $this->M_pendaftaran->where('user_id', $user_id)->first();
		//Jika satus pendaftaran selesai
		if ($cekStatus['status_pendaftaran'] == "Selesai") {
			return redirect()->to('/pendaftaran/dashboard');
		}
		//Jika satus pendaftaran resume 
		else if ($cekStatus['status_pendaftaran'] == "Resume"){
			return redirect()->to('/pendaftaran/tahapempat');
		}
		//Jika satus pendaftaran belum selesai 
		else {
			return redirect()->to('/pendaftaran/tahapsatu');
		}
		
	}

	// Halaman pendaftaran tahap satu (Biodata Peserta)
	public function tahapSatu()
	{
		$data ['title']   = "App-PMB | Pendaftaran Tahap 1";

		//Cek pendaftaran tahap satu berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapSatu = $this->M_pendaftaran->where('user_id', $user_id)->first();

		$data ['cekTahapSatu'] = $cekTahapSatu; 

		return view('v_pendaftaran/tahap_1', $data);
	}

	// Simpan pendaftaran tahap satu
	public function saveTahapSatu()
	{
		$id 			= $this->request->getPost('idPendaftaran');
		$nama_peserta 	= $this->request->getPost('nama_peserta');
		$tempat_lahir 	= $this->request->getPost('tempat_lahir');
		$tanggal_lahir 	= $this->request->getPost('tanggal_lahir');
		$jenis_kelamin 	= $this->request->getPost('jenis_kelamin');
		$agama 			= $this->request->getPost('agama');
		$no_hp			= $this->request->getPost('no_hp');
		$alamat_peserta	= $this->request->getPost('alamat_peserta');
		$nama_orangtua	= $this->request->getPost('nama_orangtua');
		$pekerjaan_orangtua	= $this->request->getPost('pekerjaan_orangtua');
		$no_hp_orangtua	= $this->request->getPost('no_hp_orangtua');
		$nama_sekolah	= $this->request->getPost('nama_sekolah');
		$tahun_lulus	= $this->request->getPost('tahun_lulus');
		$alamat_sekolah	= $this->request->getPost('alamat_sekolah');

		//Validasi pendaftaran tahap satu
		$validasi_tahap_satu = [ 
			'nama_peserta' => $nama_peserta,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'agama' => $agama,
			'no_hp' => $no_hp,
			'alamat_peserta' => $alamat_peserta,
			'nama_orangtua' => $nama_orangtua,
			'pekerjaan_orangtua' => $pekerjaan_orangtua,
			'no_hp_orangtua' => $no_hp_orangtua,
			'nama_sekolah' => $nama_sekolah,
			'tahun_lulus' => $tahun_lulus,
			'alamat_sekolah' => $alamat_sekolah
		];

		//Cek Validasi pendaftaran tahap satu, Jika Data Tidak Valid 
		if ($this->form_validation->run($validasi_tahap_satu, 'tahap_satu') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'tahap_satu_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Data pendaftaran tahap satu
			$data_tahap_satu = [ 
				'nama_peserta' => strtoupper($nama_peserta),
				'tempat_lahir' => strtoupper($tempat_lahir),
				'tanggal_lahir' => ubah_tgl1($tanggal_lahir),
				'jenis_kelamin' => $jenis_kelamin,
				'agama' => $agama,
				'no_hp' => $no_hp,
				'alamat_peserta' => $alamat_peserta,
				'nama_orangtua' => strtoupper($nama_orangtua),
				'pekerjaan_orangtua' => ucwords($pekerjaan_orangtua),
				'no_hp_orangtua' => $no_hp_orangtua,
				'nama_sekolah' => strtoupper($nama_sekolah),
				'tahun_lulus' => $tahun_lulus,
				'alamat_sekolah' => $alamat_sekolah,
				'tahap_satu'  => "Selesai"
			];
			//Simpan pendaftaran tahap satu
			$this->M_pendaftaran->update($id, $data_tahap_satu);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahapdua')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap dua (Pilih Fakultas Dan Prodi)
	public function tahapDua()
	{
		$data ['title']   = "App-PMB | Pendaftaran Tahap 2";
		$data ['fakultas']   = $this->M_fakultas->findAll();

		//Cek Fakultas dan Prodi Peserta pada pendaftaran tahap dua berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapDua = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$fakultas_id = $cekTahapDua['fakultas_id'];
		$prodi_id = $cekTahapDua['prodi_id'];

		$data ['idPendaftaran']   = $cekTahapDua['id'];
		$data ['tahap_dua']   = $cekTahapDua['tahap_dua'];

		//Jika $fakultas_id == 0 dan $prodi_id == 0
		if ($fakultas_id == 0 && $prodi_id == 0) {
			$data ['IdFakultas']   = "";
			$data ['nama_fakultas']   = "--Fakultas--";
			$data ['IdProdi']   = "";
			$data ['nama_prodi']   = "--Prodi--";
		}
		//Dan jika tidak 
		else {
			//Fakultas
			$data ['IdFakultas']   = $fakultas_id;
			$cekFakultas = $this->M_fakultas->where('id', $fakultas_id)->first();
			$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];
			//Prodi
			$data ['IdProdi']   = $prodi_id;
			$cekProdi = $this->M_prodi->where('id', $prodi_id)->first();
			$data ['nama_prodi']   = $cekProdi['nama_prodi'];
		}
		
		return view('v_pendaftaran/tahap_2', $data);
	}

	// Menampilkan pilihan Prodi berdasarkan Fakultas pada Halaman pendaftaran tahap dua 
	public function ajaxPilihanProdi()
	{
		$fakultas_id = $this->request->getPost('id');
		$data = $this->M_prodi->where('fakultas_id', $fakultas_id)->findAll();
		echo json_encode($data);
	}

	// Simpan pendaftaran tahap dua
	public function saveTahapDua()
	{
		$id 		= $this->request->getPost('idPendaftaran');
		$fakultas 	= $this->request->getPost('fakultas');
		$prodi 		= $this->request->getPost('prodi');

		//Data pendaftaran tahap dua
		$data_tahap_dua = [ 
			'fakultas_id' => $fakultas,
			'prodi_id' => $prodi,
			'tahap_dua'  => "Selesai"
		];

		//Cek Validasi pendaftaran tahap dua, Jika Data Tidak Valid 
		if ($this->form_validation->run($data_tahap_dua, 'tahap_dua') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'tahap_dua_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan pendaftaran tahap satu
			$this->M_pendaftaran->update($id, $data_tahap_dua);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahaptiga')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap tiga (Upload Berkas Pendaftaran)
	public function tahapTiga()
	{
		$data ['title']   = "App-PMB | Pendaftaran Tahap 3";

		//Cek Foto dan Berkas Peserta pada pendaftaran tahap tiga berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapTiga = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$foto_peserta = $cekTahapTiga['foto'];
		$berkas_peserta = $cekTahapTiga['berkas'];

		//Jika foto_peserta == "" dan berkas_peserta == ""
		if ($foto_peserta == "" && $berkas_peserta == "") {
			$data ['foto_peserta'] = "Pilih foto..";
			$data ['berkas_peserta'] = "Pilih berkas..";
			$data ['lokasi_foto'] = "/file_peserta/default.jpg";
		}
		//Jika tidak
		else {
			$data ['foto_peserta'] = $foto_peserta;
			$data ['berkas_peserta'] = $berkas_peserta;
			$data ['lokasi_foto'] = "/file_peserta/".$foto_peserta;
		}
	
		$data ['idPendaftaran']   = $cekTahapTiga['id'];
		$data ['tahap_tiga']   = $cekTahapTiga['tahap_tiga'];

		return view('v_pendaftaran/tahap_3', $data);
	}

	// Simpan pendaftran tahap tiga
	public function saveTahapTiga()
	{
		$id 	= $this->request->getPost('idPendaftaran');
		$foto  	= $this->request->getFile('foto');
		$berkas = $this->request->getFile('berkas');

		//Validasi pendaftaran tahap tiga
		$validasi_tahap_tiga = [ 
			'foto' => $foto,
			'berkas' => $berkas
		];

		//Cek Validasi pendaftaran tahap tiga, Jika Data Tidak Valid 
		if ($this->form_validation->run($validasi_tahap_tiga, 'tahap_tiga') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'tahap_tiga_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Pindahkan file foto peserta ke direktori public/file_peserta
			$nama_foto = $foto->getRandomName();
			$foto->move('file_peserta', $nama_foto);
			
			//Pindahkan file berkas pendaftaran peserta ke direktori public/file_peserta
			$nama_berkas = $berkas->getRandomName();
			$berkas->move('file_peserta', $nama_berkas);
			
			$data_tahap_tiga = [
				'foto'   	=> $nama_foto,
				'berkas'   	=> $nama_berkas,
				'tahap_tiga'  => "Selesai",
				'status_pendaftaran'   	=> "Resume"
			];

			//Simpan pendaftaran tahap tiga
			$this->M_pendaftaran->update($id, $data_tahap_tiga);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahapempat')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap empat (Resume Pendaftaran)
	public function tahapEmpat()
	{
		$data ['title']   = "App-PMB | Pendaftaran Tahap 4";

		//Cek Resume pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapEmpat = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$fakultas_id 	= $cekTahapEmpat['fakultas_id'];
		$prodi_id 		= $cekTahapEmpat['prodi_id'];
		
		$data ['resume']   = $cekTahapEmpat; 

		//Fakultas
		$cekFakultas = $this->M_fakultas->where('id', $fakultas_id)->first();
		$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];

		//Prodi
		$cekProdi = $this->M_prodi->where('id', $prodi_id)->first();
		$data ['nama_prodi']   = $cekProdi['nama_prodi'];

		return view('v_pendaftaran/tahap_4', $data);
	}

	// Finalisasi Pendaftaran
	public function finalisasiPendaftaran()
	{
		$id = $this->request->getPost('idPendaftaran');
		
		//Finalisasi
		$finalisasi = [
			'tanggal_pendaftaran' => date('Y-m-d'),
			'status_pendaftaran' => "Selesai",
			'status_verifikasi'  => "Belum Verifikasi"
		];

		//Simpan Finalisasi Pendaftaran
		$this->M_pendaftaran->update($id, $finalisasi);

		$validasi = [
			'success'   => true,
			'link'   => base_url('pendaftaran/dashboard')
		];
		echo json_encode($validasi);
	}

	// Halaman dashboard peserta yang sudah melakukan pendaftaran
	public function dashboard()
	{
		$data ['title']   = "App-PMB | Dashboard Peserta";

		//Cek pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$fakultas_id 	= $pendaftaran['fakultas_id'];
		$prodi_id 		= $pendaftaran['prodi_id'];
		
		$data ['pendaftaran']   = $pendaftaran; 

		//Fakultas
		$cekFakultas = $this->M_fakultas->where('id', $fakultas_id)->first();
		$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];

		//Prodi
		$cekProdi = $this->M_prodi->where('id', $prodi_id)->first();
		$data ['nama_prodi']   = $cekProdi['nama_prodi'];

		//Cek tanggal informasi pendaftaran
		$cekInfo = $this->M_informasi->first();
		$data ['tgl_pengumuman'] = $cekInfo['tgl_pengumuman'];

		$data ['tgl_sekarang'] = date('Y-m-d');

		return view('v_pendaftaran/dashboard', $data);
	}

	// Cetak bukti pendaftaran
	public function buktiPendaftaran()
	{
		//Cek bukti Pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$buktiPendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$fakultas_id 	= $buktiPendaftaran['fakultas_id'];
		$prodi_id 		= $buktiPendaftaran['prodi_id'];

		$data ['buktiPendaftaran']   = $buktiPendaftaran; 

		//Fakultas
		$cekFakultas = $this->M_fakultas->where('id', $fakultas_id)->first();
		$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];

		//Prodi
		$cekProdi = $this->M_prodi->where('id', $prodi_id)->first();
		$data ['nama_prodi']   = $cekProdi['nama_prodi'];

		//Cetak dengan dompdf
		$dompdf = new \Dompdf\Dompdf(); 
		$options = new \Dompdf\Options();
		$options->setIsRemoteEnabled(true);

		$dompdf->setOptions($options);
		$dompdf->output();
        $dompdf->loadHtml(view('v_pendaftaran/bukti_pendaftaran', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('bukti_pendaftaran.pdf', array("Attachment" => false));
	} 

	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}

}

/* End of file Pendaftaran.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/Pendaftaran.php */
