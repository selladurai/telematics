<?php
include_once $_SERVER["DOCUMENT_ROOT"]."includes/functions.php";
$Device=new devicedetails();
$deviceinfo=$Device->getdeviceinfo($_REQUEST,$_SERVER);
$_data_decode=json_decode($deviceinfo);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Device Id</th>
            <th>Device Label</th>
            <th>Last Report Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php foreach ($_data_decode as $key => $value) {?>
        <tr>
            <!--Each table column is echoed in to a td cell-->
            <td><?php echo $value->device_id; ?></td>
            <td><?php echo $value->device_label; ?></td>
            <td><?php echo date($value->reported_time); ?></td>
            <?php
            $date=date("Y-m-d H:i:s");
            $date=date('Y-m-d H:i:s', strtotime('-1 day', strtotime($date)));
             if($value->reported_time>$date){?>
            <td style="color:green">Active</td>
            <?php }else{?>
            <td style="color:red">OFF LINE</td>
			<?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>