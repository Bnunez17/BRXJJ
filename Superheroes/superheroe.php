<?php


$superheroes = [
    [
        "id" => 1,
        "Nombre" => "AngelMalo",
        "Peso" => 100,
        "Altura" => 2,
        "Poder"=> 92.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 2,
        "Nombre" => "Voltrax",
        "Peso" => 95,
        "Altura" => 1.95,
        "Poder"=>78,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 3,
        "Nombre" => "Sombranegra",
        "Peso" => 88,
        "Altura" => 1.85,
        "Poder"=>88.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 4,
        "Nombre" => "Centellax",
        "Peso" => 78,
        "Altura" => 1.7,
        "Poder"=>64,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 5,
        "Nombre" => "Draconix",
        "Peso" => 110,
        "Altura" => 2.3,
        "poder"=> 92,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 6,
        "Nombre" => "Metalstorm",
        "Peso" => 120,
        "Altura" => 2.1,
        "Poder"=>100,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 7,
        "Nombre" => "PsicoFlash",
        "Peso" => 65,
        "Altura" => 1.68,
        "Poder"=> 77.6,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 8,
        "Nombre" => "Igneón",
        "Peso" => 85,
        "Altura" => 1.82,
        "Poder"=> 83,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 9,
        "Nombre" => "Neurona",
        "Peso" => 70,
        "Altura" => 1.76,
        "Poder" => 59.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 10,
        "Nombre" => "Gelax",
        "Peso" => 90,
        "Altura" => 1.9,
        "Poder" => 44,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 11,
        "Nombre" => "Rayodin",
        "Peso" => 98,
        "Altura" => 2.05,
        "Poder"=> 69,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 12,
        "Nombre" => "Cristalia",
        "Peso" => 60,
        "Altura" => 1.6,
        "Poder" =>89.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 13,
        "Nombre" => "Fantasmón",
        "Peso" => 75,
        "Altura" => 1.78,
        "Poder"=>97,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 14,
        "Nombre" => "Titanika",
        "Peso" => 105,
        "Altura" => 2.15,
        "Poder"=>25.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 15,
        "Nombre" => "Orbix",
        "Peso" => 80,
        "Altura" => 1.8,
        "Poder"=>45,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 16,
        "Nombre" => "Sónica",
        "Peso" => 68,
        "Altura" => 1.65,
        "Poder"=>82,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 17,
        "Nombre" => "Mutor",
        "Peso" => 115,
        "Altura" => 2.25,
        "Poder"=> 75,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 18,
        "Nombre" => "Luminax",
        "Peso" => 72,
        "Altura" => 1.75,
        "Poder"=>99,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 19,
        "Nombre" => "Terron",
        "Peso" => 130,
        "Altura" => 2.4,
        "Poder"=>44,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 20,
        "Nombre" => "Vaporina",
        "Peso" => 58,
        "Altura" => 1.62,
        "Poder"=>88,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 21,
        "Nombre" => "Neutrón",
        "Peso" => 92,
        "Altura" => 1.9,
        "Poder"=> 82.9,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 22,
        "Nombre" => "Obscurium",
        "Peso" => 99,
        "Altura" => 2.0,
        "Poder"=> 87.6,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 23,
        "Nombre" => "FelinaX",
        "Peso" => 66,
        "Altura" => 1.7,
        "Poder"=> 92,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
    [
        "id" => 24,
        "Nombre" => "Cyclor",
        "Peso" => 102,
        "Altura" => 2.1,
        "Poder"=>100,
        "created" => new DateTime('now', new DateTimeZone('UTC')),
    ],
];





foreach ($superheroes as &$hero) {
    $hero['created'] = $hero['created']->format(DateTime::ATOM);
}
unset($hero); 

header('Content-Type: application/json');

echo json_encode($superheroes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>
