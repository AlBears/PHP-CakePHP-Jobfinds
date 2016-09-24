<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('first_name', 'A first name is required')
            ->add('first_name', array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => __('Letters and numbers only')
            )))
            ->notEmpty('last_name', 'A last name is required')
            ->add('first_name', array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Letters and numbers only'
            )))
            ->notEmpty('email', 'An email is required')
            ->add('email', array(
            'alphaNumeric' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter an email address'
            )))
            ->notEmpty('password', 'A password is required')
            ->notEmpty('confirm_password', 'A confirm password is required')
            ->add('confirm_password', array(
            'alphaNumeric' => array(
          				'rule' => array('compareWith', 'password' ),
          				'message' => 'Your passwords do not match'
          )));
    }

}
