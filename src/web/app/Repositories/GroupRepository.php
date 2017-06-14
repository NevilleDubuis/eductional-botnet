<?php
namespace App\Repositories;

use App\Group;

class GroupRepository
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    private function save(Group $group, Array $inputs)
    {
        
        //$user->save();
    }

    public function getPaginate($n)
    {
        return $this->group->paginate($n);
    }

    public function store(Array $inputs)
    {
        // $user = new $this->user;
        //
        // $user->password = bcrypt($inputs['password']);
        // $this->save($user, $inputs);
        //
        // return $user;
    }

    public function getById($id)
    {
        return $this->group->findOrFail($id);
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
