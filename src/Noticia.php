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
}