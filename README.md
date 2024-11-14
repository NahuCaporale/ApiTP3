 # Parte tres de el tpe
Creamos una sitio de peliculas donde el usuario podra visualizar,crear,eliminar y editar peliculas mediante endpoints.
La paginacion de el sitio solo esta diseñado para poder visualizar las peliculas, agregar una categoria/pelicula y hacer order by.
Creamos otra db parecida porque prefrimos dejar la de el otro trabajo aparte(no implementamos deploy asi que hay que importarla).
 # ENDPOINTS
GET /peliculas = Obtiene todas las películas.
   
GET /peliculas/:id = Obtiene una película por su ID.
   
GET /categorias =  Obtiene todas las categorías.
   
GET /categorias/:id =  Obtiene una categoría por su ID.
    
DELETE /peliculas/:id = Elimina una película por su ID.
  
DELETE /categorias/:id = Elimina una categoría por su ID.
   
POST /categorias =  Crea una nueva categoría.

POST /peliculas =  Crea una nueva película.

PUT /categorias/:id =  Actualiza una categoría por su ID.

PUT /peliculas/:id     Actualiza una película por su ID.


 # Integrantes
 Nahuel Caporale y Geronimo Moroni
