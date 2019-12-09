<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Entity\Instituicao;

require 'bootstrap.php';

/**
 * Lista instituições :)
 */
 $app->get('/instituicao', function (Request $request, Response $response) use ($app) {
    $entityManager = $this->get('em');
    $instituicaoRepository = $entityManager->getRepository('App\Models\Entity\Instituicao');
    $instituicao = $instituicaoRepository->findAll();   
    
    $return = $response->withJson($instituicao, 200)
    ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Lista uma instituição :)
 */
$app->get('/instituicao/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');    

    $entityManager = $this->get('em');
    $instituicaoRepository = $entityManager->getRepository('App\Models\Entity\Instituicao');
    $instituicao = $instituicaoRepository->find($id);        

    $return = $response->withJson($instituicao, 200)
    ->withHeader('Content-type', 'application/json'); 
    return $return;
});

/**
 * Inclui uma instituicao :)
 */
$app->post('/instituicao', function (Request $request, Response $response) use ($app) {
    $params = (object) $request->getParams();
    $entityManager = $this->get('em'); //manager do container
   
    //enditade preenchida com os parametros
    $instituicao = (new Instituicao())->setNome($params->nome) 
    ->setDescricao($params->descricao)
    ->setEspecialidade($params->especialidade)
    ->setCep($params->cep)
    ->setEndereco($params->endereco)
    ->setTelefone($params->telefone);
    
   
    //persistindo no banco
    $entityManager->persist($instituicao);
    $entityManager->flush();

    $return = $response->withJson($instituicao, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Atualizando uma instituicao :)
 */
$app->put('/instituicao/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id'); //pega o Id da URL

    //Encontra o ID no banco
    $entityManager = $this->get('em');
    $instituicaoRepository = $entityManager->getRepository('App\Models\Entity\Instituicao');
    $instituicao = $instituicaoRepository->find($id); 
    
    $instituicao->setNome($request->getParam('nome')) 
    ->setDescricao($request->getParam('descricao'))
    ->setEspecialidade($request->getParam('especialidade'))
    ->setCep($request->getParam('cep'))
    ->setEndereco($request->getParam('endereco'))
    ->setTelefone($request->getParam('telefone'));

    $entityManager->persist($instituicao);
    $entityManager->flush(); 

    $return = $response->withJson($instituicao, 200)
    ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Deletando uma instituicao :)
 */
$app->delete('/instituicao/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');  
    
    $entityManager = $this->get('em');
    $instituicaoRepository = $entityManager->getRepository('App\Models\Entity\Instituicao');
    $instituicao = $instituicaoRepository->find($id);  

    $entityManager->remove($instituicao);   
    $entityManager->flush();

    $return = $response->withJson(['msg' => "Deletando instituicao {$id}"], 204)
    ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->run();