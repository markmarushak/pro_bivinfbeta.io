<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use App\MainGroup;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public $mainGroup;
    public $content;
    public $section;

    function __construct(
        MainGroup $mainGroup,
        Content $content,
        Section $section
    )
    {
        $this->section = $section;
        $this->content = $content;
        $this->mainGroup = $mainGroup;
    }

    public function addMainGroup(Request $request)
    {
        $data = $request->all();
        DB::table($this->mainGroup->getTable())->insert($request->all());
        echo 'true';
    }

    public function addContent(Request $request)
    {
        if ($this->content->where('group_id', '=', $request->input('group_id'))->exists()) {
            DB::table($this->content->getTable())->where('group_id','=',$request->input('group_id'))->update($request->all());
        }else {
            DB::table($this->content->getTable())->insert($request->all());
        }
        echo 'true';
    }

    public function addSection(Request $request)
    {
        if ($this->section->where('section_id', '=', $request->input('section_id'))->exists()) {
            $this->section->where('section_id','=',$request->input('section_id'))->update($request->all());
        }else {
            $this->section->insert($request->all());
        }
        echo 'true';
    }

    public function ajaxShow(Request $request)
    {
        if($request->input('main') == 'true'){
            $data = DB::table($this->mainGroup->getTable())->select('*')->where('main_id','=',0)->get();
        }else {
            $data = DB::table($this->mainGroup->getTable())->select('*')->where('main_id','!=',0)->get();
        }
        return response()->json($data);
    }

    function parent(Request $request)
    {
        $data = DB::table($this->mainGroup->getTable())->select('id')->where('main_id','=',$request->input('id'))->get();
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        DB::table($this->mainGroup->getTable())->where('id','=',$request->input('id'))->update(['name' => $request->input('text')]);
    }

    public function remove(Request $request)
    {
        DB::table($this->mainGroup->getTable())->where('id','=',$request->input('id'))->delete();
        DB::table($this->mainGroup->getTable())->where('main_id','=',$request->input('id'))->delete();
    }
}