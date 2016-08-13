<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
       closeImage   : 'src/closelabel.png'
      });
        $(document).bind('beforeReveal.facebox', function() {
      $("#facebox .content").empty();
    });
   });
   </script>
<ul  class="list-unstyled">
<?php
include_once 'core/database/connect.php';
	$cid = $_POST['CustomerId'];
	
$getCustomer = $db->query("SELECT * FROM customers WHERE customer_no LIKE '%$cid%' OR name LIKE '%$cid%'");
while($row=$getCustomer->fetch_array()){
	$id = $row['customer_no'];
	$name = $row['name'];
	echo "<li><a rel='facebox' href='customerinfoReturn.php?cid=$id'>$id - $name</a></li>";	
	}
	
									

					?>
</ul>