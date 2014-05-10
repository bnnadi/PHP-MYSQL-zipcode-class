<?php
    /**
	 * This script will allow you to enter a zipcode and found other zip codes around up to 150 miles away
	 * 
	 * Author: Bisike Nnadi 
	 * 
	 */
   include("database/connection.php");  
    class zipCode {
		
		public function findDistance($postalCode) {
			$sql = "SELECT longitude, latitude FROM zip_codes WHERE postal_code = '$postalCode' LIMIT 1;";
			
			$result = mysql_query($sql) ;
			$result = mysql_fetch_array($result);
			return $result;
		
		}
		
		public function calcDistance($lon, $lat) {
			
			$sql = "SELECT *, ((ACOS(SIN('$lat' * PI() / 180) * SIN(builder_latitude * PI() / 180) + COS('$lat' * PI() / 180) * COS(builder_latitude * PI() / 180) 
					* COS(('$lon' - builder_logitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) 
					AS distance FROM builders HAVING distance <=150 ORDER BY distance ASC";
			
			$distance = mysql_query($sql) or die(mysql_error());
			
			return $distance;
			
		}
	
    }
    
?>