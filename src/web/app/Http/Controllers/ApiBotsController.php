<?php

namespace App\Http\Controllers;

use App\Bot;

use Illuminate\Http\Request;

use App\Repositories\BotRepository;

class ApiBotsController extends Controller
{

  protected $botRepository;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(BotRepository $botRepository)
   {
      $this->botRepository = $botRepository;
   }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $data = $request->json()->all();
    $opcode = $data['opcode'];
    $macAddress = $data['payload']['macAddress'];
    $bot = $this->botRepository->findBy('mac_address', $macAddress);

    switch ($opcode) {
      case 16:
      case 17:
        $bot = $this->firstContact($data, $bot);

        if (!$bot->name) {
          return response()->json([
            'opcode' => 256
          ]);
        } else {
          return response()->json([]);
         }
        break;
      case 32:
        $bot = $this->storeInformation($data, $bot);
        return response()->json([]);
        break;
    }
  }

  private function firstContact(Array $data, Bot $bot = null)
  {
    if ($bot) {
      $this->botRepository->update(['state' => 'connected'], $bot->id);
    } else {
      $bot = $this->botRepository->create(['mac_address' => $data['payload']['macAddress']]);
    }

    return $bot;
  }

  private function storeInformation(Array $data, Bot $bot)
  {
    $bot = $this->botRepository->update([
      'name' => $data['payload']['computerName'],
      'cpu' => $data['payload']['cpu'],
      'operating_system' => $data['payload']['operatingSystem'],
    ], $bot->id);

    return $bot;
  }
}
