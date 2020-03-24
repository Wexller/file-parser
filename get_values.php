<?
require_once 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

if (empty($_FILES)) {
  $file ='statement1.html';
} else {
  $file = uploadFile();
}

$html = file_get_contents($file);
$crawler = new Crawler($html);
$crawler = $crawler->filter("table > tr");

// Парсим таблицу, выбирая вервый и последний столбец. Избавляемся от лишних симоволов
$nodeValues = $crawler->each(
  function (Crawler $node) {
    $first = $node->children()->first()->text();
    $last = $node->children()->last()->text();
    return array(
      preg_replace('/[^A-Za-z0-9\-]/', '', $first),
      preg_replace('/ /', '', $last)
      );
  }
);

if (empty($nodeValues)) {
  http_response_code(400);
  echo json_encode([0 => 'В данном файле не было найдено совпадений']);
  exit();
}

// Находим конец транзакций
$endOfTransactions = array_search('', array_column($nodeValues, 0));
$nodeValues = array_slice($nodeValues,0, $endOfTransactions);

// Выбираем только прошедшие транзакции
$nodeValues = array_filter($nodeValues, function ($row) {
  $floatNumber = number_format((float)$row[1], 2, '.', '');
  return (string)$floatNumber === $row[1];
});

echo json_encode($nodeValues);

if (!empty($_FILES)) {
  unlink($file);
}

function uploadFile () {
  $errorsArr = [];
  $target_dir = "tmp/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if ($_FILES["fileToUpload"]["size"] > 1000000) {
    $errorsArr['SIZE'] = "Размер файла не должен превышать 1МБ";
  }

  if($imageFileType != "html") {
    $errorsArr['FORMAT'] =  "Доступен только HTML формат";
  }

  if (empty($errorsArr)) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      return $target_file;
    } else {
      $errorsArr['ERROR'] = "Возникла ошибка при загрузке файла";
    }
  }

  http_response_code(400);
  echo json_encode($errorsArr);
  exit();
}