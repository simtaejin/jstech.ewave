<?php
include_once "../connect.php";

if ($_REQUEST['do_work'] == 'true') {
    $do_work = 1;
    $sql = "insert ro_control_jstech set mb_id='mb_id 1', create_at=now(), do_work=1, do_cip=0, check_at=now() ";

} else if ($_REQUEST['do_work'] == 'false') {
    $sql = "insert ro_control_jstech set mb_id='mb_id 1', create_at=now(), do_work=0, do_cip=0, check_at=now() ";
}
mysqli_query($conn, $sql);

$sql = "select * from ro_control_jstech where mb_id='mb_id 1' order by create_at desc limit 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$do_work = !$row['do_work'] && "" ? 0 : $row['do_work'];
$do_cip = !$row['do_cip'] && "" ? 0 : $row['do_cip'];

$response = array();
$response['pay_load']['success'] = "success";
$response['pay_load']['do_work'] = $do_work;
$response['pay_load']['do_cip'] = $do_cip;
echo json_encode($response);
?>