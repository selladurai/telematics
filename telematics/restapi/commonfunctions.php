<?php
/**
* 
*/
class commonfunctions{
        public function decrypt($string, $key){
                $result = "";
                $string = base64_decode($string);
                $end_length = intval(substr($string, -1, 1));
                $string = substr($string, 0, -1);
                $salt_length = intval(substr($string, $end_length*-1, $end_length));
                $string = substr($string, 0, $end_length*-1+$salt_length*-1);
                for($i=0; $i<strlen($string); $i++){
                        $char = substr($string, $i, 1);
                        $keychar = substr($key, ($i % strlen($key))-1, 1);
                        $char = chr(ord($char)-ord($keychar));
                        $result.=$char;
                }
        return $result;
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
}
?>