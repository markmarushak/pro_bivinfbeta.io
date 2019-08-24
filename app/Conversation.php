<?php
namespace App;
use App\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;
class Conversation extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['message', 'key_chat', 'manager_id', 'name'];

//    protected $fillable = ['message', 'user_id', 'group_id'];
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//    public function group()
//    {
//        return $this->belongsTo(Group::class);
//    }
}