<?php
declare(strict_types=1);

//Camada de Acesso a dados (DAO) para Almoxarifado
//essa Camada é uma classe - usa Paradigma de Programação orientada ao objeto

final class AlmoxarifadoDAO{
    //atributos -> as caracteristicas do objeto
    private PDO $pdo;

    //métodos -> ações
    public function __construtor(PDO $pdo){
        $this->pdo = $pdo;
    }

    // métodos do CRUD

}