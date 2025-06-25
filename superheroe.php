<?php

$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$input = json_decode(file_get_contents("php://input"), true) ?? [];
$token = $_GET['token'] ?? $input['token'] ?? null;
$query = $_GET['query'] ?? $input['query'] ?? 'Marvel';

if (str_ends_with($requestUri, '/superheroe.php/media') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$token) {
        echo json_encode(['error' => 'Token de Twitter requerido.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }

    $tweets = getTweetsFromTwitter($query, $token);

    header('Content-Type: application/json');
    echo json_encode($tweets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    exit;
}

$dataFile = 'data.json';

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

$superheroes = json_decode(file_get_contents($dataFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newHero = [
        "id" => count($superheroes) + 1,
        "Nombre" => $input['Nombre'] ?? 'Desconocido',
        "Peso" => $input['Peso'] ?? 0,
        "Altura" => $input['Altura'] ?? 0,
        "Poder" => $input['Poder'] ?? 0,
        "created" => (new DateTime('now', new DateTimeZone('UTC')))->format(DateTime::ATOM),
    ];

    $superheroes[] = $newHero;
    file_put_contents($dataFile, json_encode($superheroes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header('Content-Type: application/json');
    echo json_encode([
        'message' => 'Superhéroe guardado exitosamente',
        'data' => $newHero
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $perPage;
$pagedSuperheroes = array_slice($superheroes, $start, $perPage);

$response = [
    'page' => $page,
    'per_page' => $perPage,
    'total' => count($superheroes),
    'total_pages' => ceil(count($superheroes) / $perPage),
    'data' => $pagedSuperheroes
];

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

function getTweetsFromTwitter($query, $bearerToken) {
    $url = "https://api.twitter.com/2/tweets/search/recent?query=" . urlencode($query)
        . "&max_results=10&expansions=author_id&user.fields=username,name";

    $headers = [
        "Authorization: Bearer {$bearerToken}",
        "Content-Type: application/json"
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200 || $response === false) {
        return [
            'error' => 'Twitter API error',
            'status' => $httpcode,
            'response' => $response
        ];
    }

    $data = json_decode($response, true);
    $tweets = [];
    $users = [];

    if (isset($data['includes']['users'])) {
        foreach ($data['includes']['users'] as $user) {
            $users[$user['id']] = $user;
        }
    }

    if (isset($data['data'])) {
        foreach ($data['data'] as $tweet) {
            $author = $users[$tweet['author_id']] ?? null;
            $tweets[] = [
                'id' => $tweet['id'],
                'text' => $tweet['text'],
                'author' => $author ? [
                    'username' => $author['username'],
                    'name' => $author['name']
                ] : null
            ];
        }
    }

    return $tweets;
}
?>
