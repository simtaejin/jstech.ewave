<?php
include_once "../connect.php";

if ($_REQUEST['do_work'] == 'true') {
    $do_work = 1;
//    $sql = "insert ro_control_jstech set mb_id='mb_id 1', create_at=now(), do_work=1, do_cip=0, check_at=now() ";
    $sql = "insert control_data set create_at=now(), address='1122', board_type='4', board_number='3', relay1='1', relay2='0' ";

} else if ($_REQUEST['do_work'] == 'false') {
//    $sql = "insert ro_control_jstech set mb_id='mb_id 1', create_at=now(), do_work=0, do_cip=0, check_at=now() ";
    $sql = "insert control_data set create_at=now(), address='1122', board_type='4', board_number='3', relay1='0', relay2='1' ";
}
mysqli_query($conn, $sql);

$sql = "select * from control_data  order by create_at desc limit 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$do_work = !$row['relay1'] && "" ? 0 : $row['relay1'];
$do_cip = !$row['relay2'] && "" ? 0 : $row['relay2'];

$response = array();
$response['pay_load']['success'] = "success";
$response['pay_load']['do_work'] = $do_work;
$response['pay_load']['do_cip'] = $do_cip;
echo json_encode($response);
?>
