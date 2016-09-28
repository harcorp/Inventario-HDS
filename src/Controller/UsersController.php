<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\MailerAwareTrait;

class UsersController extends AppController{

  use MailerAwareTrait;

  public function beforeFilter(Event $event){
      parent::beforeFilter($event);
      $this->Auth->allow(['logout']);
      //$this->Auth->allow('add');
  }

  public function index(){
    $uid = $this->Auth->user('id');
    $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
    if($this->Auth->user('role') == 2){
      $this->set('users', $this->Users->find('all')->where(['Users.id_centro' => $usuarios->first()->id_centro, 'Users.id !=' => $uid]));
    }else{
      $this->set('users', $this->Users->find('all'));
    }
  }

  public function changePassword($id = null){
    $user =$this->Users->get($id);
    if (!empty($this->request->data)) {
      $user = $this->Users->patchEntity($user, [
        'old_password' => $this->request->data['old_password'],
        'password' => $this->request->data['password1'],
        'password1' => $this->request->data['password1'],
        'password2' => $this->request->data['password2']
      ],
        ['validate' => 'password']
      );
        if ($this->Users->save($user)) {
          $this->Flash->success(__('La contraseña se cambio exitosamente'));
          return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error('Error durante el cambio de contraseña, intente nuevamente.');
      }
      $this->set('user',$user);
  }

  public function delete($id)
  {
      $this->request->allowMethod(['post', 'delete']);

      $user = $this->Users->get($id);
      if ($this->Users->delete($user)) {
          $this->Flash->success(__('El usuario con el id: {0} ha sido eliminado correctamente.', h($id)));
          return $this->redirect(['action' => 'index']);
      }
  }

  public function view($id){
    $user = $this->Users->get($id);
    $this->set(compact('user'));
  }

  public function add(){
    $this->loadModel('Centros');

    $centros = $this->Centros->find('all');
    $this->set('centros', $centros);
    $user = $this->Users->newEntity();
    if($this->request->is('post')){
      $user = $this->Users->patchEntity($user, $this->request->data);
      if($this->Users->save($user)){
        $this->Flash->success(__('El usuario ha sido creado con exito'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('No se ha podido crear el usuario.'));
    }
    $this->set('user', $user);
    $usuario = $this->Users->get($this->Auth->user('id'));

    $this->set('role', $this->Auth->user('role'));
    $this->set(compact($usuario));
  }

  public function login()
  {
      if ($this->request->is('post')) {
          $user = $this->Auth->identify();
          if ($user) {
              $this->Auth->setUser($user);
              return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Flash->error(__('Nombre de usuario y/o contraseña invalido, intente de nuevo'));
      }
  }

  public function logout(){
      return $this->redirect($this->Auth->logout());
  }


  public function isAuthorized($user)
  {
      if (isset($user['role']) && $user['role'] == 1 || $user['role'] == 2) {
          return true;
      }
      return false;
  }
}
