<?php
//$arr = array
//    (
//    array("OI" => array("LinuxBox" => array("LinuxBox1" => array("usuario", "senha1", "senha2", "senha3", "desc"), "IP", "porta", "SO",))),
//    array("OI" => array("LinuxBox" => array("LinuxBox1" => array("usuario", "senha1", "senha2", "senha3", "desc"), "IP", "porta", "SO",))),
//);
//$a = json_encode($arr);
//printf(json_encode($arr));
echo "dssd";
$data = (array(
    array("name 1", "age 1", "city 1"),
    array("name 2", "age 2", "city 2"),
    array("name 3", "age 3", "city 3")
));

$output = fopen("teste.csv", "w+");
foreach ($data as $row) {
    fputcsv($output, $row, ";");
}
fclose($output);
echo "n";

if (($handle = fopen("teste.csv", "r")) !== FALSE) {
    
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c = 0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>


    </body>
</html>
