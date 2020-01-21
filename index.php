<?php
include_once 'index.html';


if($_POST['url'] !==false){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_POST['url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
}
if ($data === FALSE) {
    echo 'cURL Error: ' . curl_error($ch);
    return $data;
}
curl_close($ch);


if($_POST['file_name'] !==false){
file_put_contents($_POST['file_name'].".txt", $data);
}
// var_dump ($data);

$str1 = $data;
$str2 = $_POST['replace_old_name'];
$str3 = $_POST['replace_new_name'];
$newData = str_replace($str2, $str3, $str1);
// var_dump($newData);


if($str2 AND $str3 !==false){
    file_put_contents($_POST['file_name'].".txt", $newData);
    echo 'Запись файла успешно сделана.';
}
else{
    echo 'Заполните поля ввода!';
}

$count = substr_count($data, $str2);
if($count !==false){
    echo '<p>Количество вхожений <input type="text" name="count_incoming" value='.$count.'></p>';
}

$rename = rename ($_POST['file_name'].".txt", $_POST['rename_new_name'].".txt");
if($rename !==false){
    echo 'Перезапись имени файла сделана успешно.';
} else{
    echo 'Ошибка перезаписи имени файла!';
}

$regexp = "/(title)/";
$replase = $_POST['count_title'];
if($regexp AND $replase !==false){
preg_replace($regexp, $replase, $newData);
}

// var_dump($data);
// А вдруг ошибочка?






// $fp = fopen("panda.txt", "x+");






// if(curl_error($ch)) {
//     fwrite($fp, curl_error($ch));
// }

// $count = $_POST['count_incoming'];

// echo strlen($count);

// fclose($fp);
?>