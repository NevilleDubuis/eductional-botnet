<?php
namespace App\Repositories;

use App\Group;
use App\User;

/**
 * [GroupRepository Class de gestion de Group]
 */
class GroupRepository
{
    protected $group;

    /**
     * Constructeur
     *
     * @param Group $group [description]
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Enregistrement des valeurs de groupe saisies dans le formulaire
     *
     * @param  Group  $group  [description]
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    private function save(Group $group, Array $inputs)
    {
        $group->name = $inputs['name'];
        $group->max_bot = $inputs['max_bot'];

        $group->save();
    }

    /**
     * Pagination sur les groupes
     *
     * @param  [type] $n [description]
     * @return [type]    [description]
     */
    public function getPaginate($n)
    {
        return $this->group->paginate($n);
    }

    /**
     * Enregistrement dans la DB du nouveau groupe créé
     *
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    public function store(Array $inputs)
    {
        $group = new $this->group;
        $group->name = $inputs['name'];
        $group->save();

        $group->users()->sync($inputs['users']);

        return $group;
    }

    /**
     * Récupérer la liste de tous les utilisateurs
     *
     * @return [type] Array de tous les users
     */
    public function getUsers()
    {
      return User::all();
    }

    /**
     * Récupérer un objet groupe en fonction de son ID
     *
     * @param  [type] $id ID du groupe recherché
     * @return [type]     Objet Group
     */
    public function getById($id)
    {
      return $this->group->findOrFail($id);
    }

    /**
     * update des données d'un groupe et mise à jour en cascade
     * en fonction des users faisant partie de ce groupe
     *
     * @param  [type] $id     [description]
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    public function update($id, Array $inputs)
    {
      $group = $this->getById($id);
      $this->save($group, $inputs);
      $group->users()->sync($inputs['users']);
    }

    /**
     * Suppression d'un groupe
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
