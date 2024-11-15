<?php

    require_once 'apps/View/json.view.php';
    require_once 'apps/model/model.series.php';
    require_once 'apps/model/model.genero.php';


    class controllerSerie
        {
            private $view;
            private $model;
            


                public function __construct()
                {
                    
                    $this->model = new model_series();

                    $this->view = new JSONView();

                   
                }


                public function getAll($req,$res)

                {   

                   
            

                    $orderBy = isset($req->query->orderBy) ? $req->query->orderBy : null; //con que criterio va a ordenar
                    $ordenar = isset($req->query->ordenar) ? ($req->query->ordenar) : 'ASC'; // el sentido de como ordena



                     
                    $Filtro = isset($req->query->filtro) ? $req->query->filtro : null;// con este filtramos las series segun una condicion como temporadas o nombre

                   
                    $filtroValor = isset($req->query->valor) ? $req->query->valor : null;// aca le damos el valor al filtro ponemos el numero de temporadas o el nombre de esta para poder buscarla

                    if ($Filtro && !$filtroValor) {
                        return $this->view->response("Se requiere un valor para el filtro '$Filtro'.", 400);
                    }

                    
                    if ($ordenar !== 'ASC' && $ordenar !== 'DESC') {
                        $ordenar = 'ASC';
                    }

                    $series = $this->model->getTodoLosItems($orderBy,$ordenar,$Filtro,$filtroValor);

                    if (empty($series)) {
                        return $this->view->response("No se encontraron series", 404);
                    }

                    return $this->view->response($series,200);
                }

                public function getById($req,$res)

                {   
                    $id = $req->params->id;

                    $serie = $this->model-> SerieDetalleById($id);

                    if(!$serie)
                    {
                        return $this->view->response("la serie no existe",404);
                    }
                    
                    return $this->view->response($serie, 200);

                }


                public function EliminarSerie($req,$res)

                {
                    if (!isset($res->user) || $res->user == null) {
                        return $this->view->response("Usuario no autenticado", 401);
                    }
                    $id = $req->params->id;

                    $serie = $this->model-> SerieDetalleById($id);

                    if(!$serie)
                    {
                        return $this->view->response("la serie no existe",404);
                    }
                    
                   $this->model->EliminarSerie($id);
                   $this->view->response("La serie se elimino correctamente ",200);

                }



              



                public function Agregar_Serie($req, $res)
                {   
                    if (!isset($res->user) || $res->user == null) {
                        return $this->view->response("Usuario no autenticado", 401);
                    }
                    
                    $nombre = $req->body->nombre;
                    $temporadas = $req->body->temporadas;
                    $protagonistas = $req->body->protagonistas;
                    $director = $req->body->director;
                    $CalificacionPorEdad = $req->body->CalificacionPorEdad;
                    $resumen = $req->body->resumen;
                    $genero = $req->body->genero;
                
                    
                    if (empty($nombre) || empty($temporadas) || empty($protagonistas) || empty($director) || empty($CalificacionPorEdad) || empty($resumen) || empty($genero)) {
                        return $this->view->response('Faltan completar datos', 400);
                    }
                
                    
                    $id = $this->model->Agregar_Serie($nombre, $temporadas, $protagonistas, $director, $CalificacionPorEdad, $resumen, $genero);
                
                   
                   
                    if ($id) {
                        return $this->view->response("La serie se agregó correctamente con el ID = $id ", 200);
                        } else {
                        return $this->view->response("La serie no se pudo agregar", 500);
                    }
                }   
                

                public function EditarSerie($req, $res)
                {   
                    if (!isset($res->user) || $res->user == null) {
                        return $this->view->response("Usuario no autenticado", 401);
                    }
                    $id = $req->params->id;
                
                    $serie = $this->model->SerieDetalleById($id);
                
                    if (!$serie) {
                        return $this->view->response("La serie con el id=$id no existe", 404);
                    }
                    
                   

                    if (empty($req->body->nombre) || empty($req->body->temporadas) || empty($req->body->protagonistas) || empty($req->body->director) || empty($req->body->CalificacionPorEdad) || empty($req->body->resumen) || empty($req->body->genero)) {
                        return $this->view->response("Faltan completar datos", 400);
                    }
                
                    $nombre = $req->body->nombre;
                    $temporadas = $req->body->temporadas;
                    $protagonistas = $req->body->protagonistas;
                    $director = $req->body->director;
                    $CalificacionPorEdad = $req->body->CalificacionPorEdad;
                    $resumen = $req->body->resumen;
                    $genero = $req->body->genero;
                
                    $result = $this->model->EditarSerie($id, $nombre, $temporadas, $protagonistas, $director, $CalificacionPorEdad, $resumen, $genero);
                
                    if ($result) {
                        return $this->view->response("La serie se actualizó correctamente", 200);
                    } else {
                        return $this->view->response("No se realizaron cambios en la serie", 200);
                    }
                }
                


            }
        