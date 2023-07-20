<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$servername = "localhost";
$username = "root";
$password = "Ziffity#23";
$dbname = "employee";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET["bus_no"])) {
    $busNumber = $_GET["bus_no"];
    $stmt = $conn->prepare("SELECT * FROM busMode WHERE bus_no = ?");
    $stmt->bind_param("s", $busNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $response[] = array(
                "bus_no" => $row["bus_no"],
                "destination_from" => $row["destination_from"],
                "destination_to" => $row["destination_to"],
                "days" => $row["days"],
                "timings" => $row["timings"],
                "amount" => $row["amount"]
            );
        }
        echo json_encode($response);
    } else {
        echo json_encode(array("error" => "No bus data found for the given bus number."));
    }
    $stmt->close();
} else {
    echo json_encode(array("error" => "Bus number not provided."));
}
$conn->close();
?>
