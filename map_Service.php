<?php require_once('_tools.php');

header("Access-Control-Allow-Origin: *");

$id = $_POST['id'];
$response = new stdClass();

$queryID = $db->prepare('SELECT *
FROM services
INNER JOIN medias_services
ON services.id = medias_services.service_id
INNER JOIN medias
ON medias_services.media_id = medias.id
WHERE services.id = ?');

$queryID->execute(array($id));
$service=$queryID->fetch();

if ($service){
    $response-> type = 1;
    $response-> service = $service;
    $response->msg = "ca va";


}
else{
    $response->type = 0;
    $response->msg = "Il n ' y a pas de service";
}

echo json_encode($response);

?>

