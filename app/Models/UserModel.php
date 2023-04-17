<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model 
{
	protected $table = "tbl_user";
	protected $allowedFields = ['role_id','nama','email','password'];
	protected $useTimestamps = true;
}

/* End of file UserModel.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Models/UserModel.php */