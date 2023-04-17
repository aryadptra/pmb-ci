<?php namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use Config\Services;

class DataPendaftaran extends BaseController
{
	protected $session;
	protected $M_pendaftaran;
	protected $M_fakultas;
	protected $M_prodi;
	protected $request;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_fakultas = new FakultasModel($this->request);
		$this->M_prodi = new ProdiModel($this->request);
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Pendaftaran
	private function _action($idPendaftaran, $statusVerifikasi)
	{
		if ($statusVerifikasi == "Lulus" || $statusVerifikasi == "Tidak Lulus") {
		 	$link = "
		      	<a href='".base_url('datapendaftaran/view/'.$idPendaftaran)."' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>
		    ";
		    return $link;
		} 
		else {
		 	$link = "
		      	<a href='".base_url('datapendaftaran/view/'.$idPendaftaran)."' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>

		      	<a href='".base_url('datapendaftaran/lulus/'.$idPendaftaran)."' class='btn-lulusPendaftaran' data-toggle='tooltip' data-placement='top' title='Lulus'>
		      		<button type='button' class='btn btn-outline-success btn-xs'><i class='fas fa-check'></i></button>
		      	</a>

		      	<a href='".base_url('datapendaftaran/tidaklulus/'.$idPendaftaran)."' class='btn-tidakLulusPendaftaran' data-toggle='tooltip' data-placement='top' title='Tidak Lulus'>
		      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fas fa-times'></i></button>
		      	</a>
		    ";
		    return $link;
		}
		  	
	}

	// Halaman Data Pendaftaran
	public function index()
	{
		$data ['title']   = "App-PMB | Data Pendaftaran";
		$data ['page']    = "datapendaftaran";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');
		return view('v_dataPendaftaran/index', $data);
	}

	// Halaman View Pendaftaran
	public function view($id)
	{
		$data ['title']   = "App-PMB | View Data Pendaftaran";
		$data ['page']    = "datapendaftaran";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');

		//Cek pendaftaran berdasarkan id pendaftaran
		$cekPendaftaran = $this->M_pendaftaran->where('id', $id)->first();
		$status_pendaftaran = $cekPendaftaran['status_pendaftaran'];
		$fakultas_id 	= $cekPendaftaran['fakultas_id'];
		$prodi_id 		= $cekPendaftaran['prodi_id'];
		
		//Jika Data pendaftaran ada
		if ($cekPendaftaran) {
			//Jika pendaftaran sudah selesai
			if ($status_pendaftaran == "Selesai") {
				$data ['pendaftaran'] = $cekPendaftaran;

				//Fakultas
				$cekFakultas = $this->M_fakultas->where('id', $fakultas_id)->first();
				$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];

				//Prodi
				$cekProdi = $this->M_prodi->where('id', $prodi_id)->first();
				$data ['nama_prodi']   = $cekProdi['nama_prodi'];

				return view('v_dataPendaftaran/view', $data);
			}
			//Pendaftaran belum selesai 
			else {
				return view('v_dataPendaftaran/error', $data);
			}
			
		}
		//Data pendaftaran tidak ada 
		else {
			return view('v_dataPendaftaran/error', $data);
		}
	}

	// Lulus 
	public function lulus($id)
	{
		//Data pendaftaran
		$data = [ 
			'status_verifikasi' => "Lulus"
		];

		//Update Data pendaftaran
		$this->M_pendaftaran->update($id, $data);
	}

	// Tidak Lulus
	public function tidakLulus($id)
	{
		//Data pendaftaran
		$data = [ 
			'status_verifikasi' => "Tidak Lulus"
		];

		//Update Data pendaftaran
		$this->M_pendaftaran->update($id, $data);
	}

	// Datatable server side
	public function ajaxDataPendaftaran()
	{
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_pendaftaran->get_datatables();
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nomor_pendaftaran;
                $row[] = $list->nama_peserta;
                $row[] = $list->nama_prodi;
                $row[] = tgl_indonesia($list->tanggal_pendaftaran);
                $row[] = $list->status_verifikasi;
                $row[] = $this->_action($list->id, $list->status_verifikasi);
                $data[] = $row;
	    	}
	    $output = [
	    	"draw" 				=> $this->request->getPost('draw'),
	        "recordsTotal" 		=> $this->M_pendaftaran->count_all(),
            "recordsFiltered" 	=> $this->M_pendaftaran->count_filtered(),
            "data" 				=> $data
        	];
	    echo json_encode($output);
	  }
	}
}

/* End of file DataPendaftaran.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/DataPendaftaran.php */
