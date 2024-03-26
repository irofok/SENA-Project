<?PHP
// include('./conecction.php');
$statuses = ['CANCELADA','PENDIENTE','ATENDIDA'];

$results=[];

//loop throught statuses and query 
foreach($statuses as $status){
    $stmt =  $conn->prepare("SELECT COUNT(*) as status_count FROM tblestadocita WHERE tblestadocita.estEstado='". $status ."'" );
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['status_count'];

    $results[] = [
        'name' => strtoupper($status),
        'y' => (int) $count
    ];

}


?>
