<?php

require_once "Cliente.php";

header("Content_Type: application/json");
$data =[];

$fn = $_REQUEST["fn"] ?? null;
$id = $_REQUEST["id"] ?? 0;
$nome = $_REQUEST["nome"] ?? null;
$email = $_REQUEST["email"] ?? null;
$nascimento = $_REQUEST["nascimento"] ?? null;
$telefone = $_REQUEST["telefone"] ?? null;

$cliente = new Cliente;
$cliente->setId($id);

if($fn === "create" && $nome !== null && $email !== null && $nascimento !== null && $telefone !== null){
        $cliente->setNome($nome);
        $cliente->setEmail($email);
        $cliente->setNascimento($nascimento);
        $cliente->setTelefone($telefone);
        $data["cliente"] = $cliente->create();
}

if($fn === "read"){
    $data["cliente"] = $cliente->read();
}


die(json_encode($data));