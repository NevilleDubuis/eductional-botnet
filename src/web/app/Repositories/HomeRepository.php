<?php
namespace App\Repositories;

use App\User;
use App\Group;
use Illuminate\Support\Str;

class UserRepository
{
    protected $dashboard;

    public function __construct(User $dashboard)
    {
        $this->dashboard = $dashboard;
    }


}
