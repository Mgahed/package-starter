<?php

namespace Mgahed\MgahedStarter\Http\Controllers;


use Illuminate\Routing\Controller;

class MgahedStarterController extends Controller
{
	public function index()
	{
		return view('mgahed-starter::index');
	}
}
