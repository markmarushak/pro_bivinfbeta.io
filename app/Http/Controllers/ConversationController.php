<?php
namespace App\Http\Controllers;

use App\Conversation;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Api;

class ConversationController extends Controller
{

    private $tg;
    private $chat;
    function __construct()
    {
        $this->tg = new Api('798419976:AAEGP058AxX6pXBzHs88P7ETopD0dvqPXJ0');
        $this->setChat();
    }

    public function message($message, $client_id)
    {
        $keyboard = [
            ['Принять'],
            ['Заблокировать'],
            ['Завершить']
        ];

        $reply_markup = $this->tg->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);

        if(empty($message)){
            $this->tg->sendMessage([
                'chat_id' => $this->chat,
                'text'    => 'ID чата',
                'reply_markup' => $reply_markup
            ]);
            $text = $client_id;
        }else{
            $this->setChat($client_id);
            $text = $message;
        }

        $this->tg->sendMessage([
            'chat_id' => $this->chat,
            'text'    => $text,
            'reply_markup' => $reply_markup
        ]);
    }


    public function setChat($client_id = null)
    {
        $data = DB::table('managers')
        ->where('status','LIKE','open')
        ->orWhere('client_id','LIKE', $client_id)
        ->first();

        $this->chat = $data->chat_id;
    }


    public function store()
    {
        if(empty(request('message'))){
            $this->message(request('message'), request('client_id'));

        }else{
            $this->message(request('message'), request('client_id'));

            $conversation = Conversation::create([
                'name' => 'client',
                'message' => request('message'),
                'key_chat' => request('client_id'),
                'manager_id' => $this->chat
            ]);

            broadcast(new NewMessage($conversation));

            return response()->json($conversation);
        }

    }
}