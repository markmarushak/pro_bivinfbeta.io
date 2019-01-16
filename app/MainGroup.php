<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MainGroup extends Model
{
    protected $table = 'main_groups';

    protected $fillable = ['main_id','name'];

    public $timestamps = false;

    public function getParent($id)
    {
        $data = DB::table($this->table)->where('main_id','=',$id)->select('*')->get();
        return $data->toArray();
    }
}
