<?php namespace App\Controllers;

use App\Models\FakultasModel;
use Config\Services;

class DataFakultas extends BaseController
{
	protected $M_fakultas;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
	  	$this->M_fakultas = new FakultasModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Fakultas
	private function _action($idFakultas)
	{ 
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editFakultas' title='Update' value='".$idFakultas."'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='".base_url('datafakultas/delete/'.$idFakultas)."' class='btn-deleteFakultas' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
	    return $link;
	}
	
	// Halaman Data Fakultas
	public function index()
	{
		$data ['title']  = "App-PMB | Data Fakultas";
		$data ['page']   = "datafakultas";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');
		return view('v_dataFakultas/index', $data);
	}

	// Add Data Fakultas
	public function add()
	{
		
		$nama_fakultas = ucwords($this->request->getPost('nama_fakultas'));
		
		//Data Fakultas
		$data = [ 
			'nama_fakultas' => $nama_fakultas
		];

		//Cek Validasi Data Fakultas, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'fakultas') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_fakultas_error' => $this->form_validation->getErrors('nama_fakultas')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan Data Fakultas
			$this->M_fakultas->save($data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
		
	}

	// Menampilkan Data Fakultas Pada Modal Edit Data Fakultas
	public function ajaxUpdate($idFakultas)
	{
		$data = $this->M_fakultas->find($idFakultas);
		echo json_encode($data);
	}

	// Update Data Fakultas
	public function update()
	{
		$id = $this->request->getPost('idFakultas');
		$nama_fakultas = ucwords($this->request->getPost('nama_fakultas2'));
		
		//Data Fakultas
		$data = [ 
			'nama_fakultas' => $nama_fakultas
		];

		//Cek Validasi Data Fakultas, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'fakultas') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_fakultas_error' => $this->form_validation->getErrors('nama_fakultas')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Update Data Fakultas
			$this->M_fakultas->update($id, $data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Delete Data Fakultas
	public function delete($id)
	{
		$this->M_fakultas->delete($id);
	}

	// Datatable server side
	public function ajaxDataFakultas()
	{
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_fakultas->get_datatables();
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_fakultas;
                $row[] = $this->_action($list->id);
                $data[] = $row;
	    	}
	    $output = [
	    	"draw" 				=> $this->request->getPost('draw'),
	        "recordsTotal" 		=> $this->M_fakultas->count_all(),
            "recordsFiltered" 	=> $this->M_fakultas->count_filtered(),
            "data" 				=> $data
        	];
	    echo json_encode($output);
	  }
	}

}

/* End of file DataFakultas.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/DataFakultas.php */
