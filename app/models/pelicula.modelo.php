<?php
require_once  "modelo.php";
class peliculaModelo extends Model
{


    public function __construct()
    {        //hacemos super() al constructor de modelo

        parent::__construct();
    }

    //obtiene todas las peliculas consultando la db
    function getPeliculas($orderBy = false)
    {
        $sql = 'SELECT * FROM peliculas';
        if ($orderBy) {
            switch ($orderBy) {
                case 'titulo':
                    $sql .= " ORDER BY titulo";
                    break;
            }
        }
        $query = $this->db->prepare($sql);

        $query->execute();

        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);
        return $peliculas;
    }

    //obitne una peli
    public function getPelicula($id)
    {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id = ? ');
        $query->execute([$id]);
        $pelicula = $query->fetch(PDO::FETCH_OBJ);
        return $pelicula;
    }
    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM peliculas WHERE id = ?");
        $query->execute([$id]);
    }
    public function crear($titulo, $categoria,$imagen)
    {
        $query = $this->db->prepare("INSERT INTO peliculas(titulo,categoria_id,imagen) values(?,?,?)");
        $query->execute([$titulo, $categoria,$imagen]);
        $id = $this->db->lastInsertId();
        return $id;
    }
    public function editar($id, $titulo, $categoria,$imagen)
    {
        $query = $this->db->prepare("UPDATE peliculas SET titulo =?,categoria_id=?,imagen=? WHERE id=?");
        $query->execute([$titulo, $categoria,$imagen, $id]);
    }
}
