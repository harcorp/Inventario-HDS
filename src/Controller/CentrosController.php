<?php
namespace App\Controller;

class CentrosController extends AppController {

  public function index(){
    $centros = $this->Centros->find('all');
    $this->set(compact('centros'));
  }

  public function add(){
      $this->loadModel('Ciudades');
      $this->loadModel('Departamentos');
      $departamentos = $this->Departamentos->find('all');
      $ciudades = $this->Ciudades->find('all');
      $centro = $this->Centros->newEntity();
      if ($this->request->is('post')) {
          $centro = $this->Centros->patchEntity($centro, $this->request->data);
          if ($this->Centros->save($centro)) {
              $this->Flash->success(__('Su centro de costos se ha creado correctamente.'));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('No se puede agregar el centro de costos. Revise la información'));
      }
      $this->set('centro', $centro);
      $this->set('ciudades', $ciudades);
      $this->set('departamentos', $departamentos);
  }

  public function edit($id = null){
      $centro = $this->Centros->get($id);
      if ($this->request->is(['post', 'put'])) {
          $this->Centros->patchEntity($centro, $this->request->data);
          if ($this->Centros->save($centro)) {
              $this->Flash->success(__('Tu centro de costos ha sido actualizado correctamente'));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('Tu centro de costos no se ha podido actualizar.'));
      }

      $this->set('centro', $centro);
  }

  public function delete($id)
  {
      $this->request->allowMethod(['post', 'delete']);

      $centro = $this->Centros->get($id);
      if ($this->Centros->delete($centro)) {
          $this->Flash->success(__('El centro de costos ha sido eliminado'));
          return $this->redirect(['action' => 'index']);
      }
  }

  public function isAuthorized($user = null)
  {

    if ($user['role'] == 2) {
        $this->Flash->error(__('No tiene autorización para esta sección'));
        $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));

        return false;
    }

    return parent::isAuthorized($user);
  }
}
