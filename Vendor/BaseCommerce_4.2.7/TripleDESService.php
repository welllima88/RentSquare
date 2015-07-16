<?php

/**
 * Description of TripleDESService
 * TripleDESService is an entity that is used to encrypt / decrypt the data.
 *
 * © Base Commerce
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class TripleDESService {
    
    private $io_key;
    
    /**
     * Creates a new TripleDESService using the provided HEX encoded String which will be converted back to bytes and used to generate the Key
     * @param vs_key HEX encoded string to create Key from
     */
    function __construct( $vs_key ) {
        if( function_exists( 'hex2bin') ) {
            $this->io_key = hex2bin( $vs_key );
        } else {
            $this->io_key = pack("H*" , $vs_key);
        }
        
    }    
    
    /**
     * Encrypts the plain text that is provided using the Key this TripleDESService was initialized with
     * 
     * @param plaintext the plain text to be encrypted
     * @return the cipher text resulting from the encryption of the plain text
     * @throws Exception
     */
    function encrypt($input) {
        
        $size = mcrypt_get_block_size(MCRYPT_TRIPLEDES, 'ecb');
        $input = $this->pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_TRIPLEDES, '', 'ecb', '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $this->io_key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        
        $data = $this->txtsec2binsec( $data );
        
        $data = $this->binsec2hexsec( $data );
        
        $data = urlencode($data);
        return $data;
    }
    
    /**
     * Decrypts the cipher text that is provided using the Key this TripleDESService was initialized with
     *
     * @param ciphertext the cipher text to be decrypted
     * @return the plain text resulting from the decryption of the cipher text
     * @throws Exception
     */
    function decrypt($input){ 
//        $input = trim(chop(base64_decode($input)));
//        $input = hex2bin( $input );
        $input = $this->hexsec2binsec( $input );
        $input = $this->binsec2txtsec($input);
        $td = mcrypt_module_open ('tripledes', '', 'ecb', ''); 
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND); 
        mcrypt_generic_init ($td, $this->io_key, $iv); 
        $decrypted_data = mdecrypt_generic ($td, $input); 
        mcrypt_generic_deinit ($td); 
        mcrypt_module_close ($td);
        return trim(chop($decrypted_data)); 
    } 
    
    /**
     * 
     * Helper function to perform TripleDES with PKCS5 Padding
     * @param $text  text to pad
     * @param $blocksize size to pad too
     * @return the padded text
     */
    private function pkcs5_pad ($text, $blocksize){
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
    
    /**
     * 
     * Helper function to perform TripleDES with PKCS5 Padding
     * @param $text  text to unpad
     * @return the unpadded text
     */
    private function pkcs5_unpad($text) 
    { 
        $pad = ord($text{strlen($text)-1}); 
        if ($pad > strlen($text)) { return false; }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) { return false; }
        return substr($text, 0, -1 * $pad); 
    } 

    private function binsec2txtsec($binsec)
    {        
        $Data = '';
        for($i=0;$i<strlen($binsec);$i+=8)
        {
            $bin = substr($binsec, $i, 8);
            $Data .= chr(bindec($bin));
            //if($i != strlen($hexsec)-2)
            //    $Data .= " ";
        }
        return $Data;
    }

    private function txtsec2binsec($txtsec)
    {
        $Data = '';
        for($i=0;$i<strlen($txtsec);$i++)
        {
            $mybyte = decbin(ord($txtsec[$i]));
            $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
            $Data .= $MyBitSec;
            //if($i != strlen($txtsec)-1)
            //    $Data .= " ";
        }
        return $Data;
    }
    
    private function binsec2hexsec($binsec)
    {        
        $Data = '';
        for($i=0;$i<strlen($binsec);$i+=8)
        {
            $bin = substr($binsec, $i,8);
            $hex = dechex(bindec($bin));
            $hex = substr("00",0,2 - strlen($hex)) . $hex;
            $Data .= $hex;
            //if($i != strlen($hexsec)-2)
            //    $Data .= " ";
        }
        return $Data;
    }
    
    private function hexsec2binsec($hexsec)
    {        
        $Data = '';
        for($i=0;$i<strlen($hexsec);$i+=2)
        {
            $mybyte = decbin(hexdec($hexsec[$i].$hexsec[$i+1]));
            $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
            $Data .= $MyBitSec;
            //if($i != strlen($hexsec)-2)
            //    $Data .= " ";
        }
        return $Data;
    }
}

?>
