<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Query;

class CategoriesTable extends Table
{
  //public $name = 'Job';
  public function initialize(array $config)
   {
       $this->table('categories');

  }

}
