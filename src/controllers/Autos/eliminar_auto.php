<?php

include('../../DB/conecction.php');
// var_dump($_POST);

if(isset($_POST['deletedatacar'])) {
    $placaID  = $_POST['deleteCar'];

    try {

    $stmt = $conn->prepare("DELETE FROM tblautos WHERE carPlacaID = :placaID");
    $stmt->bindParam(':placaID', $placaID );

    if ($stmt->execute())
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:  ../../admin_panel.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
} catch(PDOException $e){
    echo $e->getMessage();
}
}

?>




