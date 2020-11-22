<?php
abstract class ActiveRecord {

    protected $db; // handler de conexão com o banco de dados
    protected $table; // nome da tabela do banco representada por essa classe
    protected $primaryKey; // nome da chave primária da tabela

    public function __construct($table, $primaryKey = 'id') {
        $this->table = $table;
        $this->primaryKey = $primaryKey;

        // conexão ao banco de dados
        $this->db = DatabaseModel::getInstance();
    }

    // métodos abstratos que devem ser implementados por todas as subclasses concretas
    public abstract function fetchById($id);
    public abstract function fetchAll();
    public abstract function save();
    public abstract function delete();

    ###
    # getters e setters
    ###

    public function getDb() {
        return $this->db;
    }

    public function setDb($val) {
        $this->db = $val;
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable($val) {
        $this->table = $val;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function setPrimaryKey($val) {
        $this->primaryKey = $val;
    }

}
?>