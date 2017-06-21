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


    if ($opcode == 16 || $opcode == 17) {
      $bot = $this->heartBeat($data, $bot);

      if ($bot->needInformation()) {
        return $this->askInformationReponse();
      } else {
        return $this->successResponse();
      }
    } elseif ($opcode == 32) {
      $bot = $this->storeInformation($data, $bot);
      return $this->successResponse();
    } else {
      return $this->badRequestResponse();
    }
  }

  protected function askInformationReponse()
  {
    return response()->json([
      'opcode' => 256
    ]);
  }

  protected function badRequestResponse()
  {
    return response()->json([], 400);
  }

  protected function successResponse()
  {
    return response()->json([]);
  }

  private function heartBeat(Array $data, Bot $bot = null)
  {
    if ($bot) {
      if ($data['opcode'] == 16) {
        $this->botRepository->update(['state' => 'connected'], $bot->id);
      } else {
        $bot->touch();
      }

    } else {
      $bot = $this->botRepository->create(['mac_address' => $data['payload']['macAddress'], 'state' => 'connected']);
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
