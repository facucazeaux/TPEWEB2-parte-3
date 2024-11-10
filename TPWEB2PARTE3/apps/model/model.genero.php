<?php
require_once 'config.php';
class model_genero
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
        $query = $this->db->query('SHOW TABLES LIKE "genero"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                CREATE TABLE `genero` (`id_genero` int(45) NOT NULL,`genero` varchar(45) NOT NULL,`descripcion` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                INSERT INTO `genero` (`id_genero`, `genero`, `descripcion`) VALUES(11, 'Romance', 'El cine romántico es un género cinematográfico que se caracteriza por retratar argumentos construidos de eventos y personajes relacionados con la expresión del amor y las relaciones románticas.'),(12, 'Terror', 'El terror es una sensación de miedo muy intensa. El miedo se define como una perturbación angustiosa del ánimo por un riesgo real o imaginario; cuando éste supera los controles cerebrales y el sujeto no puede pensar de forma racional, aparece el terror.')(13, 'Accion', 'Generalmente son series que aportan un toque de adrenalina. Incluyen acrobacias físicas, persecuciones rescates y batallas, lo que las caracteriza principalmente.'),(14, 'Ciencia Ficcion', 'La ciencia ficción es un género narrativo que sitúa la acción en unas coordenadas espacio-temporales imaginarias y diferentes a las nuestras, y que especula racionalmente sobre posibles avances científicos o sociales y su impacto en la sociedad.'),(15, 'Fantasia', 'es fantastico xd'),(16, 'Drama', 'El género de drama en televisión se caracteriza por su enfoque en el desarrollo emocional y psicológico de los personajes, así como en la exploración de conflictos humanos profundos y realistas. Estas series a menudo abordan temas complejos y provocativos, como las relaciones interpersonales, la moralidad, la lucha por el poder, la identidad y la condición humana.'),(17, 'Comedia', 'La comedia es un género narrativo que busca provocar la risa y el entretenimiento a través de situaciones humorísticas, personajes peculiares y diálogos ingeniosos. A menudo, se centra en los aspectos cómicos de la vida cotidiana, explorando las relaciones humanas, los malentendidos y las ironías de la existencia.');
                END;
            $this->db->query($sql);
        }
    }

            public function getCategorias()
                {
                    $query = $this->db->prepare('SELECT * FROM genero');
                    $query->execute();
                    $genero = $query->fetchAll(PDO::FETCH_OBJ);
                    return $genero;


                }

                public function getGeneroPorId($id) {
                    $query = "SELECT * FROM genero WHERE id_genero = ?";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([$id]);
                    return $stmt->fetch(PDO::FETCH_OBJ);
                }




                public function getSeriesPorGenero($id_genero)
                {
                   
                    $query = $this->db->prepare('SELECT * FROM serie WHERE id_genero = ?');
                    $query->execute([$id_genero]);
                    $series = $query->fetchAll(PDO::FETCH_OBJ);
                    return $series;
                }

                public function Agregar_Genero($genero, $descripcion) {
                    try {
                        $query = $this->db->prepare('INSERT INTO `genero`(`genero`, `descripcion`) VALUES (?, ?)');
                        $query->execute([$genero, $descripcion]);
                        return true; 
                    } catch (PDOException $e) {
                        
                        return false; 
                    }
                }
                
                
    
    
                public function EliminarGenero($id)
                {
                    $query = $this->db->prepare('DELETE FROM `genero` WHERE `id_genero` = ?');
                    $query->execute([$id]);
                    return $query;
                }
    
                
                public function EditarGenero($id_genero, $genero, $descripcion) {
                    try {
                      
                        $query = $this->db->prepare('UPDATE genero SET genero = ?, descripcion = ? WHERE  `id_genero` = ?');
                        
                        
                        $resultado = $query->execute([$genero, $descripcion, $id_genero]);
                        
                       return   $resultado;
                
                    } catch (PDOException $e) {
                        echo 'Error al editar el genero: ' . $e->getMessage();
                        return false;
                    }
                }
                
                
    


        }
