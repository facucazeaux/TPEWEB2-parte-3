ENDPOINTS CON EJEMPLOS DE USO

GENERO:
1) http://localhost/WEB2/TPWEB2PARTE3/api/genero/30     //trae el genero con el id_genero nro 30
2)http://localhost/WEB2/TPWEB2PARTE3/api/genero         // trae todos lo generos 
3)http://localhost/WEB2/TPWEB2PARTE3/api/genero?filtro=genero&&valor=Drama   // trae el genero Drama a apatir de Filtro (que es el que busca segun la casilla tambien se podria hacer por descripcion o id_genero)
(y luego valor que es lo que queres buscar, en este caso el genero Drama)

4)http://localhost/WEB2/TPWEB2PARTE3/api/genero?filtro=genero&&valor=Drama&orderBy=DESC //(el mismo ejemplo que el anterior pero ordenado descendentemen o ascendentemente que seria "ASC");
5)http://localhost/WEB2/TPWEB2PARTE3/api/genero?orderBy=descripcion&ordenar=ASC // (ordena las descripciones de todas las series segun un orden en este caso ascendentemente);


SERIES:
1) http://localhost/WEB2/TPWEB2PARTE3/api/serie?orderBy=temporadas&ordenar=DESC // ordena las series segun las temporadas descendentemente esta condicion puede ser cambiada por cualquier criterio como todos las variables;
2)http://localhost/WEB2/TPWEB2PARTE3/api/serie?filtro=temporadas&valor=20 //trae todas las series que tengan 20 temporadas , el filtro puede cambiarse por cualquiera de la tabla al igual que valor este puede cambiar por cualqui cosa;
3)http://localhost/WEB2/TPWEB2PARTE3/api/serie?filtro=temporadas&valor=20& orderBy=nombre&ordenar = DESC // ordena descendentemente segun el nombre de la serie y busca series que solo tengan 20 temporadas(Todos los valores pueden ser cambiados por cualquier cosa);
4)http://localhost/WEB2/TPWEB2PARTE3/api/serie?filtro=genero & valor=Ciencia Ficcion // trae todas las series del genero ciencia ficcion

USUARIO:
1) http://localhost/WEB2/TPWEB2PARTE3/api/usuarios/token // obtengo el token del admin
