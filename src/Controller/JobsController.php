<?php
namespace App\Controller;

use App\Controller\AppController;

class JobsController extends AppController
{
  public $name = 'Jobs';

  /*
  * Default Index Method
  */
  public function index()
    {
      $options = array(
        'order' => array('Jobs.created'=> 'desc')
      );

      $jobs = $this->Jobs->find('all', $options);
      $this->set('jobs', $jobs);
    }
}
