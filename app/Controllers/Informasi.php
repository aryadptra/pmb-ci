<?php namespace App\Controllers;

use App\Models\InformasiModel;
use Config\Services;

class Informasi extends BaseController 
{

	protected $M_informasi;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
	  	$this->M_informasi = new InformasiModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Informasi
	private function _action($idInformasi)
	{ 
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editInformaasi' title='Update' value='".$idInformasi."'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	    ";
	    return $link;
	}

	// Halaman Informasi
	public function index()
	{
		$data ['title']  = "App-PMB | Informasi";
		$data ['page']   = "informasi";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');
		return view('v_informasi/index', $data);
	}

	// Menampilkan Informasi Pada Modal Edit Informasi
	public function ajaxUpdate($idInformasi)
	{
		//Cek informasi berdasarkan id
		$cek = $this->M_informasi->find($idInformasi);
		$id = $cek['id'];

		//Ubah format penanggalan melalui helper
		$tbl_buka = ubah_tgl2($cek['tgl_buka']);
		$tgl_tutup = ubah_tgl2($cek['tgl_tutup']);
		$tgl_pengumuman = ubah_tgl2($cek['tgl_pengumuman']);
		
		$data = [
			'id'   => $cek['id'],
		    'tgl_pendaftaran' => $tbl_buka." - ".$tgl_tutup,
		    'tgl_pengumuman' => $tgl_pengumuman
		];
	
		echo json_encode($data);
	}

	// Update Data Informasi
	public function update()
	{
		$id = $this->request->getPost('idInformasi');
		$tgl_pendaftaran = $this->request->getPost('tgl_pendaftaran');
		$tgl_pengumuman = $this->request->getPost('tgl_pengumuman');
		
		//Validasi Informasi
		$data = [ 
			'tgl_pendaftaran' => $tgl_pendaftaran,
			'tgl_pengumuman' => $tgl_pengumuman
		];

		//Cek Validasi informasi, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'informasi') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'info_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Ubah format penanggalan tanggal pendaftaran melalui helper
			$pisah_tanggal   = explode(' - ',$tgl_pendaftaran);
			$tgl_buka = ubah_tgl1($pisah_tanggal[0]);
			$tgl_tutup = ubah_tgl1($pisah_tanggal[1]);
			$tgl_p = ubah_tgl1($tgl_pengumuman);
			
			//Data Update Informasi
			$data1 = [ 
				'tgl_buka' => $tgl_buka,
				'tgl_tutup' => $tgl_tutup,
				'tgl_pengumuman' => $tgl_p
			];
			//Update Informasi
			$this->M_informasi->update($id, $data1);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Datatable server side
	public function ajaxInformasi()
	{
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_informasi->get_datatables();
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = tgl_indonesia($list->tgl_buka);
                $row[] = tgl_indonesia($list->tgl_tutup);
                $row[] = tgl_indonesia($list->tgl_pengumuman);
                $row[] = $this->_action($list->id);
                $data[] = $row;
	    	}
	    $output = [
	    	"draw" 				=> $this->request->getPost('draw'),
	        "recordsTotal" 		=> $this->M_informasi->count_all(),
            "recordsFiltered" 	=> $this->M_informasi->count_filtered(),
            "data" 				=> $data
        	];
	    echo json_encode($output);
	  }
	}

}

/* End of file Informasi.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/Informasi.php */
