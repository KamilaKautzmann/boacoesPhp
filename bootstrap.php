<?php
require './vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Models\Entity\Instituicao;

/**
* Dependencias da aplicação
*/
$container = new \Slim\Container();
$isDevMode = true;

/**
 * Diretório de Entidades e Metadata do Doctrine
 */
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Models/Entity"), $isDevMode);

$conn = array(
    'driver'   =>'pdo_mysql',    
    'host'     => 'localhost',   
    'dbname'   => 'boacoes',    
    'user'     => 'root',    
    'password' => '1@5f1p');

/**
 * Instância do Entity Manager
 */
$entityManager = EntityManager::create($conn, $config);

/**
 * Coloca o Entity manager dentro do container com o nome de em (Entity Manager)
 */
$container['em'] = $entityManager;
$app = new \Slim\App($container);

