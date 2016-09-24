<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
  public function register()
    {
      $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'jobs', 'action' => 'index']);
            }
            if($user->errors()){
                $error_msg = [];
                foreach( $user->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[]    =   $error;
                        }
                    }else{
                        $error_msg[]    =   $errors;
                    }
                }

                if(!empty($error_msg)){
                    $this->Flash->error(
                        __("Please fix the following error(s):".implode("\n \r", $error_msg))
                    );
                }
            }

        }

        $this->set('user', $user);
    }
}
