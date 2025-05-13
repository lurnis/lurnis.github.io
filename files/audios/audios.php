<?php
// GitHub foydalanuvchi va repo ma'lumotlari
$user = 'abduvositin';
$repo = 'lurnis';
$path = ''; // agar audios/ papka ichida bo'lsa: 'audios'

// GitHub API URL
$url = "https://api.github.com/repos/$user/$repo/contents/$path";

// cURL orqali so‘rov yuborish
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP'); // majburiy user-agent
$response = curl_exec($ch);
curl_close($ch);

// JSON parsing
$data = json_decode($response, true);

// Audio fayllar ro‘yxatini yig‘ish
$audios = [];

foreach ($data as $file) {
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (in_array(strtolower($ext), ['mp3', 'wav', 'ogg', 'm4a'])) {
        $audios[] = [
            'name' => $file['name'],
            'url' => $file['download_url']
        ];
    }
}

// JSON chiqish
header('Content-Type: application/json');
echo json_encode($audios, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
