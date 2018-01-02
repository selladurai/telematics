<?php
class devicedetails{
	public function getdeviceinfo($request=array(), $server=array()){
		$_host=$server["HTTP_HOST"];
		$_data=array();
		$_data["request"]=$request;
		$_data["server"]=$server;
		$_data_encrypt=json_encode($_data);
		$_data_encrypt=htmlspecialchars($_data_encrypt);
		$_data_encrypt=$this->my_simple_crypt($_data_encrypt);
		$_url=$_host."/api?params=".$_data_encrypt;
		$response=$this->curlcall($_url);
		return $response;
	}
	protected function curlcall($url){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		return $resp;
	}
	function my_simple_crypt( $string, $action = 'e' ) {
	    // you may change these values to your own
	    $secret_key = 'my_simple_secret_key';
	    $secret_iv = 'my_simple_secret_iv';
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}
	protected function encrypt($string, $key){
        $result = "";
        for($i=0; $i<strlen($string); $i++){
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)+ord($keychar));
                $result.=$char;
        }
        $salt_string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789~!@#$^&*()_+`-={}|:<>?[]\;',./";
        $length = rand(1, 15);
        $salt = "";
        for($i=0; $i<=$length; $i++){
                $salt .= substr($salt_string, rand(0, strlen($salt_string)), 1);
        }
        $salt_length = strlen($salt);
        $end_length = strlen(strval($salt_length));
        return base64_encode($result.$salt.$salt_length.$end_length);
	}
}
?>