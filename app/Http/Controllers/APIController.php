<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MeLi;
use App\Models\ApiMeLi;
use App\Models\MeliAccess;

use Auth;

class APIController extends Controller {

	protected $meli;

	public function __construct() 
	{
		$this->meli = new ApiMeli();
	}

	public function authorize() 
	{
		return redirect($this->meli->authorize());
	}

	public function authorizeReturn(Request $request)
	{
		$data = $request->all();
		$this->meli->authorizeReturn($data['code']);
		
		return redirect('product/');
	}
}
