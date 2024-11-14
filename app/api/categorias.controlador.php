<?php
require_once "./app/models/categorias.modelo.php";
require_once "./app/models/pelicula.modelo.php";
require_once "./app/view/json.view.php";



class categoriasControlador
{
    private $modeloPel;
    private $modeloCat;

    private $vista;

    function __construct()
    {

        $this->vista = new  JSONView();
        $this->modeloPel = new peliculaModelo();
        $this->modeloCat = new categoriasModelo();
    }


    public function getAll($req)
    {
        $peliculas = [];
        $orderBy = false;
        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }
        $cat = $this->modeloCat->getCategorias($orderBy);

        return $this->vista->response($cat);
    }


    //obtiene la peli de el modelo y su respectiva categoria  y las muestra
    public function get($req)
    {
        // Verifica si hay un id
        if (empty($req->params->id)) {
            return $this->vista->response("no hay Categoria con ese id", 404);
        }
        $id = $req->params->id;
        // Lógica para obtener peli por número
        $peli = $this->modeloCat->getCategoria($id);
        if (!$peli) {
            return $this->vista->response("No hay una Categoria con ese id", 404);
        }
        return $this->vista->response($peli);
    }
    public function delete($req, $res)
    {
        // Verifica si hay un id
        if (empty($req->params->id)) {
            return $this->vista->response("no hay Categoria con ese id", 404);
        }
        $id = $req->params->id;
        $peli = $this->modeloCat->getCategoria($id);
        if (!$peli) {
            return $this->vista->response("No existe el id", 404);
        }
        $this->modeloCat->delete($id);
        return $this->vista->response("La categoria $id se elimino");
    }
    public function crear($req, $res)
    {
        if (empty($req->body->nombre)) {
            return $this->vista->response("Llenar todos los datos", 400);
        }
        $nombre = $req->body->nombre;
        if (!isset($req->body->descripcion)) {
            $descripcion = '';
        } else {
            $descripcion = $req->body->descripcion;
        }
        $id = $this->modeloCat->crear($nombre, $descripcion);
        if (!$id) {
            return $this->vista->response("No se pudo crear", 500);
        }
        $categoria = $this->modeloCat->getCategoria($id);
        return $this->vista->response($categoria, 201);
    }
    public function editar($req, $res)
    {
        if (!isset($req->params->id)) {
            return $this->vista->response("No existe la categoria a editar", 404);
        }
        $id = $req->params->id;

        if (empty($req->body->nombre)) {
            return $this->vista->response("Llenar todos los datos", 400);
        }
        $nombre = $req->body->nombre;

        if (!isset($req->body->descripcion)) {
            $descripcion = '';
        } else {
            $descripcion = $req->body->descripcion;
        }
        $this->modeloCat->editar($id, $nombre, $descripcion);
        $cat = $this->modeloCat->getCategoria($id);
        return $this->vista->response($cat);
    }
}
