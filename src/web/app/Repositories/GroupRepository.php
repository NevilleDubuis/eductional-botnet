<?php
namespace App\Repositories;

use App\Group;
use App\User;

class GroupRepository
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    private function save(Group $group, Array $inputs)
    {
        $group->name = $inputs['name'];

        $group->save();
    }

    public function getPaginate($n)
    {
        return $this->group->paginate($n);
    }

    public function store(Array $inputs)
    {
        $group = new $this->group;
        $group->name = $inputs['name'];
        $group->save();

        $group->users()->sync($inputs['users']);

        return $group;
    }

    public function getUsers()
    {
      return User::all();
    }

    public function getById($id)
    {
      return $this->group->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
      $group = $this->getById($id);
      $this->save($group, $inputs);
      $group->users()->sync($inputs['users']);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
