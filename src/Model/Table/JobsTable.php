<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Query;

class JobsTable extends Table
{
  //public $name = 'Job';
  public function initialize(array $config)
   {
       $this->table('jobs');
       $this->belongsTo('Types', [
         'foreignKey' => 'type_id',
         'joinType'=> 'INNER'
       ]);
       $this->belongsTo('Categories', [
         'foreignKey' => 'category_id',
         'joinType'=> 'INNER'
       ]);
  }

}
