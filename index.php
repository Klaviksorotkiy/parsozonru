<?
header('Content-Type: text/html; charset=utf-8');
include "simple_html_dom.php";
?>
<html>
<head>
<title>Парсинг сайта OZON.RU</title>
</head>
<body>
<br>
<form action="index.php" method="POST">
<h3>Пример парсинга сайта OZON.RU, раздел наушников</h3><br>
<?
if (!isset($_POST['gobutton'])) {    
echo "<input type=submit name=\"gobutton\" value=\"   Отпарсить   \">";
} else {echo "<input type=submit disabled name=\"gobutton\" value=\"   Отпарсить   \">";}
?>
<br><br>
<p id="p1"></p>
</form>
<br><br>

<?
// если нажали кнопошку
if (isset($_POST['gobutton'])) {     
    
echo "<script type=\"text/javascript\">
document.getElementById('p1').innerHTML='<font color=red><b>Загрузка ... ждите.</b></font>';
</script>";

// функция для удаления повторяющихся слов, далее используется
function delete_duplicates_words($text)
{
    $text = implode(array_reverse(preg_split('//u', $text)));
    $text = preg_replace('/(\b[\pL0-9]++\b)(?=.*?\1)/siu', '', $text);
    $text = implode(array_reverse(preg_split('//u', $text)));
    return $text;
}
$html = file_get_html('https://www.ozon.ru/category/naushniki-15547/?page=30');


foreach($html->find('div.tiles') as $tiles) {  // все тайлы
foreach($tiles->find('div.tile') as $tile) {   //каждый тайл отдельно  
foreach($tile->find('img') as $element)   {  // добываем ссылку на картинку
       echo $element->src . '<br>';
}
foreach($tile->find('a[commentscount=0]') as $aa) {   // добываем название 
       echo $aa->plaintext. '<br>'; 
  }
foreach($tile->find('a[commentscount=0]') as $aaa)  {  // добываем ссылку
        $global_ssil = 'https://www.ozon.ru'.$aaa->href;
       echo $global_ssil.'<br>';    
       
 
 }     
 
  
$html = file_get_html($global_ssil);

//цена
$cena = $html->find('span.main',2)->plaintext;
echo 'Цена: '.$cena.'<br>';
// характеристики
//1
$i=0;
foreach($html->find('div._97746') as $aa) {  
echo $aa->plaintext.' -> ';
$i++;
$txtt = $html->find('div.ed24e',$i-1)->plaintext;
echo $txtt.'<br>';


}
 
echo '<br><br><hr><br>';
}
}
// -----------------тут надо пройти по ссылке и прочитать характеристики смартфонов---------------------

 
 
 
 



//  1
//$rest = $html->find('div[index=1]');
 // 
//if ($rest) {   // если параметр не один а несколько, то показываем все взможные
//
//foreach($html->find('div[index=1]') as $aa) {   // добываем название 
// 
//echo $html->find('p.d2bf8',1)->plaintext.' '.$aa.'<br>';
//} 
///}  else { 
//echo $html->find('p.d2bf8',1)->plaintext.'<br>';
//
//}


 





 
echo "<script type=\"text/javascript\">
document.getElementById('p1').innerHTML='<font color=green><b>Загрузка ... завершена!</b></font>';
</script>";


// кнопошка
}
?>

</body>    
    
</html>
