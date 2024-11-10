<?php

require_once 'config.php';
    class model_series
        {

            //private $db;
            protected $db;

            public function __construct()
                
            {
               
                try {
                    $this->db = new PDO(
                        "mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
                    
                    $this->_deploy();
                } catch (PDOException $e) {
                    // Manejo de errores en la conexión
                    echo "Error de conexión: " . $e->getMessage();
                }
            }


            
            private function _deploy()
            {
                $query = $this->db->query(('SHOW TABLES LIKE "serie"'));
                $tables = $query->fetchAll();
                if (count($tables) == 0) {
                    $sql = <<<END
                               
                        CREATE TABLE `serie` (`id` int(45) NOT NULL,`nombre` varchar(45) NOT NULL,`temporadas` int(45) NOT NULL,`protagonistas` varchar(250) NOT NULL,`director` varchar(45) NOT NULL,`CalificacionPorEdad` varchar(5) NOT NULL,`resumen` text NOT NULL,`id_genero` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                        INSERT INTO `serie` (`id`, `nombre`, `temporadas`, `protagonistas`, `director`, `CalificacionPorEdad`, `resumen`, `id_genero`) VALUES (7, 'Outer Banks', 3, 'Madelyn Cline , Rudy Pankow, Chase Stokes, Jo', 'Jonas Pate', '16', 'Outer Banks sigue a un grupo de adolescentes en los Bancos Externos de Carolina del Norte llamados a sí mismos «Pogues» y están decididos a averiguar qué le sucedió al padre desaparecido del cabecilla del grupo, John B. (Chase Stokes). En el camino, descubren un tesoro legendario relacionado con el padre de John B.6​\\r\\n\\r\\nPerseguidos por la ley y un grupo rico y superior llamado los «Kook» de Figure Eight, los Pogues buscan superar obstáculos como las drogas, el amor, la lucha, la amistad, el dinero y cómo los ricos siguen ganando para completar el objetivo del padre de John B. en el que había estado trabajando durante 20 años.', 14),(8, 'El hipnotizador ', 2, 'Leonardo Sbaraglia, Chico Díaz, César Troncoso, Marilú Marini, Juliana Didone, Bianca Comparato, Chino Darín, Christiana Ubach y Delfi Galbiati', 'Alex Gabasi y José Eduardo Belmonte', '16', 'Un hipnotizador condenado a un insomnio eterno que se dedica a adormecer a la gente y desenterrar sus recuerdos perdidos.', 13),(13, 'The Last of Us', 1, 'Pedro Pascal , Bella Ramsey', 'Jesse Peretz, Jeff Chan, Erica Dunton', '16', 'The Last of Us es una serie de televisión estadounidense postapocalíptica que se estrenó el 15 de enero de 2023 a través de HBO. Basada en el videojuego de 2013 del mismo nombre desarrollado por Naughty Dog. La serie sigue a Joel (Pedro Pascal), un contrabandista encargado de escoltar a la adolescente Ellie (Bella Ramsey) a través de un Estados Unidos postapocalíptico. También cuenta con Tommy (Gabriel Luna), el hermano menor de Joel y exsoldado.', 14),(16, 'El verano en que me enamore', 2, 'Lola Tung, Jackie Chung, Rachel Blanchard, Christopher Briney, Gavin Casalegno, Sean Kaufman, Alfredo Narciso, Minnie Mills, Colin Ferguson, Tom Everett Scott, Rain Spencer, JP Lambert, Summer Madison, David Iacono, Sarah Hudson, Rea DeRosa, Al Vicen', 'Jesse Peretz, Jeff Chan, Erica Dunton', '18', 'Belly Conklin está por cumplir 16 años y va a su lugar favorito en el mundo, la playa de Cousins, para pasar el verano con su familia y los Fisher. Belly ha crecido mucho durante el último año y siente que este verano será diferente a los anteriores. El verano en que me enamoré está basado en el libro de Jenny Han, quien es la creadora y productora ejecutiva.', 11),(21, 'xdxdx', 2, 'adada', 'dadad', 'adada', 'adadada', 16);
                        END;
                    $this->db->query($sql);
                }
            }



            public function getTodoLosItems()
                {
                    $query = $this->db->prepare('SELECT * FROM serie');
                    $query->execute();
                    $movies = $query->fetchAll(PDO::FETCH_OBJ);
                    return $movies;
                }

               

                public function SerieDetalleById($id)
                    {
                        $query = $this->db->prepare('SELECT * FROM serie WHERE id = ?');
                        $query->execute([$id]);
                        return $query->fetch(PDO::FETCH_OBJ);
                    }

                

                public function Agregar_Serie($nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $id_genero) {
                    try {
                        $query = $this->db->prepare('INSERT INTO `serie`(`nombre`, `temporadas`, `protagonistas`, `director`, `CalificacionPorEdad`, `resumen`, `id_genero`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute([$nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $id_genero]);
                        echo 'Serie agregada correctamente'; 
                    } catch (PDOException $e) {
                        echo 'Error al agregar la serie: ' . $e->getMessage();
                    }
                }
                
    
    
                public function EliminarSerie($id)
                {
                    $query = $this->db->prepare('DELETE FROM `serie` WHERE `id` = ?');
                    $query->execute([$id]);
                    return true;
                    
                }
    
                
                public function EditarSerie($id, $nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $id_genero) {
                    try {
                       
                        $query = $this->db->prepare('UPDATE `serie`
                                                        SET `nombre` = ?,
                                                            `temporadas` = ?,
                                                            `protagonistas` = ?,
                                                            `director` = ?,
                                                            `CalificacionPorEdad` = ?,
                                                            `resumen` = ?,
                                                            `id_genero` =?
                                                        WHERE `id` = ?');
                        
                       
                        $resultado = $query->execute([$nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen,$id_genero, $id]);
                        
                       
                        if ($query->rowCount() > 0) {
                            return true; // La serie fue actualizada correctamente
                        } else {
                            return false; // No se actualizó la serie 
                        }
                
                    } catch (PDOException $e) {
                        echo 'Error al editar la serie: ' . $e->getMessage();
                        return false;
                    }
                }
                
                
    

        }
                



        


?>