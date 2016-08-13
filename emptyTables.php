<?php
include_once 'core/database/connect.php';
$sql = $db->query("TRUNCATE TABLE `orders`");
mysqli_query($sql);
$sql1 = $db ->query("TRUNCATE TABLE `posted_orders_table`");
mysqli_query($sql1);
$sql2 = $db ->query("TRUNCATE TABLE `collection_journ`");
mysqli_query($sql2);
$sql3 = $db ->query("TRUNCATE TABLE `collection_receipt_entry`");
mysqli_query($sql3);
$sql4 = $db ->query("TRUNCATE TABLE `collection_receipt_entry_app`");
mysqli_query($sql4);
$sql5 = $db ->query("TRUNCATE TABLE `customers_ledger`");
mysqli_query($sql5);
$sql6 = $db ->query("TRUNCATE TABLE `integration_register`");
mysqli_query($sql6);
$sql7 = $db ->query("TRUNCATE TABLE `integration_register_entry`");
mysqli_query($sql7);
$sql8 = $db ->query("TRUNCATE TABLE `transferentry`");
mysqli_query($sql8);
$sql9 = $db ->query("TRUNCATE TABLE `transferorder`");
mysqli_query($sql9);
$sql10 = $db ->query("TRUNCATE TABLE `selectedledger`");
mysqli_query($sql10);
$sql5 = $db ->query("TRUNCATE TABLE `item_ledger`");
mysqli_query($sql1);
header("location:index.php")
?>