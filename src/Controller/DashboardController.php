<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Number;

class DashboardController extends AppController {

    public function index(){
        $this->loadModel('Inventarios');
        $this->loadModel('Users');
        $id_centro = $this->Auth->user('id_centro');
        $usuario = $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $usuario = $usuario->first();
        if($this->Auth->user('role') != 1){
            $cant_productos = $this->Inventarios->find('all')->where(['Inventarios.id_centro' => $id_centro])->count();
            $inventarios = $this->Inventarios->find('all')->where(['Inventarios.id_centro' => $id_centro]);
            $cant_usuarios = $this->Users->find()->count();
        }else{
            $cant_productos = $this->Inventarios->find()->count();
            $inventarios = $this->Inventarios->find('all');
            $cant_usuarios = $this->Users->find()->count();
        }
        $total = $this->totalInventarios($inventarios);
        $this->set('cant_productos', $cant_productos);
        $this->set('valor_total', $total);
        $this->set('cant_usuarios', $cant_usuarios);
        $this->set(compact('usuario'));
    }

    public function totalInventarios($inventarios){
        $valor = 0;
        foreach($inventarios as $inventario){
            $valor = $inventario->valor + $valor;
        }

        $valor = Number::currency($valor,'USD', [
        'places' => 0
        ]);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);
    }
}
