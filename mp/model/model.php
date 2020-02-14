<?php

	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'movieprops');

	function DBConnect() {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno()) {
		    header('Location: controller/controller.php?page=error');
		}
		mysqli_set_charset($mysqli, 'utf8');
		return $mysqli;
	}
	
	function CheckForExistingEmail($email) {
		$query = "SELECT cid FROM customer WHERE cemail=?";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("s", $email);
			$stmt->execute();
    		$stmt->store_result();
    		if ($stmt->num_rows == 0) {
		    	$stmt->close();
    			return false;
    		} else {
				$stmt->close();
				return true;
    		}
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

	function CreateNewCustomer($name, $email, $password) {
		$query = "INSERT INTO customer (cname, cemail, cpassword) VALUES (?,?,?)";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("sss", $name, $email, $password);
			return $stmt->execute();
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

	function CheckForCustomer($email, $password) {
		$query = "SELECT cid, cname, cemail FROM customer WHERE cemail=? AND cpassword=?";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ss", $email, $password);
			$stmt->execute();
    		$stmt->store_result();
    		if ($stmt->num_rows == 0) {
		    	$stmt->close();
    			return null;
    		} else {
    			$stmt->bind_result($cid, $cname, $cemail);
    			$stmt->fetch();
		        $customer = array(
	        		'cid' => $cid, 
					'cname' => $cname, 
					'cemail' => $cemail
				);
			    $stmt->close();
			    return $customer;
    		}
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

	function GetCustomerInterests($cid) {
		$query = "SELECT pc.pid, p.pname, p.pcost, p.pavailability, pc.pcdate FROM productcustomer pc, product p WHERE pc.pid=p.pid AND cid=?";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("i", $cid);
			$stmt->execute();
    		$stmt->store_result();
    		if ($stmt->num_rows == 0) {
		    	$stmt->close();
    			return null;
    		} else {
    			$stmt->bind_result($pid, $pname, $pcost, $pavailability, $pcdate);
    			$customerinterests = [];
			    while ($stmt->fetch()) {
			        $customerinterests[] = array(
		        		'pid' => $pid, 
						'pname' => $pname, 
						'pcost' => $pcost, 
						'pavailability' => $pavailability, 
						'pcdate' => $pcdate
					);
			    }
			    $stmt->close();
				return $customerinterests;
    		}
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

	function GetNMostRecentlyAddedProducts($count) {
		return "SELECT p.pid, p.pname, p.pcost, p.pavailability, p.paddingdate, p.pphoto, m.mid, m.mname, m.myear, SUM(if(pc.cid IS NOT NULL, 1, 0)) FROM product p LEFT OUTER JOIN movie m ON p.mid=m.mid LEFT OUTER JOIN productcustomer pc ON p.pid=pc.pid GROUP BY p.pid ORDER BY p.paddingdate DESC LIMIT $count";
	}

	function GetNMostPopularProducts($count) {
		return "SELECT p.pid, p.pname, p.pcost, p.pavailability, p.paddingdate, p.pphoto, m.mid, m.mname, m.myear, SUM(if(pc.cid IS NOT NULL, 1, 0)) FROM product p LEFT OUTER JOIN movie m ON p.mid=m.mid LEFT OUTER JOIN productcustomer pc ON p.pid=pc.pid GROUP BY p.pid ORDER BY SUM(if(pc.cid IS NOT NULL, 1, 0)) DESC LIMIT $count";
	}

	function GetNProductsInGivenCostRange($count, $start, $end) {
		return "SELECT p.pid, p.pname, p.pcost, p.pavailability, p.paddingdate, p.pphoto, m.mid, m.mname, m.myear, SUM(if(pc.cid IS NOT NULL, 1, 0)) FROM product p LEFT OUTER JOIN movie m ON p.mid=m.mid LEFT OUTER JOIN productcustomer pc ON p.pid=pc.pid WHERE (p.pcost BETWEEN $start AND $end) GROUP BY p.pid LIMIT $count";
	}

	function GetNProductsInGivenMovieYearRange($count, $start, $end) {
		return "SELECT p.pid, p.pname, p.pcost, p.pavailability, p.paddingdate, p.pphoto, m.mid, m.mname, m.myear, SUM(if(pc.cid IS NOT NULL, 1, 0)) FROM product p LEFT OUTER JOIN movie m ON p.mid=m.mid LEFT OUTER JOIN productcustomer pc ON p.pid=pc.pid WHERE (m.myear BETWEEN $start AND $end) GROUP BY p.pid LIMIT $count";
	}

	function GetAllProductsWithRelatedMovies(
		$query="SELECT p.pid, p.pname, p.pcost, p.pavailability, p.paddingdate, p.pphoto, m.mid, m.mname, m.myear, SUM(if(pc.cid IS NOT NULL, 1, 0)) FROM product p LEFT OUTER JOIN movie m ON p.mid=m.mid LEFT OUTER JOIN productcustomer pc ON p.pid=pc.pid GROUP BY p.pid"
	) {
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
		    $stmt->execute();
    		$stmt->store_result();
    		if ($stmt->num_rows == 0) {
		    	$stmt->close();
    			return null;
    		} else {
			    $stmt->bind_result($pid, $pname, $pcost, $pavailability, $paddingdate, $pphoto, $mid, $mname, $myear, $numberoflikes);
			    $products = [];
			    while ($stmt->fetch()) {
			        $products[] = array(
		        		'pid' => $pid, 
						'pname' => $pname, 
						'pcost' => $pcost, 
						'pavailability' => $pavailability, 
						'paddingdate' => $paddingdate, 
						'pphoto' => $pphoto, 
						'mid' => $mid, 
						'mname' => $mname, 
						'myear' => $myear, 
						'numberoflikes' => $numberoflikes
					);
			    }
			    $stmt->close();
				return $products;
			}
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

	function Like($pid, $cid) {
		$query = "INSERT INTO productcustomer (pid, cid, pcdate) VALUES (?,?,now())";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ii", $pid, $cid);
			return $stmt->execute();
		} else {
			return false;
		}
	}

	function UnLike($pid, $cid) {
		$query = "DELETE FROM productcustomer WHERE pid=? AND cid=?";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ii", $pid, $cid);
			return $stmt->execute();
		} else {
			return false;
		}
	}

	function GetAllCustomerInfo() {
		$query = "SELECT c.cid, c.cname, c.cemail, SUM(if(pc.pid IS NOT NULL, 1, 0)) FROM customer c LEFT OUTER JOIN productcustomer pc ON c.cid=pc.cid GROUP BY c.cid";
		$mysqli = DBConnect();
		if ($stmt = $mysqli->prepare($query)) {
		    $stmt->execute();
    		$stmt->store_result();
    		if ($stmt->num_rows == 0) {
		    	$stmt->close();
    			return null;
    		} else {
			    $stmt->bind_result($cid, $cname, $cemail, $numberoflikedproducts);
			    $customers = [];
			    while ($stmt->fetch()) {
			        $customers[] = array(
		        		'cid' => $cid, 
						'cname' => $cname, 
						'cemail' => $cemail, 
						'numberoflikedproducts' => $numberoflikedproducts
					);
			    }
			    $stmt->close();
				return $customers;
			}
		} else {
			header('Location: controller/controller.php?page=error');
		}
	}

?>