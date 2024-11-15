<?php

class model_genero
        {

            protected $db;

            public function __construct()
                
            {
        
                    $this->db = new PDO("mysql:host=".'localhost' .";dbname=".'serie'.";charset=utf8", 'root', '');
                 
            }

            public function getCategorias($orderBy = null, $ordenar = 'ASC',$Filtro = null,$filtroValor = null)
            {
                $sql = 'SELECT * FROM genero';

                if ($Filtro && $filtroValor) {
                    $sql .= " WHERE $Filtro = :filtroValor";
                }
            
    
                if ($orderBy ) {
                    $sql .= " ORDER BY $orderBy $ordenar";
                }

                
            
                $query = $this->db->prepare($sql);

                if ($filtroValor) {
                    $query->bindParam(':filtroValor', $filtroValor, PDO::PARAM_STR);
                }
                $query->execute();

                
            
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            

                public function getGeneroPorId($id) {
                    $query = "SELECT * FROM genero WHERE id_genero = ?";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([$id]);
                    return $stmt->fetch(PDO::FETCH_OBJ);
                }




                public function getGeneroPornombre($categoria)
                {
                   
                    $query = $this->db->prepare('SELECT * FROM genero WHERE categoria = ?');
                    $query->execute([$categoria]);
                    $genero = $query->fetchAll(PDO::FETCH_OBJ);
                    return $genero;
                }

                public function Agregar_Genero($genero, $descripcion) {
                    try {
                        
                        $query = $this->db->prepare('INSERT INTO `genero`(`genero`, `descripcion`) VALUES (?, ?)');
                        
                        
                        $query->execute([$genero, $descripcion]);
                        
                        
                        $lastId = $this->db->lastInsertId();
                        
                        
                        return $lastId; 
                    } catch (PDOException $e) {
                        
                        error_log("Error al agregar el género: " . $e->getMessage());
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
