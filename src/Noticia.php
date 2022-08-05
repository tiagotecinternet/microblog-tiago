<?php
namespace Microblog;
use PDO, Exception;

final class Noticia {
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;

    /* Criando uma propriedade do tipo Usuario, ou seja, 
    a partir de uma classe que criamos anteriormente,
    com o objetivo de reutilizar recursos dela.
    
    Isto permitirá fazer uma ASSOCIAÇÃO entre classes. */
    public Usuario $usuario;

    private PDO $conexao;

    public function __construct()
    {
        /* No momento em que um objeto Noticia for instanciado
        nas páginas, aproveitaremos para também instanciar um objeto
        Usuario e com isso acessar recursos desta classe. */
        $this->usuario = new Usuario;

        /* Reaproveitando a conexão já existente
        a partir da classe de Usuario */
        $this->conexao = $this->usuario->getConexao();
    }

    public function inserir():void {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, 
        destaque, usuario_id, categoria_id) 
        VALUES(:titulo, :texto, :resumo, :imagem, :destaque, 
        :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindParam(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->bindParam(":categoria_id", $this->categoriaId, PDO::PARAM_INT);

            /* Aqui, primeiro chamamos o getter de ID a partir do objeto/classe
            de Usuario. E só depois atribuimos ele ao parâmetro :usuario_id
            usando para isso o bindValue. Obs.: bindParam pode ser usado, mas há riscos
            de erro devido a forma como ele é executado pelo PHP. Por isso, recomenda-se
            o uso do bindValue em situações como essa. */
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ". $erro->getMessage());
        }   
    }


    public function upload(array $arquivo) {
        // Definindo os formatos aceitos (mime-types)
        $tiposValidos = [
            "image/png", "image/jpeg", "image/gif","image/svg+xml"
        ];

        if( !in_array($arquivo['type'], $tiposValidos) ){
            die("
                <script>
                alert('Formato inválido!');
                history.back();
                </script>
            ");
        }/*  else {
            die("<script>alert('Formato válido!');history.back();</script>");
        } */

        // Acessando apenas o nome do arquivo
        $nome = $arquivo['name'];

        // Acessando os dados de acesso temporário
        $temporario = $arquivo['tmp_name'];

        // Definindo a pasta de destino junto com o nome do arquivo
        $destino = "../imagem/".$nome;

        // Usamos a função abaixo para pegar da área temporária
        // e enviar para a pasta de destino (com o nome do arquivo)
        move_uploaded_file($temporario, $destino);
    }


    /* 
    try {
            
        } catch (Exception $erro) {
            die("Erro: ". $erro->getMessage());
        }  */






   
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    
    public function setTitulo(string $titulo)
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function getTexto(): string
    {
        return $this->texto;
    }

    
    public function setTexto(string $texto)
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function getResumo(): string
    {
        return $this->resumo;
    }

    
    public function setResumo(string $resumo)
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function getImagem(): string
    {
        return $this->imagem;
    }

    
    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function getDestaque(): string
    {
        return $this->destaque;
    }

    
    public function setDestaque(string $destaque)
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    
    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = filter_var($categoriaId, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}