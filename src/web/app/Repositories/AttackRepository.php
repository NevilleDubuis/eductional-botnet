<?php
namespace App\Repositories;

use App\Attack;
use App\User;
use Illuminate\Support\Str;

class AttackRepository
{
  protected $attack;

  public function __construct(Attack $attack)
  {
    $this->attack = $attack;
  }

  /**
    * @param array $columns
    * @return mixed
  */
  public function all() {
    return $this->attack->all();
  }

  public function running()
  {
    return $this->attack->running();
  }

  public function waiting()
  {
    return $this->attack->waiting();
  }

  public function finished() {
    return $this->attack->finnished();
  }

  /**
    * @param array $data
    * @return mixed
  */
  public function create(array $data) {

  }

  /**
    * @param array $data
    * @param $id
    * @param string $attribute
    * @return mixed
  */
  public function update(array $data, $id, $attribute="id") {
    return $this->attack
      ->where($attribute, '=', $id)
      ->update($data);
  }

  /**
    * @param $id
    * @return mixed
  */
  public function getById($id)
  {
    return $this->attack
      ->findOrFail($id);
  }

  /**
    * @param $attribute
    * @param $value
    * @return mixed
  */
  public function findBy($attribute, $value)
  {
    return $this->attack
      ->where($attribute, '=', $value)
      ->first();
  }

  /**
   * Pagination sur la liste des attaques
   *
   * @param  integer $n nombre d'attaques par page
   * @return Attack  attaque par rapport à la pagination
   */
  public function getPaginate($n)
  {
      return $this->attack->paginate($n);
  }

  /**
   * Sauvegarde des données attack
   *
   * @param  Attack   $attack
   * @param  Array    $inputs données saisie depuis un formulaire
   * @return void
   */
  private function save(Attack $attack, Array $inputs)
  {
      $attack->name = $inputs['name'];
      $attack->target = $inputs['target'];
      $attack->port = $inputs['port'];
      $attack->method_id = $inputs['method_selected'];
      $attack->duration = $inputs['duration'];
      $attack->bots_number = $inputs['bots_number'];

      $attack->save();
  }

  /**
   * Enregistrement d'une nouvelle attaque
   *
   * @param  Array  $inputs inputs depuis le formulaire view/attakcs/create
   * @return Attack $attack
   */
  public function store(Array $inputs, User $user)
  {
      $attack = new $this->attack;
      $attack->user_id = $user->id;
      $this->save($attack, $inputs);

      return $attack;
  }

  /**
   * Suppression d'une attaque
   *
   * @param  integer $id id de l'attaque à supprimer
   * @return void
   */
  public function destroy($id)
  {
      $this->getById($id)->delete();
  }
}
