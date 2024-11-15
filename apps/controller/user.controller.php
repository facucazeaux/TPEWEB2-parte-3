<?php

    require_once 'apps/model/model.user.php';
    require_once 'apps/View/json.view.php';
    require_once 'libs/jwt.php';

    class UserApiController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new ModelUser();
            $this->view = new JSONView();
        }

        public function getToken($req, $res) {
            
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; 
          
            
            $auth_header = explode(' ', $auth_header);
            if(count($auth_header) != 2) {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            if($auth_header[0] != 'Basic') {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            $user_pass = base64_decode($auth_header[1]);
            
            
            $user_pass = explode(':', $user_pass);
            $user = $this->model->getUsuarioByUsername($user_pass[0]);
           
            
            if($user == null || !password_verify($user_pass[1], $user->password)) {
              
                return $this->view->response("Error en los datos ingresados", 400);
            }
            
            
            $token = createJWT(array(
                'sub' => $user->id,
                'Usuario' => $user->user,
                'role' => 'admin',
                'iat' => time(),
                'exp' => time() + 120,
                'Saludo' => 'Hola '.$user->user,
            ));
           
            
            return $this->view->response($token);
        }
        
    }
