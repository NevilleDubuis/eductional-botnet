<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Log;
use Config;

use App\Bot;
use App\Attack;

class ManageBots extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'manage:bots';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Manage bots state';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    Log::info("-> Bots State manager started");
    $timeBetweenchecks = Config::get('settings.seconds_between_beats');

    while(true)
    {
      $this->manageBots();
      $this->manageAtacks();
      sleep($timeBetweenchecks);
    }
  }

  private function manageBots()
  {
    Log::info('--> Check bots connection');

    Bot::resetBotsConnection();
  }

  private function manageAtacks()
  {
    Log::info('--> Start possible attack');

    Attack::stopFinished();
    Attack::manageRunning();
    Attack::startWaiting();
  }
}
