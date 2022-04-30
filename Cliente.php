<?php

class Cliente {
    private $id= 0;
    private $nome = null;
    private $email = null;
    private $nascimento = null;
    private $telefone = null;

    public function setId(int $id):void{
        $this->id = $id;
    }

    public function getId(): int{
        return $this->id;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }

    public function getNome (): string{
        return $this -> nome;
    }

    public function setEmail (string $email ): void{
        $this->email = $email;
    }

    public function getEmail ():string {
        return $this->email;
    } 


    public function setNascimento(string $nascimento): void{
        $this->nascimento = $nascimento;
    }

    public function getNascimento(): string{
        return  $this->nascimento;
    }

    public function setTelefone (string $telefone): void{
        $this->telefone = $telefone;
    }

    public function getTelefone(): string{
         return $this->telefone ;
    }

    private function connection(): \PDO{
        return new \PDO("mysql:host=localhost;dbname=db_cliente","root","");
    }

    public function create() : array{
        $conect = $this -> connection();
        $stmt= $conect->prepare("INSERT INTO cliente VALUES (NULL ,:_nome,:_email,:_nascimento,:_telefone)");
        $stmt->bindValue(":_nome", $this-> getNome(), \PDO :: PARAM_STR);
        $stmt->bindValue(":_email", $this->getEmail(),\PDO :: PARAM_STR);
        $stmt->bindValue(":_nascimento",$this->getNascimento(),\PDO :: PARAM_STR);
        $stmt->bindValue(":_telefone", $this->getTelefone(),\PDO::PARAM_STR);

        if($stmt-> execute()){
            $this ->setId($conect->lastInsertId());
            return $this->read();
        }
        return [];

    }

    public function read(): array {
        $conect = $this-> connection();

        if($this->getId() === 0){
            $stmt = $conect->prepare("SELECT * FROM cliente");

            if($stmt->execute()){
                return $stmt-> fetchAll(\PDO::FETCH_ASSOC);
            }
        }

        else if($this->getId() > 0){
            $stmt = $conect->prepare("SELECT * FROM id = :_id");
            $stmt->bindValue(":_id",$this->getId(),\PDO::PARAM_INT);

            if($stmt->execute()){
                return $stmt-> fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return [];
    }

}