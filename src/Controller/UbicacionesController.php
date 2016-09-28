<?php
namespace App\Controller;

use Cake\Event\Event;

class UbicacionesController extends AppController {

  public function index(){
    $uid = $this->Auth->user('id');
    $this->loadModel('Users');
    $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
    $ubicaciones = $this->Ubicaciones->find('all')->where(['Ubicaciones.id_centro' => $usuarios->first()->id_centro]);
    $this->set(compact('ubicaciones'));
  }

  public function add(){
      $uid = $this->Auth->user('id');
      $this->loadModel('Users');
      $this->loadModel('Centros');
      $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
      $centros = $this->Centros->find('all')->where(['Centros.idcentros' => $usuarios->first()->id_centro]);
      $ubicacion = $this->Ubicaciones->newEntity();
      if ($this->request->is('post')) {
          $ubicacion = $this->Ubicaciones->patchEntity($ubicacion, $this->request->data);
          $ubicacion->id_centro = $centros->first()->idcentros;
          if ($this->Ubicaciones->save($ubicacion)) {
              $this->Flash->success(__('Se ha guardado su ubicación con exito'));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('No se ha podido guardar la ubicación'));
      }
      $this->set('ubicacion', $ubicacion);
  }

  public function edit($idubicaciones = null){
      $ubicacion = $this->Ubicaciones->get($idubicaciones);
      if ($this->request->is(['post', 'put'])) {
          $this->Ubicaciones->patchEntity($ubicacion, $this->request->data);
          if ($this->Ubicaciones->save($ubicacion)) {
              $this->Flash->success(__('Tu ubicación ha sido actualizada.'));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('Tu ubicación no se ha podido actualizar.'));
      }

      $this->set('ubicacion', $ubicacion);
  }

  public function delete($id)
  {
      $this->request->allowMethod(['post', 'delete']);

      $ubicacion = $this->Ubicaciones->get($id);
      if ($this->Ubicaciones->delete($ubicacion)) {
          $this->Flash->success(__('La ubicación ha sido eliminada correctamente.'));
          return $this->redirect(['action' => 'index']);
      }
  }

  public function beforeFilter(Event $event)
  {
      $this->Auth->allow(['index', 'edit' , 'delete', 'add']);
  }
}
