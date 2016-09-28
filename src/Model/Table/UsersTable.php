<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('email')
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'Ingrese un correo valido'
            ])
            ->notEmpty('username', 'Nombre de usuario requerido')
            ->notEmpty('password', 'Contraseña requerida')
            ->notEmpty('email', 'Ingrese un correo')
            ->notEmpty('role', 'A role is required')
            ->notEmpty('nombres', 'Los nombres son requeridos')
            ->notEmpty('apellidos', 'Los apellidos son requeridos')
            ->add('role', 'inList', [
                'rule' => ['inList', ['1', '2', '3']],
                'message' => 'Ingrese un perfil valido'
            ]);
            $validator->add('email', 'unique', [
            'rule' => 'validateUnique',
            'provider' => 'table',
            'message' => 'Este correo ya fue asignado'
        ]);

        $validator->add('username', 'unique', [
        'rule' => 'validateUnique',
        'provider' => 'table',
        'message' => 'Este nombre de usuario ya fue asignado'
    ]);
        return $validator;
    }

    public function validationPassword(Validator $validator ) {
      $validator = new Validator();
      $validator ->add('old_password','custom',[
        'rule'=> function($value, $context){
            $user = $this->get($context['data']['id']);
            if ($user) {
              if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                return true;
              }
            }
            return false;
          },
          'message'=>'La antigua contraseña no coincide.'
        ])->notEmpty('old_password', 'Contraseña antigua no puede estar vacia.');
      $validator ->add('password1', [
        'length' => [
          'rule' => ['minLength', 6],
          'message' => 'La contraseña debe tener minimo 6 caracteres'
          ]
          ])
          ->add('password1',[
            'match'=>[
              'rule'=> ['compareWith','password2'],
              'message'=>'No coinciden las contraseñas', ] ])
              ->notEmpty('password1', 'Contraseña nueva esta vacia.');
      $validator ->add('password2', [
        'length' => [
          'rule' => ['minLength', 6],
          'message' => 'La contraseña debe tener minimo 6 caracteres'
          ]
          ])
          ->add('password2',[
            'match'=>[
              'rule'=> ['compareWith','password1'],
              'message'=>'No coinciden las contraseñas'
              ]
              ])
              ->notEmpty('password2', 'Confirmacion de contraseña vacio.');
      return $validator;
    }
}
