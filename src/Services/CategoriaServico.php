<?php

namespace Microblog\Services;

use Microblog\Database\ConexaoBD;
use PDO;

require_once __DIR__ . '/../Models/Categoria.php';

class CategoriaServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    // Listar todas as categorias
    public function listar(): array
    {
        $sql = "SELECT * FROM categorias ORDER BY nome";

        $consulta = $this->conexao->query($sql);

        $categorias = [];

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $categorias[] = new \Categoria(
                $linha['nome'],
                (int) $linha['id']
            );
        }

        return $categorias;
    }

    // Buscar uma categoria pelo ID
    public function buscarPorId(int $id): ?\Categoria
    {
        $sql = "SELECT * FROM categorias WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $linha = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$linha) {
            return null;
        }

        return new \Categoria(
            $linha['nome'],
            (int) $linha['id']
        );
    }

    // Inserir uma categoria
    public function inserir(\Categoria $categoria): bool
    {
        $sql = "INSERT INTO categorias (nome) VALUES (:nome)";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(':nome', $categoria->getNome());

        return $consulta->execute();
    }

    // Atualizar uma categoria
    public function atualizar(\Categoria $categoria): bool
    {
        $sql = "UPDATE categorias
                SET nome = :nome
                WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(':nome', $categoria->getNome());
        $consulta->bindValue(':id', $categoria->getId(), PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Excluir uma categoria
    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM categorias WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}