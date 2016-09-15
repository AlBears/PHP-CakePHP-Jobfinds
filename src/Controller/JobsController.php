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
      //Set Category Query Options
  		$options = array(
  				'order' => array('Categories.name' => 'asc')
  		);
  		//Get Categories
  		$categories = $this->Jobs->Categories->find('all', $options);
  		//Set Categories
  		$this->set('categories', $categories);


      $getJobs = TableRegistry::get('Jobs');
      $jobs = $getJobs->find('all')->contain(['Types'])->toArray();
      $this->set('jobs', $jobs);
    }

  public function browse($category = null)
  {
      //Init Conditions Array
  		$conditions = array();

      //Check Keyword Filter
  		if($this->request->is('post')){
  			if(!empty($this->request->data('keywords'))){
  				$conditions[] =  array('OR' => array(
  					'Jobs.title LIKE' => "%" . $this->request->data('keywords') . "%",
  					'Jobs.description LIKE' => "%" . $this->request->data('keywords') . "%"
  				));
  			}
  		}
      //State Filter
  		if(!empty($this->request->data('state')) && $this->request->data('state') != 'Select State'){
  			//Match State
  			$conditions[] =  array(
  					'Jobs.state LIKE' => "%" . $this->request->data('state') . "%"
  			);
  		}
      //Category Filter
  		if(!empty($this->request->data('category')) && $this->request->data('category') != 'Select Category'){
  			//Match Category
  			$conditions[] =  array(
  					'Jobs.category_id LIKE' => "" . $this->request->data('category') . ""
  			);
  		}
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

  		$this->set('jobs', $jobs);
	 }

   public function view($id)
   {
       if(!$id){
  			throw new NotFoundException(__('Invalid job listing'));
  		}
      $getJobs = TableRegistry::get('Jobs');
      $conditions =  array(
          'Jobs.id LIKE' => "" . $id . ""
      );
      //Set Query Options
  		$options = array(
  				'conditions' => $conditions
  		);
      $job = $getJobs->find('all', $options)->contain(['Types'])->toArray();

  		if(!$job){
  			throw new NotFoundException(__('Invalid job listing'));
  		}

  		$this->set('job', $job);

   }
   public function add()
   {
       //Get Categories for select list
  		$options = array(
  				'order' => array('Categories.name' => 'asc')
  		);
  		//Get Categories
  		$categories = $this->Jobs->Categories->find('list', $options);
  		//Set Categories
  		$this->set('categories', $categories);

  		//Get types for select list
  		$types = $this->Jobs->Types->find('list');
  		//Set Types
  		$this->set('types', $types);

      $job = $this->Jobs->newEntity();
      if($this->request->is('post')){
        $this->request->data['Jobs']['user_id'] = 1;
        $job = $this->Jobs->patchEntity($job, $this->request->data);

      if($this->Jobs->save($job)){
         $this->Flash->set('Your job has been listed');
         return $this->redirect(array('action' => 'index'));
       }

       $this->Flash->set('Unable to add your job');
     }
   }


}
