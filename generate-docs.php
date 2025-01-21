<?php
require 'vendor/autoload.php';

use OpenApi\Generator;

header('Content-Type: application/json');

// Analyse les annotations dans le dossier "src"
$openapi = Generator::scan([__DIR__ . '/src']);

// Génère un fichier JSON
file_put_contents(__DIR__ . '/public/openapi.json', $openapi->toJson());

echo "Documentation générée avec succès !";
