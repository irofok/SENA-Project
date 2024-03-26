<?php
include('../../DB/conecction.php');


if(isset($_POST['deletedataper'])) {
    $perID  = $_POST['deletePer'];

    try {

    $stmt = $conn->prepare("DELETE FROM tblpersona WHERE perID = :perID");
    $stmt->bindParam(':perID', $perID );

    if ($stmt->execute())
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location: ../../admin_panel.php");
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

