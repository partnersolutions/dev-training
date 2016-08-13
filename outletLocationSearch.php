<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
       closeImage   : 'src/closelabel.png'
      })
        $(document).bind('beforeReveal.facebox', function() {
      $("#facebox .content").empty();
    });
   });
   </script>
<ul  class="list-unstyled">
	<?php
	include_once 'core/database/connect.php';
		$otcode = $_POST['outletcode'];
	   $outlet = $db->query("SELECT * FROM outlets WHERE name LIKE '%$otcode%' OR locationID='$otcode'");
			while ($row = $outlet->fetch_assoc()) {
			
			$toLocCode=$row['locationCode'];
			$locatioName=$row['name'];
			$toadd=$row['address'];

			echo "<li><a rel='facebox' href='outletinfo.php?id=".$row['locationID']."'>$toLocCode - $locatioName</li>";

	}
	?>
</ul>
<script src='js/jquery-2.1.3.min.js'></script>
   <script src="js/bootstrap.min.js"></script>
					