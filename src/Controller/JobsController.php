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

      //Set Query Options
		    $options = array(
			'order' => array('Jobs.created' => 'DESC'),
			'limit' => 10
		    );


      $getJobs = TableRegistry::get('Jobs');
      $jobs = $getJobs->find('all', $options)->contain(['Types'])->toArray();
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
      $jobs = $getJobs->find('all')->contain(['Types'])->toArray();
      $job = $getJobs->find('all', $options)->contain(['Types'])->toArray();

  		if(!$job){
  			throw new NotFoundException(__('Invalid job listing'));
  		}

  		$this->set('job', $job);
      $this->set('jobs', $jobs);

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
        $this->request->data['Jobs']['user_id'] = $this->Auth->user('id');
        $job = $this->Jobs->patchEntity($job, $this->request->data);

      if($this->Jobs->save($job)){
         $this->Flash->success('Your job has been listed');
         return $this->redirect(array('action' => 'index'));
       }

       $this->Flash->set('Unable to add your job');
     }
   }
   /*
	 * Edit Job
	 */
	 public function edit($id){
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

  		if(!$id){
  			throw new NotFoundException(__('Invalid job listing'));
  		}

  		$job = $this->Jobs->get($id);

  		if(!$job){
  			throw new NotFoundException(__('Invalid job listing'));
  		}

  		if($this->request->is(array('job', 'put'))){
  			$job = $this->Jobs->patchEntity($job, $this->request->data);


  			if($this->Jobs->save($job)){
  				$this->Flash->success(__('Your job has been updated'));
  				return $this->redirect(array('action' => 'index'));
  			}

  			$this->Flash->error(__('Unable to update your job'));
  		}
      $this->set('job', $job);

  	}
    public function delete($id)
    {
      $this->request->allowMethod(['post', 'delete']);

      $job = $this->Jobs->get($id);
      if ($this->Jobs->delete($job)) {
          $this->Flash->success(__('The job entry has been deleted'));
          return $this->redirect(['action' => 'index']);
      }
      }


}
