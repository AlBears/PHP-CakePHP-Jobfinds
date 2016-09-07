<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Table;

class JobsController extends AppController
{
  public $name = 'Jobs';

  /*
  * Default Index Method
  */
  public function index()
    {

      $getJobs = TableRegistry::get('Jobs');
      $jobs = $getJobs->find('all')->contain(['Types']);
      $this->set('jobs', $jobs);
    }
}
