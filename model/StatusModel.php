<?php
class StatusModel extends ActiveRecord {

    const TABLE = 'status';
    const PRIMARY_KEY = 'id';

    private $id;
    private $descricao;

    public function __construct() {
        parent::__construct(self::TABLE, self::PRIMARY_KEY);
    }

    ###
    # métodos sobrescritos de ActiveRecord
    ###
    public function fetchById($id) {
        $query = "SELECT * FROM ".self::TABLE." WHERE ".self::PRIMARY_KEY." = ".$id." LIMIT 1";
        $resultado = mysqli_query($this->db, $query);
        if ($row = mysqli_fetch_assoc($resultado)) {
            $this->id = $row['id'];
            $this->descricao = $row['descricao'];
            return $this;
        }
        return false;
    }

    public function fetchAll() {
        $data = array();
        $query = "SELECT * FROM " . self::TABLE;
        $resultado = mysqli_query($this->db, $query);
        while ($row = mysqli_fetch_assoc($resultado)) {
            $objeto = new self();
            $objeto->id = $row['id'];
            $objeto->descricao = $row['descricao'];

            $data[] = $objeto;
        }
        return $data;
    }

    public function save() {
        $id = isset($this->{self::PRIMARY_KEY}) ? $this->{self::PRIMARY_KEY} : null;
        if (empty($id)) {
            $statement = mysqli_prepare($this->db, "INSERT INTO ".self::TABLE." (descricao) VALUES (?)");
            mysqli_stmt_bind_param($statement,"s", $this->descricao );
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
            $id = mysqli_insert_id($this->db);
            $this->id = $id;
        } else {
            $statement = mysqli_prepare($this->db, "UPDATE ".self::TABLE." SET descricao = ? WHERE " . self::PRIMARY_KEY . " = " . $id);
            mysqli_stmt_bind_param($statement,"s", $this->descricao);
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
        }
        return $id;
    }

    public function delete() {
        $id = isset($this->{self::PRIMARY_KEY}) ? $this->{self::PRIMARY_KEY} : null;
        if (empty($id)) { return false; }
        $query = "DELETE FROM ".self::TABLE." WHERE ".self::PRIMARY_KEY." = ".$id;
        if (mysqli_query($this->db, $query)) { return true; }
        return false;
    }

    ###
    # getters e setters
    ###

   
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}
?>
