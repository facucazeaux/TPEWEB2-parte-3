<?php

    class ModelUser

        
        {
            protected $db;

            public function __construct()
            {
                
                $this->db = new PDO("mysql:host=".'localhost' .";dbname=".'serie'.";charset=utf8", 'root', '');
                 
                        
                
            }
        
        
           



            public function getUsuarioByUsername($user)
                {
                    $query = $this->db->prepare('SELECT * FROM usuario WHERE user = ?');
                    $query->execute([$user]);
                    $user = $query->fetch(PDO::FETCH_OBJ);
                    return $user;   
                }
        }



?>