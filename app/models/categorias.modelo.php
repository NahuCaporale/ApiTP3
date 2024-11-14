<?php
require_once './config.php';
require_once "modelo.php";
class categoriasModelo extends Model

{
    public function __construct()
    {        //hacemos super() al constructor de modelo

        parent::__construct();
    }
    //obtiene todas las categorias
    public function getCategorias($orderBy = false)

    {
        $sql = 'SELECT * FROM categorias';
        if ($orderBy) {
            switch ($orderBy) {
                case 'nombre':
                    $sql .= " ORDER BY nombre";
                    break;
            }
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
    public function getCategoria($id)
    {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id = ? ');
        $query->execute([$id]);
        $pelicula = $query->fetch(PDO::FETCH_OBJ);
        return $pelicula;
    }
    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM categorias WHERE id = ?");
        $query->execute([$id]);
    }
    public function crear($nombre, $descripcion)
    {
        $query = $this->db->prepare("INSERT INTO categorias(nombre,descripcion) values(?,?)");
        $query->execute([$nombre, $descripcion]);
        $id = $this->db->lastInsertId();
        return $id;
    }
    public function editar($id, $nombre, $descripcion)
    {
        $query = $this->db->prepare("UPDATE categorias SET nombre =?,descripcion=? WHERE id = ?");
        $query->execute([$nombre, $descripcion, $id]);
    }
}
