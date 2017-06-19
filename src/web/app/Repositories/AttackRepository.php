<?php
namespace App\Repositories;

use App\Attack;
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
    return $this->attack->get();
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
}
