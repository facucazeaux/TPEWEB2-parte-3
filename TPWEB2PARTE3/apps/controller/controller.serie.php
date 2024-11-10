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
                    

                    $series = $this->model->getTodoLosItems();

                    return $this->view->response($series);
                }

                public function getById($req,$res)

                {   
                    $id = $req->params->id;

                    $serie = $this->model-> SerieDetalleById($id);

                    if(!$serie)
                    {
                        return $this->view->response("la serie no existe",404);
                    }
                    
                    return $this->view->response($serie);
                }





            }