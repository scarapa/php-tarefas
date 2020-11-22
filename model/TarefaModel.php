<?php
class TarefaModel extends ActiveRecord {

    // constantes que representam o nome da tabela e sua chave primária
    const TABLE = "tarefas";
    const PRIMARY_KEY = "id";

    // cada coluna da tabela é representada por um atributo na classe

    private $id;
    private $pai;
    private $titulo;
    private $descricao;
    private $status;
    private $ds_status;
    private $posicao;

    public function __construct() {
        parent::__construct(self::TABLE, self::PRIMARY_KEY);
    }
    
    ###
    # métodos sobrescritos de ActiveRecord
    ###

    public function fetchById($id) {
        $query = "SELECT * FROM ".self::TABLE." WHERE ".self::PRIMARY_KEY." = " . $id . " LIMIT 1";
        $resultado = mysqli_query($this->db, $query);
        if ($row = mysqli_fetch_assoc($resultado)) {
            $this->id = $row['id'];
            $this->pai = $row['id_pai'];
            $this->titulo = $row['titulo'];
            $this->descricao = $row['descricao'];
            $this->status = $row['status'];
            $this->posicao = $row['posicao'];
            return $this;              
        }
        return false;
    }

    public function fetchAll() {
        $data = array();
        $query = "SELECT t.*,s.descricao 'ds_status' FROM ".self::TABLE. " t LEFT JOIN status s ON t.status = s.id ";
        $resultado = mysqli_query($this->db, $query);
        while ($row = mysqli_fetch_assoc($resultado)) {
            $objeto = new self();
            $objeto->id = $row['id'];
            $objeto->pai = $row['id_pai'];
            $objeto->titulo = $row['titulo'];
            $objeto->descricao = $row['descricao'];
            $objeto->status = $row['status'];
            $objeto->ds_status = $row['ds_status'];
            $objeto->posicao = $row['posicao'];
            $data[] = $objeto;
        }
        return $data;
    }

    public function save() {
        $id = isset($this->{self::PRIMARY_KEY}) ? $this->{self::PRIMARY_KEY} : null;
        //echo "<pre>"; print_r($this); echo "</pre>"; die;
        if (empty($id)) {
            $statement = mysqli_prepare($this->db, " INSERT INTO ".self::TABLE." (id_pai,titulo,descricao,status,posicao) VALUES (?,?,?,?,?)");
            mysqli_stmt_bind_param($statement,"sssss", $this->pai , $this->titulo ,$this->descricao , $this->status , $this->posicao );
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
            $id = mysqli_insert_id($this->db);
            $this->id = $id;
        } else {
            $statement = mysqli_prepare($this->db, "UPDATE ".self::TABLE." SET id_pai = ? , titulo = ? , descricao = ?, status = ? , posicao = ? WHERE " . self::PRIMARY_KEY . " = " . $id);
            mysqli_stmt_bind_param($statement,"sssss", $this->pai , $this->titulo ,$this->descricao , $this->status , $this->posicao);
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
        }
        return $id;


    }

    public function delete() {
        $id = isset($this->{self::PRIMARY_KEY}) ? $this->{self::PRIMARY_KEY} : null;
        if (empty($id)) { return false; }
        $query = "DELETE FROM ".self::TABLE." WHERE ".self::PRIMARY_KEY. " = ".$id;
        if (mysqli_query($this->db, $query)) { return true; }
        return false;
    }

    public function buscarPai($id){
        $data = array();
        if(!empty($id)){
            $pesquisar = " AND id_pai = $id ";
        }
        $query = "SELECT * FROM ".self::TABLE." WHERE 1=1 $pesquisar ;";
        $resultado = mysqli_query($this->db, $query);
        while ($row = mysqli_fetch_assoc($resultado)) {
            $objeto = new self();
            $objeto->id = $row['id'];
            $objeto->pai = $row['id_pai'];
            $objeto->titulo = $row['titulo'];
            $objeto->descricao = $row['descricao'];
            $objeto->status = $row['status'];
            $objeto->ds_status = $row['ds_status'];
            $objeto->posicao = $row['posicao'];
            $data[] = $objeto;
        }
        return $data;        
    }

    public function diagrama() {
        $dados = array();
        $query = " SELECT * FROM tarefas WHERE id_pai = 0 ORDER BY id_pai,posicao ASC ";
        $resultado = mysqli_query($this->db, $query);
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $id = $linha['id'];
            $dados[$id]['id'] = $linha['id'];
            $dados[$id]['id_pai'] = $linha['id_pai'];
            $dados[$id]['titulo'] = $linha['titulo'];
            $dados[$id]['posicao'] = $linha['posicao'];
            $dados[$id]['nivel'] = 0;

            $query2 = " SELECT * FROM tarefas WHERE id_pai = $linha[id] ORDER BY id_pai,posicao ASC ";
            $resultado2 = mysqli_query($this->db, $query2);
            
            $dados[$id]['filhos']=mysqli_num_rows($resultado2);
            if(mysqli_num_rows($resultado2) > 0){

                while ($linha2 = mysqli_fetch_assoc($resultado2)) {
                    $id2 = $linha2['id'];
                    $dados[$id2]['id'] = $linha2['id'];
                    $dados[$id2]['id_pai'] = $linha2['id_pai'];
                    $dados[$id2]['titulo'] = $linha2['titulo'];
                    $dados[$id2]['posicao'] = $linha2['posicao'];
                    $dados[$id2]['nivel'] = 1;

                    $query3 = " SELECT * FROM tarefas WHERE id_pai = $linha2[id] ORDER BY id_pai,posicao ASC ";
                    $resultado3 = mysqli_query($this->db, $query3);
                    $dados[$id2]['filhos']=mysqli_num_rows($resultado3);
                    if(mysqli_num_rows($resultado3) > 0){

                        while ($linha3 = mysqli_fetch_assoc($resultado3)) {
                            $id3 = $linha3['id'];
                            $dados[$id3]['id'] = $linha3['id'];
                            $dados[$id3]['id_pai'] = $linha3['id_pai'];
                            $dados[$id3]['titulo'] = $linha3['titulo'];
                            $dados[$id3]['posicao'] = $linha3['posicao'];
                            $dados[$id3]['nivel'] = 2;
                            $dados[$id3]['filhos'] = 0;
                        }        
                    }
                }
            }
        }
        return $dados;
    }     


    ###
    # getters e setters
    ###
    public function setId($id) {
        $this->id = $id;
    }
    public function setPai($pai) {
        $this->pai = $pai;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function setDescricaoStatus($ds_status) {
        $this->ds_status = $ds_status;
    }    
    public function setPosicao($posicao) {
        $this->posicao = $posicao;
    } 

    public function getId() {
        return $this->id;
    }
    public function getPai() {
        return $this->pai;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getDescricaoStatus() {
        return $this->ds_status;
    }    
    public function getPosicao() {
        return $this->posicao;
    }

   
}
?>
