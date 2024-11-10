<?php
require_once 'config.php';
    class ModelUser

        
        {
            protected $db;

            public function __construct()
            {
                try {
                    $this->db = new PDO(
                        "mysql:host=".MYSQL_HOST .
                        ";dbname=".MYSQL_DB.";charset=utf8", 
                        MYSQL_USER, MYSQL_PASS);
                        
                  
                    $this->_deploy();
                } catch (PDOException $e) {
                   
                    echo "Error de conexión: " . $e->getMessage();
                }
            }
        
        
            private function _deploy()
            {
                $query = $this->db->query('SHOW TABLES LIKE "usuario"');
                $tables = $query->fetchAll();
                if (count($tables) == 0) {
                    $contraseña = password_hash('admin', PASSWORD_DEFAULT);
                    $sql = <<<END
                                CREATE TABLE `usuario` (`id` int(11) NOT NULL,`user` varchar(250) NOT NULL,`password` char(60) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                                INSERT INTO `usuario` (`id`, `user`, `password`) VALUES(6, 'webadmin', $contraseña');
        
                        END;
                    $this->db->query($sql);
                }
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