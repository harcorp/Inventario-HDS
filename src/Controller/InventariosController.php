<?php
namespace App\Controller;

use Cake\I18n\Time;
use Cake\I18n\Number;
use Cake\Event\Event;

class InventariosController extends AppController {

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);
    }
  public function index(){
    $this->loadModel('CuentasPuc');
    $this->loadModel('SubcuentasPuc');
    $this->loadModel('Ubicaciones');
    $this->loadModel('Users');
    $uid = $this->Auth->user('id');
    $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
    $cuentas = $this->CuentasPuc->find('all');
    $subcuentas = $this->SubcuentasPuc->find('all');
    if($this->Auth->user('role') == 2 || $this->Auth->user('role') == 3){
        $inventarios = $this->Inventarios->find('all')->where(['Inventarios.id_centro' => $usuarios->first()->id_centro]);
    }else{
        $inventarios = $this->Inventarios->find('all');
    }
    $ubicaciones = $this->Ubicaciones->find('all')->where(['Ubicaciones.id_centro' => $usuarios->first()->id_centro]);
    $this->set('cuentas',$cuentas);
    $this->set('subcuentas',$subcuentas);
    $this->set('ubicaciones', $ubicaciones);
    $this->set(compact('inventarios'));
  }

  public function delete($id)
  {
      $this->request->allowMethod(['post', 'delete']);

      $inventario = $this->Inventarios->get($id);
      if ($this->Ubicaciones->delete($inventario)) {
          $this->Flash->success(__('El producto ha sido eliminado correctamente.'));
          return $this->redirect(['action' => 'index']);
      }
  }

  public function add(){
    $uid = $this->Auth->user('id');
    $this->loadModel('ClasesPuc');
    $this->loadModel('GruposPuc');
    $this->loadModel('CuentasPuc');
    $this->loadModel('SubcuentasPuc');
    $this->loadModel('Centros');
    $this->loadModel('Users');
    $this->loadModel('Ubicaciones');
    $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
    $ubicaciones = $this->Ubicaciones->find('all')->where(['Ubicaciones.id_centro' => $usuarios->first()->id_centro]);
    $clases = $this->ClasesPuc->find('all');
    $grupos = $this->GruposPuc->find('all');
    $cuentas = $this->CuentasPuc->find('all');
    $subcuentas = $this->SubcuentasPuc->find('all');
    $centros = $this->Centros->find('all')->where(['Centros.idcentros' => $usuarios->first()->id_centro]);
    $idcentro = $centros->first()->id;
    $this->set('clases',$clases);
    $this->set('grupos',$grupos);
    $this->set('cuentas',$cuentas);
    $this->set('subcuentas',$subcuentas);
    $this->set('ubicaciones', $ubicaciones);
    $this->set('idcentro', $idcentro);

    $inventario = $this->Inventarios->newEntity();
    if ($this->request->is('post')) {
        $inventario = $this->Inventarios->patchEntity($inventario, $this->request->data);
        $inventario->user_id = $this->Auth->user('id');
        $inventario->id_centro = $usuarios->first()->id_centro;
        if ($this->Inventarios->save($inventario)) {
            $this->Flash->success(__('Su articulo ha sido guardado satisfactoriamente'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('No se ha podido agregar satisfactoriamente el articulo'));
    }
    $this->set('inventario', $inventario);

    $ls = $this->Inventarios->find('all')->select(['idinventarios'])->last();
    if($ls){
    $lastid = $ls->idinventarios;
    }else{
      $lastid = 0;
    }
    $this->set('lastid', $lastid);
  }

  public function edit($id = null){
    $this->loadModel('Users');
    $this->loadModel('Ubicaciones');
    $this->loadModel('ClasesPuc');
    $this->loadModel('GruposPuc');
    $this->loadModel('CuentasPuc');
    $this->loadModel('SubcuentasPuc');
      $inventario = $this->Inventarios->get($id);
      if ($this->request->is(['post', 'put'])) {
          $this->Inventarios->patchEntity($inventario, $this->request->data);
          if ($this->Inventarios->save($inventario)) {
              $this->Flash->success(__('El producto ha sido actualizado correctamente.'));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('El producto no se ha podido actualizar.'));
      }

      $this->set('inventario', $inventario);
      $uid = $this->Auth->user('id');
      $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
      $ubicaciones = $this->Ubicaciones->find('all')->where(['Ubicaciones.id_centro' => $usuarios->first()->id_centro]);
      $clases = $this->ClasesPuc->find('all');
      $grupos = $this->GruposPuc->find('all');
      $cuentas = $this->CuentasPuc->find('all');
      $subcuentas = $this->SubcuentasPuc->find('all');
      $this->set(compact('ubicaciones'));
      $this->set('clases',$clases);
      $this->set('grupos',$grupos);
      $this->set('cuentas',$cuentas);
      $this->set('subcuentas',$subcuentas);

  }


  public function view($id = null){
    $uid = $this->Auth->user('id');
    $this->loadModel('ClasesPuc'); //if it's not already loaded
    $this->loadModel('GruposPuc');
    $this->loadModel('CuentasPuc');
    $this->loadModel('SubcuentasPuc');
    $this->loadModel('Users');
    $usuario_datos = $this->Users->find('all')->where(['Users.id' => $uid]);
    $clases = $this->ClasesPuc->find('all');
    $grupos = $this->GruposPuc->find('all');
    $cuentas = $this->CuentasPuc->find('all');
    $subcuentas = $this->SubcuentasPuc->find('all');
    $inventario = $this->Inventarios->get($id);
    $usuario = $this->Auth->user();
    $depreciacion = $inventario->tiempo_depreciacion;
    $valor = $inventario->valor;
    $fecha = $inventario->fecha_compra;
    $resultado = $this->calcular($depreciacion, $valor, $fecha);
    $codigounico = $this->codigoUnico($inventario->id_clase, $inventario->id_grupo, $inventario->id_cuenta, $inventario->id_subcuenta_real, $usuario_datos->first()->id_centro, $id);
    $this->set('resultado', $resultado);
    $this->set('clases',$clases);
    $this->set('grupos',$grupos);
    $this->set('cuentas',$cuentas);
    $this->set('subcuentas',$subcuentas);
    $this->set(compact('inventario'));
    $this->set(compact('usuario'));
    $this->set(compact('codigounico'));
  }

  public function calcular($dep, $val, $fec){
    $fec = str_replace("/", "-", $fec);
    $meses = $dep * 12;
    $dep_anual = $val / $dep;
    $dep_mensual = $val / $meses;
    $fechainicial = new Time($fec);
    $valor_compra = $val;
    $fechafinal = Time::now();
    $diferencia = $fechainicial->diff($fechafinal);
    $meses_compra = ( $diferencia->y * 12 ) + $diferencia->m;

    $valor_depreciado = $dep_mensual * $meses_compra;
    $mes[] = ['mes' => $val];

    $nom_meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    if($fechainicial->year == $fechafinal->year){
      for ($i = 0; $i <= $meses_compra; ++$i) {
          $val = $val - $dep_mensual;
          $mes[] = ['mes' => $val];
      }
      for($i = $fechainicial->month - 1; $i <= $fechafinal->month - 1; ++$i){
            $meses_final[] = ['nom' => $nom_meses[$i]];
      }
    }else{
      for ($i = 0; $i <= $meses_compra / 12; ++$i) {
          $val = $val - $dep_mensual * 12;
          $mes[] = ['mes' => $val];
      }
      for($i = $fechainicial->year; $i <= $fechafinal->year; ++$i){
        $meses_final[] = ['nom' => $i];

      }
    }


    $valor_depreciado = $valor_compra - $valor_depreciado;
    $valor_depreciado = Number::currency($valor_depreciado,'USD', [
    'places' => 0
    ]);

    $valor_depreciado = str_replace(",", ".", $valor_depreciado);
    $valor_compra = Number::currency($valor_compra,'USD', [
    'places' => 0
    ]);
    $valor_compra = str_replace(",", ".", $valor_compra);

    $final[] = ['valores' => $mes, 'nombres' => $meses_final, 'valor_dep' => $valor_depreciado, 'valor_com' => $valor_compra];
    return $final;
  }

  public function depreciacion($dep, $val, $fec){
      $fec = str_replace("/", "-", $fec);
      $meses = $dep * 12;
      $dep_anual = $val / $dep;
      $dep_mensual = $val / $meses;
      $fechainicial = new Time($fec);
      $valor_compra = $val;
      $fechafinal = Time::now();
      $diferencia = $fechainicial->diff($fechafinal);
      $meses_compra = ( $diferencia->y * 12 ) + $diferencia->m;
      $valor_depreciado = $dep_mensual * $meses_compra;
      return $valor_depreciado;
  }

  public function reportes(){
         $respuesta = $this->request->query('id_cuenta');
         $this->set('clase', $respuesta);
         $conditions = array();
         $this->loadModel('ClasesPuc');
         $this->loadModel('GruposPuc');
         $this->loadModel('CuentasPuc');
         $this->loadModel('SubcuentasPuc');
         $this->loadModel('Ubicaciones');
         $this->loadModel('Users');
         $uid = $this->Auth->user('id');
         $usuarios = $this->Users->find('all')->where(['Users.id' => $uid]);
         $clases = $this->ClasesPuc->find('all');
         $grupos = $this->GruposPuc->find('all');
         $cuentas = $this->CuentasPuc->find('all');
         $subcuentas = $this->SubcuentasPuc->find('all');
         $ubicaciones = $this->Ubicaciones->find('all')->where(['Ubicaciones.id_centro' => $usuarios->first()->id_centro]);
         $this->set('clases',$clases);
         $this->set('grupos',$grupos);
         $this->set('cuentas',$cuentas);
         $this->set('subcuentas',$subcuentas);

         $clase = 0;
         $grupo = 0;
         $cuenta = 0;
         $subcuenta = 0;
         if(($this->request->is('post') || $this->request->is('put')) && isset($this->request->data)){
			// for each filter we will add a GET parameter for the generated url
			foreach($this->request->data as $name => $value){
				if($value){
					// You might want to sanitize the $value here
					// or even do a urlencode to be sure
					$filter_url[$name] = urlencode($value);
				}
			}
			// now that we have generated an url with GET parameters,
			// we'll redirect to that page

			return $this->redirect($filter_url);
		}else{
            if($this->Auth->user('id_centro') > 1){
                $this->request->query['id_centro'] = $usuarios->first()->id_centro;
            }
            //$this->request->query(['id_centro' => $usuarios->first()->id_centro]);
			// Inspect all the named parameters to apply the filters
			foreach($this->request->query as $param_name => $value){
        $conditions['Inventarios.'.$param_name] = $value;
				$this->request->query[$param_name] = $value;

                switch($param_name){
                    case "id_clase":
                        $clase = $value;
                        break;
                    case "id_grupo":
                        $grupo = $value;
                        break;
                    case "id_cuenta":
                        $cuenta = $value;
                        break;
                    case "id_subcuenta":
                        $subcuenta = $value;
                        break;
                }
			}
		}

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => 500
        );
        $this->set('inventarios', $this->paginate());
        $this->set('ubicaciones', $ubicaciones);
        $filtros = array($clase, $grupo, $cuenta, $subcuenta);
        $this->set(compact('filtros'));
        $val_total = 0;
        $cantidad_total = 0;
        $dep_total = 0;
        foreach($this->paginate() as $inventario){
            $val_total = $val_total + $inventario->valor;
            //$val_total = $val_total + 1;
            $cantidad_total = $cantidad_total + 1;
            $dep_total = $dep_total + $this->depreciacion($inventario->tiempo_depreciacion, $inventario->valor, $inventario->fecha_compra);
        }
        $val_total = Number::currency($val_total,'USD', [
            'places' => 0
        ]);
        $val_total = str_replace(",", ".", $val_total);
        $dep_total = Number::currency($dep_total,'USD', [
            'places' => 0
        ]);
        $dep_total = str_replace(",", ".", $dep_total);
        $resultado[] = ["val_total" => $val_total, "cant_total" => $cantidad_total, "dep_total" => $dep_total];
        $this->set('resultado', $resultado);
  }

  public function isAuthorized($user)
  {
      // All registered users can add articles
      if ($this->request->action === 'add' || $this->request->action === 'view' || $this->request->action === 'reportes') {
          return true;
      }
      if (in_array($this->request->action, ['edit', 'delete'])) {
          $inventarioId = (int)$this->request->params['pass'][0];
          if ($this->Inventarios->isOwnedBy($inventarioId, $user['id_centro'])) {
              if($user['role'] == 2){
                  return true;
              }
          }else if ($user['role'] == 1){
            return true;
          }
          $this->Flash->error(__('No tiene autorización para esta acción'));
      }

      return parent::isAuthorized($user);
  }

  public function codigoUnico($clase, $grupo, $cuenta, $subcuenta, $centro, $id){
    return $centro . $clase . $grupo . $cuenta . $subcuenta . $id;
  }

}
