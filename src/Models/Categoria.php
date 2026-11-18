<?php

class Categoria
{
    private ?int $id;
    private string $nome;

    public function __construct(string $nome, ?int $id = null)
    {
        $this->nome = $nome;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}

$categoria = new Categoria("Tecnologia");
$categoria = new Categoria("Tecnologia", 1);
