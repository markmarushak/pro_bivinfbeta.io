<?php

namespace App\Http\Controllers\Admin;

use App\Conversation;
use App\Events\NewMessage;
use App\MainGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\User;

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


    public function chat()
    {
        $groups = auth()->user()->groups;
        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();
        return view('chat', ['groups' => $groups, 'users' => $users, 'user' => $user]);
    }
}
