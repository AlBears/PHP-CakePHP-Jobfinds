<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Query;

class TypesTable extends Table
{
  //public $name = 'Job';
  public function initialize(array $config)
   {
       $this->table('types');

  }

}
