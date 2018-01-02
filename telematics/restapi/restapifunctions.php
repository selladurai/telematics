<?php
class restAPI
{
	protected $method='';
	protected $servername='';
	protected $username='';
	protected $password='';
	protected $dbname='';
    public function __construct($request, $server) {
    	$this->method=$server["REQUEST_METHOD"];
    	$this->servername='localhost';
		$this->username='root';
		$this->password='root';
		$this->dbname='fleetsu';
    }
    public function getdevice() {
        if ($this->method == 'GET') {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT device_id, device_label, reported_time,status FROM telematics_device";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$_data=mysqli_fetch_all($result,MYSQLI_ASSOC);
			}
            return $_data;
        } else {
            return "Only accepts GET requests";
        }
     }
 }
?>