<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	
    //Validasi Data Fakultas
    public $fakultas = [
        'nama_fakultas' => [
            'label'  => 'Nama fakultas',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama fakultas tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Data Prodi
    public $prodi = [
        'nama_prodi' => [
            'label'  => 'Nama prodi',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama prodi tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Informasi Pendaftaran
    public $informasi = [
        'tgl_pendaftaran' => [
            'label'  => 'Tanggal Pendaftaran',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal pendaftaran tidak boleh kosong!'
            ]
        ],
        'tgl_pengumuman' => [
            'label'  => 'Tanggal Pengumuman',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal pengumuman lulus administrasi tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Pendaftaran - Buat kun
    public $daftar_akun = [
        'nama' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
            ]
        ],
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ],
        'comfirm_password' => [
            'label'  => 'Comfirm Password',
            'rules'  => 'required|min_length[8]|matches[password]',
            'errors' => [
                'required' => 'Comfirm Password Tidak Boleh Kosong!',
                'min_length' => 'Comfirm Password Minimal 8 Karakter!',
                'matches' => 'Comfirm Password Tidak Sama Dengan Password!',
            ]
        ]
    ];

    //Validasi Login
    public $login= [
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ]
    ];

    //Validasi Pendaftran - Tahap satu (Biodata)
    public $tahap_satu = [
        'nama_peserta' => [
            'label'  => 'Nama Peserta',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Peserta tidak boleh kosong!'
            ]
        ],
        'tempat_lahir' => [
            'label'  => 'Tempat Lahir',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tempat Lahir Peserta tidak boleh kosong!'
            ]
        ],
        'tanggal_lahir' => [
            'label'  => 'Tanggal Lahir',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir Peserta tidak boleh kosong!'
            ]
        ],
        'jenis_kelamin' => [
            'label'  => 'Jenis Kelamin',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin Peserta tidak boleh kosong!'
            ]
        ],
        'agama' => [
            'label'  => 'Agama',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Agama Peserta tidak boleh kosong!'
            ]
        ],
        'no_hp' => [
            'label'  => 'No. Handphone',
            'rules'  => 'required|numeric|max_length[12]',
            'errors' => [
                'required' => 'No. Handphone Peserta tidak boleh kosong!',
                'numeric' => 'No. Handphone Peserta tidak valid!',
                'min_length' => 'No. Handphone Peserta maksimal 12 angka!'
            ]
        ],
        'alamat_peserta' => [
            'label'  => 'Alamat',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Alamat Peserta tidak boleh kosong!'
            ]
        ],
        'nama_orangtua' => [
            'label'  => 'Nama Orangtua',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Orangtua Peserta tidak boleh kosong!'
            ]
        ],
        'pekerjaan_orangtua' => [
            'label'  => 'Pekerjaan Orangtua',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pekerjaan Orangtua Peserta tidak boleh kosong!'
            ]
        ],
        'no_hp_orangtua' => [
            'label'  => 'No. Handphone Orangtua',
            'rules'  => 'required|numeric|max_length[12]',
            'errors' => [
                'required' => 'No. Handphone Orangtua Peserta tidak boleh kosong!',
                'numeric' => 'No. Handphone Orangtua Peserta tidak valid!',
                'min_length' => 'No. Handphone Orangtua Peserta maksimal 12 angka!'
            ]
        ],
        'nama_sekolah' => [
            'label'  => 'Nama Sekolah',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Sekolah Peserta tidak boleh kosong!'
            ]
        ],
        'tahun_lulus' => [
            'label'  => 'Tahun Lulus',
            'rules'  => 'required|numeric|max_length[4]',
            'errors' => [
                'required' => 'Tahun Lulus Peserta tidak boleh kosong!',
                'numeric' => 'Tahun Lulus Peserta tidak valid!',
                'min_length' => 'Tahun Lulus Peserta maksimal 4 angka!'
            ]
        ],
        'alamat_sekolah' => [
            'label'  => 'Alamat Sekolah',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Alamat Sekolah Peserta tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Pendaftran - Tahap dua (Pilih Fakultas Dan Prodi)
    public $tahap_dua = [
        'fakultas_id' => [
            'label'  => 'Fakultas',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Fakultas tidak boleh kosong!'
            ]
        ],
        'prodi_id' => [
            'label'  => 'Prodi',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Prodi tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Pendaftran - Tahap tiga (Upload Berkas Pendaftaran)
    public $tahap_tiga = [
        'foto' => [
            'label'  => 'Foto',
            'rules'  => 'uploaded[foto]|max_size[foto,500]|max_dims[foto,354,472]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg]',
            'errors' => [
                'uploaded' => 'Foto Peserta tidak boleh kosong!',
                'max_size' => 'Ukuran File Foto Peserta maksimal 500Kb!',
                'max_dims' => 'Ukuran Dimensi Foto Peserta 3X4 cm!',
                'is_image' => 'Yang anda pilih bukan gambar!',
                'mime_in' => 'Format Foto Peserta tidak sesuai!'
            ]
        ],
        'berkas' => [
            'label'  => 'Berkas',
            'rules'  => 'uploaded[berkas]|max_size[berkas,2048]|ext_in[berkas,pdf]',
            'errors' => [
                'uploaded' => 'Berkas Peserta tidak boleh kosong!',
                'max_size' => 'Ukuran File Berkas Peserta maksimal 2Mb!',
                'ext_in' => 'Format File Berkas Peserta tidak sesuai!'
            ]
        ]
    ];
}
