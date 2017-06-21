<?php
namespace App\Repositories;

use App\Method;
use Illuminate\Support\Str;

class MethodRepository
{
  protected $method;

  public function __construct(Method $method)
  {
    $this->method = $method;
  }

  /**
    * @param array $columns
    * @return mixed
  */
  public function all() {
    return $this->method->get();
  }

  /**
    * @param $id
    * @return mixed
  */
  public function getById($id)
  {
    return $this->method
      ->findOrFail($id);
  }

  /**
    * @param $attribute
    * @param $value
    * @return mixed
  */
  public function findBy($attribute, $value)
  {
    return $this->method
      ->where($attribute, '=', $value)
      ->first();
  }

  public function getPaginate($n)
  {
      return $this->method->paginate($n);
  }
}
