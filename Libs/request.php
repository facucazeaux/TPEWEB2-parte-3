<?php
    class Request {
        public $body = null; //nombre : 'Saludar', descripcion:'saludar a todos';
        public $params = null;/// api/series/:id;
        public $query = null; // ?soloTerror= true es el filtro para ordenar

        public function __construct() {
            try {
                $this->body = json_decode(file_get_contents('php://input'));
            }
            catch (Exception $e) {
                $this->body = null;
            }
            $this->query = (object) $_GET;
        }
    }
