<?php
namespace App\Repositories;

use App\User;
use App\Group;
use Illuminate\Support\Str;

/**
 * Class de gestion des users
 */
class UserRepository
{
    protected $user;

    /**
     * Constructeur
     *
     * @param User $user [description]
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Sauvegarde des données users saisies dans le formulaire
     *
     * @param  User   $user   [description]
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->admin = isset($inputs['admin']);

        $user->save();
    }

    /**
     * Pagination sur la liste des users
     *
     * @param  [type] $n [description]
     * @return [type]    [description]
     */
    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }

    /**
     * Récupérer la liste des utilisateurs
     *
     * @return [type] [description]
     */
    private function queryWithGroup() {

      return $this->user->with('groups')
        ->orderBy('users.id', 'desc');
    }

    /**
     * Lister les users faisant partie du groupe sélectionné
     *
     * @param  [type] $group [description]
     * @param  [type] $n     [description]
     * @return [type]        [description]
     */
    public function getWithGroupForPaginate($group, $n)
    {
      return $this->queryWithGroup()
        ->whereHas('groups', function($q) use($group)
        {
          $q->where('groups.id', $group);
        })->paginate($n);
    }

    /**
     * Enregistrement d'un nouvel utilisateur
     *
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    public function store(Array $inputs)
    {
        $user = new $this->user;

        $user->password = bcrypt($inputs['password']);
        $this->save($user, $inputs);

        return $user;
    }

    /**
     * Récupérer un objet user en fonction de son ID
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    /**
     * Update des données d'un users
     *
     * @param  [type] $id     [description]
     * @param  Array  $inputs [description]
     * @return [type]         [description]
     */
    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

    /**
     * Suppression d'un utilisateur
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
