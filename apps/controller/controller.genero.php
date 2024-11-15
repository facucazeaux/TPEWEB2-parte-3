<?php

    require_once 'apps/View/json.view.php';
    require_once 'apps/model/model.series.php';
    require_once 'apps/model/model.genero.php';
    require_once 'Libs/jwt.php';
    require_once 'Libs/request.php';
    require_once 'Libs/response.php';

    class controllerGenero
    {
        private $view;
        private $model;
        

        public function __construct()
        { 
            $this->model = new model_genero();
            $this->view = new JSONView();
        }


    


        public function getAll($req, $res)
        {
            $orderBy = isset($req->query->orderBy) ? $req->query->orderBy : null;
            $ordenar = isset($req->query->ordenar) ? ($req->query->ordenar) : 'ASC'; // POR DEFAULT DEJAMOS QUE ORDENE ASCENDENTEMENTE
            //$genero = isset($req->query->genero) ? $req->query->genero : null;

            $Filtro = isset($req->query->filtro) ? $req->query->filtro : null;// con este filtramos los generos segun una condicion como genero o descripcion

                   
                    $filtroValor = isset($req->query->valor) ? $req->query->valor : null;// aca le damos el valor al filtro ponemos el nombre del genero que estamos buscando

                    if ($Filtro && !$filtroValor) {
                        return $this->view->response("Se requiere un valor para el filtro '$Filtro'.", 400);
                    }

            // Validamos que el orden solo sea 'ASC' o 'DESC'
            if ($ordenar !== 'ASC' && $ordenar !== 'DESC') {
                $ordenar = 'ASC';
            }
            
            

            $generos = $this->model->getCategorias($orderBy, $ordenar,$Filtro,$filtroValor);
        
            if (empty($generos)) {
                return $this->view->response("No se encontraron géneros", 404);
            }
            return $this->view->response($generos, 200);
        }
        




        public function getGeneroPorId($req,$res) {
            $id = $req->params->id;

            $genero = $this->model->getGeneroPorId($id);

            if(!$genero)
            {
                return $this->view->response("El género con el ID $id no existe.", 404);

            }
                
            return $this->view->response($genero, 200);

            }


            public function editarGenero($req, $res)
            {   
            
                if (!isset($res->user) || $res->user == null) {
                    return $this->view->response("Usuario no autenticado", 401);
                }
                //var_dump($res->user);
               
                    $id_genero = $req->params->id;
                    $genero = $req->body->genero;
                    $descripcion = $req->body->descripcion;
                
                    
                    if (empty($id_genero)) {
                        return $this->view->response("El id del género no puede estar vacío", 400);
                    }
                
                    
                    $generoExistente = $this->model->getGeneroPorId($id_genero);
                    if (!$generoExistente) {
                        return $this->view->response("El género con el id=$id_genero no existe", 404);
                    }
                
                    
                    if (empty($genero) || empty($descripcion)) {
                        return $this->view->response("Faltan completar datos", 400);
                    }
                
                    
                    $resultado = $this->model->EditarGenero($id_genero, $genero, $descripcion);
                
                    
                    if ($resultado) {
                        return $this->view->response("El género se editó correctamente", 200);
                    } else {
                        return $this->view->response("No se pudo editar el género", 500);
                    }
                
               
            }
            
            public function EliminarGenero($req, $res)
                {   

                    if (!isset($res->user) || $res->user == null) {
                        return $this->view->response("Usuario no autenticado", 401);
                    }
                    $id = $req->params->id;
                    $genero = $this->model->getGeneroPorId($id);
                    if(!$genero)
                        {
                            return $this->view->response("el genero no existe");
                        }

                     $this->model->EliminarGenero($id);
                     $this->view->response("El genero se elimino correctamente ",200);
                }


            public function Agregar_Genero($req,$res)

                {
                   

                    if (!isset($res->user) || $res->user == null) {
                        return $this->view->response("Usuario no autenticado", 401);
                    }
                    $genero = $req->body->genero;
                    $descripcion = $req->body->descripcion;
                
                    if (empty($genero) || empty($descripcion))
                        {
                            return $this->view->response('Falta completar datos',400);
                        }

                    $id = $this->model->Agregar_Genero($genero,$descripcion);

                    if($id)
                    {
                        return $this->view->response("El genero se agrego correctamente con el ID = $id",200);
                    }
                        else
                    {
                        return $this->view->response("El genero no se pudo agregar", 500);
                    }
                
                }

        }
    