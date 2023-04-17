<?php namespace App\Controllers;

use App\Models\FakultasModel;
use App\Models\ProdiModel;
use Config\Services;

class DataProdi extends BaseController 
{
	protected $M_fakultas;
	protected $M_prodi;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
	  	$this->M_fakultas = new FakultasModel($this->request);
	  	$this->M_prodi = new ProdiModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Prodi
	private function _action($idProdi)
	{ 
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editProdi' title='Update' value='".$idProdi."'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='".base_url('dataprodi/delete/'.$idProdi)."' class='btn-deleteProdi' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
	    return $link;
	}

	// Halaman Data Prodi
	public function index($idFakultas)
	{
		$data ['title']  = "App-PMB | Data Prodi";
		$data ['page']   = "dataprodi";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');

		//Cek Data Fakultas Berdasarkan Id Fakultas
		$cekFakultas = $this->M_fakultas->where('id', $idFakultas)->first();
		$data ['nama_fakultas']   = $cekFakultas['nama_fakultas'];
		$data ['id_fakultas'] = $cekFakultas['id'];

		//Jika Data fakultas ada
		if ($cekFakultas) {
			return view('v_dataProdi/index', $data);
		} else {
		 	return view('v_dataProdi/error', $data);
		}
		
	}

	// Add Data Prodi
	public function add()
	{
		$fakultas_id = $this->request->getPost('fakultas_id');
		$nama_prodi = ucwords($this->request->getPost('nama_prodi'));
		
		//Data prodi
		$data = [ 
			'fakultas_id' => $fakultas_id,
			'nama_prodi' => $nama_prodi
		];

		//Cek Validasi Data prodi, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'prodi') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_prodi_error' => $this->form_validation->getErrors('nama_prodi')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan Data prodi
			$this->M_prodi->save($data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Menampilkan Data Prodi Pada Modal Edit Data Prodi
	public function ajaxUpdate($idProdi)
	{
		$data = $this->M_prodi->find($idProdi);
		echo json_encode($data);
	}

	// Update Data Prodi
	public function update()
	{
		$id = $this->request->getPost('idProdi');
		$nama_prodi = ucwords($this->request->getPost('nama_prodi2'));
		
		//Data Fakultas
		$data = [ 
			'nama_prodi' => $nama_prodi
		];

		//Cek Validasi Data Fakultas, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'prodi') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_prodi2_error' => $this->form_validation->getErrors('nama_prodi')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Update Data Fakultas
			$this->M_prodi->update($id, $data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Delete Data Prodi
	public function delete($id)
	{
		$this->M_prodi->delete($id);
	} 

	// Datatable server side
	public function ajaxDataProdi($idFakultas)
	{
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_prodi->get_datatables($idFakultas);
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_prodi;
                $row[] = $this->_action($list->id);
                $data[] = $row;
	    	}
	    $output = [
	    	"draw" 				=> $this->request->getPost('draw'),
	        "recordsTotal" 		=> $this->M_prodi->count_all($idFakultas),
            "recordsFiltered" 	=> $this->M_prodi->count_filtered($idFakultas),
            "data" 				=> $data
        	];
	    echo json_encode($output);
	  }
	}

}

/* End of file DataProdi.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/DataProdi.php */
