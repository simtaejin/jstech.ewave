<?php
include_once "../connect.php";

$query = "
    SELECT level_origin, level_acid, level_cip, level_alkali
    FROM ro_jstech
    order by create_at desc limit 1;
";
$result = mysqli_query($conn, $query);
$rows = array();
while($row = mysqli_fetch_array($result))
    $rows[] = $row;

$watertank_arr = array();

$create_at_arr = array();


    array_push($watertank_arr, array(0, floor($rows[0]['level_origin'])));
    array_push($watertank_arr, array(1, floor($rows[0]['level_acid'])));
    array_push($watertank_arr, array(2, floor($rows[0]['level_cip'])));
    array_push($watertank_arr, array(3, floor($rows[0]['level_alkali'])));


    array_push($create_at_arr, array(0, 'level_origin'));
    array_push($create_at_arr, array(1, 'level_acid'));
    array_push($create_at_arr, array(2, 'level_cip'));
    array_push($create_at_arr, array(3, 'level_alkali'));



$watertank = array(
    'data' => $watertank_arr,
    'bars' => array('show'=>true,),
);


//echo "<xmp>";
//print_r($watertank);
//echo "</xmp>";


$response = array();
$response['pay_load']['success'] = "success";
$response['pay_load']['dataset'] = array('watertank'=>$watertank,);
$response['pay_load']['create_at'] = $create_at_arr;

echo json_encode($response);

?>