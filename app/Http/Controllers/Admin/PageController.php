<?php

namespace App\Http\Controllers\Admin;

use App\MainGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public $mg;

    /**
     * PageController constructor.
     */
    function __construct(MainGroup $mainGroup)
    {
        $this->mg = $mainGroup;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.main', [
            'groups' => $this->mg
        ]);
    }

    public function add()
    {
        return view('admin.add');
    }

}
