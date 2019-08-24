<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\NewMessage;
use App\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    private $chat;

    public function storeChat(Request $request)
    {
        $manager = Manager::firstOrCreate(['chat_id' => $request->chat_id],[
            'chat_id' => $request->chat_id,
            'status' => 'open'
        ]);

        return response()->json([
            'data' => $manager
        ]);
    }

    public function status(Request $request)
    {
        $manager = Manager::where('chat_id', 'LIKE', $request->chat_id)->update(['status' => $request->status, 'client_id' => null]);
        return response()->json([
            'data' => $manager
        ]);
    }

    public function send(Request $request)
    {
        NewMessage::dispatch('hello');
//        $conversation = Conversation::create([
//            'message' => request('message'),
//            'key_chat' => request('group_id'),
//            'manager_id' => $this->chat
//        ]);
//
//        broadcast(new NewMessage($conversation));
    }

    public function verbation(Request $request)
    {
        $manager = Manager::where('chat_id', 'LIKE', $request->chat_id)->update(['client_id' => $request->client_id]);
        return response()->json([
            'data' => $manager
        ]);
    }

    public function store()
    {
        $this->setChat(request('client_id'));
        $conversation = Conversation::create([
            'name' => 'manager',
            'message' => request('message'),
            'key_chat' => request('client_id'),
            'manager_id' => $this->chat
        ]);

        return response()->json($conversation);
    }

    public function setChat($client_id = null)
    {
        $data = DB::table('managers')
        ->where('status','LIKE','open')
        ->orWhere('client_id','LIKE', $client_id)
        ->first();

        $this->chat = $data->chat_id;
    }

}
