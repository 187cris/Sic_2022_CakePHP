<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class UsuariosController extends AppController{
    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function logout () {
        //pega o resultado da autenticação
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            //executa a ação de sair da aplicação
            $this->Authentication->logout();

            return $this->redirect(['action' => 'login']);
        }
    }
    
    public function login() {
        $result = $this->Authentication->getResult();

        if($result->isValid()) {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Perguntas',
                'action' => 'index'
            ]);

            return $this->redirect($redirect);
        }
        
        if($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error("Usuário ou senha inválidos!");
        }

        return $this->render("login");
    }

    public function add() {
        $usuario = $this->Usuarios->newEmptyEntity();

        if($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            
            if($this->Usuarios->save($usuario)) {
                $this->Flash->success("Usuario criado com sucesso!");
                return $this->redirect(['action' => 'login']);
            }
            
            $this->Flash->error("Não foi possível criar o usuario!");
        }

        $this->set('usuario', $usuario);
    }
}