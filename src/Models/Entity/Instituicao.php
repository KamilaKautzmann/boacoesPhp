<?php

namespace App\Models\Entity;

/**
 * @Entity @Table(name="instituicao")
 **/
class Instituicao {
    /**
     * @var int
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    public $id;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $nome;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $descricao;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $especialidade;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $cep;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $endereco;
    /**
     * @var string
     * @Column(type="string") 
     */
    public $telefone;

    //GET
    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getDescricao() {
        return $this->Descricao;
    }    
    public function getEspecialidade() {
        return $this->Especialidade;
    } 
    public function getEndereco() {
        return $this->endereco;
    } 
    public function getTelefone() {
        return $this->telefone;
    } 
    public function getCep() {
        return $this->cep;
    } 
    //SET
    public function setNome($nome){
        $this->nome = $nome;
        return $this;  
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }
    public function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
        return $this;
    }
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
        return $this;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
        return $this;
    }
    public function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }
}