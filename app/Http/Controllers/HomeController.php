<?php

namespace App\Http\Controllers;

use App\Content;
use App\MainGroup;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $mg;
    public $section;
    public $content;

    function __construct(
        MainGroup $mainGroup,
        Section $section,
        Content $content
    )
    {
        $this->content = $content;
        $this->section = $section;
        $this->mg = $mainGroup;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'menu' => $this->mg,
            'section' => $this->section->get()->toArray()
        ]);
    }

    public function test()
    {
        return view('test',[
            'menu' => $this->mg,
            'section' => $this->section->get()->toArray()
        ]);
    }

    public function content(Request $request)
    {
        $data = $this->content->where('group_id','=',$request->input('id'))->get();
        return response()->json($data);
    }

    public function section(Request $request)
    {
        $data = $this->section->where('section_id','=',$request->input('id'))->get();
        return response()->json($data);
    }

}
