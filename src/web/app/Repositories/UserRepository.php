<?php
namespace App\Repositories;

use App\User;
use App\Group;
use Illuminate\Support\Str;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->admin = isset($inputs['admin']);

        $user->save();
    }

    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }

    private function queryWithGroup() {

      return $this->user->with('groups')
        ->orderBy('users.id', 'desc');
    }

    public function getWithGroupForPaginate(Group $group, $n) {
      return $this->queryWithGroup()
        ->whereHas('groups', function($q) use($group){
          $q->where('groups.id', $group);
        })->paginate($n);
    }

    public function store(Array $inputs)
    {
        $user = new $this->user;

        $user->password = bcrypt($inputs['password']);
        $this->save($user, $inputs);

        return $user;
    }

    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
