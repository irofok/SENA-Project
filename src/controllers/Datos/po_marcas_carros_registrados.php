<?PHP
// include('./conecction.php');
// Realiza una consulta SQL para contar la cantidad de registros por marca de vehículo
$stmt = $conn->prepare("
    SELECT m.marcaNombre, COUNT(*) as cantidad_registros
    FROM tblautos a 
    INNER JOIN tblmarca m  ON m.marcaId = a.carMarca
    GROUP BY m.marcaNombre
    ORDER BY cantidad_registros DESC
    LIMIT 10
");
$stmt->execute();
$rows = $stmt->fetchAll();

$marcas = [];
$cantidad_data=[];


// Llena los arrays con los datos de la consulta
foreach ($rows as $row) {
    $marcas[] = $row['marcaNombre'];
    $cantidad_data[] = (int)$row['cantidad_registros'];
}

// // Codifica los arrays como JSON para usarlos en Highcharts
// $marcas= json_encode($marcas);
// $cantidades = json_encode($cantidad_data);
?>


