<?php
namespace App\Http\Controllers;

use App\Conversation;
use App\Manager;
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
        $this->setChat(request('client_id'));
    }

    public function message($message, $client_id, $status = null)
    {


        $keyboard = [
            ['client '. $client_id],
            ['Заблокировать'],
            ['Завершить']
        ];

        $reply_markup = $this->tg->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);

        if($status == 'close')
        {

            $this->setChat();
            if(empty($this->chat)){
                return false;
            }
        }

        if(!empty($message)){
            $this->tg->sendMessage([
                'chat_id' => $this->chat,
                'text'    => $message,
                'reply_markup' => $reply_markup
            ]);
        }else{
            $this->setChat(null);
            $this->tg->sendMessage([
                'chat_id' => $this->chat,
                'text'    => 'C вам хочет пообщаться клиент',
                'reply_markup' => $reply_markup
            ]);
        }

        return true;
    }

    public function setChat($client_id = null)
    {
        $data = Manager::where('status','=','open');
        if(!empty($client_id)){
            $data->orWhere('client_id','LIKE', $client_id);
        }
        $result = $data->first();
        if(!empty($result->chat_id)){
            $this->chat = $result->chat_id;
        }
    }


    public function store(Request $request)
    {
        if(empty(request('message'))){
            $manager = $this->message($request->message, $request->client_id, $request->status);

            if($manager == false){
                return response()->json([
                    'message' => 'Сейчас нет свободных Менеджеров'
                ]);
            }
        }else{
            $this->message(request('message'), request('client_id'));
        }

    }
}