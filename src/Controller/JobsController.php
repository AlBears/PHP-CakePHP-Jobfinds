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

  public function browse($category = null)
  {
    //Init Conditions Array
		$conditions = array();

    //Set Category Query Options
		$options = array(
				'order' => array('Categories.name' => 'asc')
		);
		//Get Categories
		$categories = $this->Jobs->Categories->find('all', $options);

		//Set Categories
		$this->set('categories', $categories);

		if($category != null){
			//Match Category
			$conditions[] =  array(
					'Jobs.category_id LIKE' => "" . $category . ""
			);
		}

		//Set Query Options
		$options = array(
				'order' => array('Jobs.created' => 'desc'),
				'conditions' => $conditions,
				'limit' => 8
		);
		//Get Job Info
    $getJobs = TableRegistry::get('Jobs');
    $jobs = $getJobs->find('all', $options)->contain(['Categories'])->contain(['Types'])->toArray();

		//Set Title
		$this->set('title_for_layout', 'JobFinds | Browse For A Job');

		$this->set('jobs', $jobs);
	 }

}
