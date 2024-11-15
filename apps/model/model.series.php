<?php

    class model_series
        {

            
            protected $db;

            public function __construct()
                
            {
               
          
                    $this->db = new PDO("mysql:host=".'localhost' .";dbname=".'serie'.";charset=utf8", 'root', '');
                 
                        
            
            }
            

            
            



            public function getTodoLosItems($orderBy = null, $ordenar = 'ASC',$Filtro= null, $filtroValor = null )
                {
                    $sql = 'SELECT serie.id, serie.nombre, serie.temporadas, serie.protagonistas, serie.director,serie.protagonistas,serie.CalificacionPorEdad,serie.resumen, genero.genero 
                FROM serie 
            INNER JOIN genero ON serie.id_genero = genero.id_genero';

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




                

                public function SerieDetalleById($id)
                    {
                        $query = $this->db->prepare('
                        SELECT serie.id, serie.nombre, serie.temporadas, serie.protagonistas, serie.director,serie.protagonistas,serie.CalificacionPorEdad,serie.resumen, genero.genero AS genero
                        FROM serie
                        INNER JOIN genero ON serie.id_genero = genero.id_genero
                        WHERE serie.id = ?
                    ');
                    
                        $query->execute([$id]);
                        return $query->fetch(PDO::FETCH_OBJ);
                    }

                

                    public function Agregar_Serie($nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $nombreg) {
                       
                        $id_genero = $this->obtenerIdGeneroPorNombre($nombreg);
                        
                      
                        if (!$id_genero) {
                            return false; 
                        }

                        $query = "INSERT INTO serie (nombre, temporadas, protagonistas, director, calificacionPorEdad, resumen, id_genero) 
                                  VALUES ('$nombre', '$temporadas', '$protagonistas', '$director', '$calificacionPorEdad', '$resumen', '$id_genero')";
                        
                        
                        $this->db->query($query);
                        
                        
                        $id = $this->db->lastInsertId();
                        
                        return $id;
                    }
                    
                
    
    
                public function EliminarSerie($id)
                {
                    $query = $this->db->prepare('DELETE FROM `serie` WHERE `id` = ?');
                    $query->execute([$id]);
                    return true;
                    
                }
    
                
                public function EditarSerie($id, $nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $nombreGenero) {
                    try {
                      
                        $id_genero = $this->obtenerIdGeneroPorNombre($nombreGenero);
                        
                      
                        if (!$id_genero) {
                            return false; 
                        }
                
                        
                        $query = $this->db->prepare('UPDATE `serie`
                                                     SET `nombre` = ?,
                                                         `temporadas` = ?,
                                                         `protagonistas` = ?,
                                                         `director` = ?,
                                                         `CalificacionPorEdad` = ?,
                                                         `resumen` = ?,
                                                         `id_genero` = ?
                                                     WHERE `id` = ?');
                        
                       
                        $resultado = $query->execute([$nombre, $temporadas, $protagonistas, $director, $calificacionPorEdad, $resumen, $id_genero, $id]);
                        
                       
                        if ($query->rowCount() > 0) {
                            return true; 
                        } else {
                            return false;
                        }
                    
                    } catch (PDOException $e) {
                       
                        echo 'Error al editar la serie: ' . $e->getMessage();
                        return false;
                    }
                }
                
                public function obtenerIdGeneroPorNombre($nombreGenero)
                {
                    
                    $sql = 'SELECT id_genero FROM genero WHERE genero = :nombreGenero';
                    $query = $this->db->prepare($sql);
                    $query->bindParam(':nombreGenero', $nombreGenero, PDO::PARAM_STR);
                    $query->execute();
                    
                    
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    
                   
                    return $result ? $result['id_genero'] : null;
                }
                
                }
                
                
    


                



        


?>