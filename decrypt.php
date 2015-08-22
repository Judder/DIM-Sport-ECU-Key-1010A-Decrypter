<?php

/*
 * DIM Sport ECU Key 1010A Decrypter
 * (c)Alex Judd 2015
 * alex@alexjudd.com
 * This software code and it's contents are strictly for educational purposes only and may not be sold or
 * reproduced in any form without the author's strict permission. 
 */

  $decrypted = '';
  $filename = "tvrcerberaecu94110035encrypted.bin";
  $handle = fopen($filename, "r");
  $contents = fread($handle, filesize($filename));
  fclose($handle);
  //convert our binary data to Hex string, high nibble first
  $byteArray = unpack("H*",$contents); 
  foreach($byteArray as $byteString) {
    //split each letter in the byte string 
    $byteStringArray = str_split($byteString, 1);
    $i = 0;
    foreach($byteStringArray as $byte) {
      //decode every even character according to the mapping, straight copy every odd character
      if ($i == 0) {
        $decrypted .= $byte;
      } else {
         switch(strtoupper($byte)) {
           case '0':
             $decrypted .= '0';
             break;
           case '1':
             $decrypted .= '4';
             break;
           case '2':
             $decrypted .= '2';
             break;
           case '3':
             $decrypted .= '6';
             break;
           case '4':
             $decrypted .= '1';
             break;
           case '5':
             $decrypted .= '5';
             break;
           case '6':
             $decrypted .= '3';
             break;
           case '7':
             $decrypted .= '7';
             break;
           case '8':
             $decrypted .= '8';
             break;
           case '9':
             $decrypted .= 'C';
             break;
           case 'A':
             $decrypted .= 'A';
             break;
           case 'B':
             $decrypted .= 'E';
             break;
           case 'C':
             $decrypted .= '9';
             break;
           case 'D':
             $decrypted .= 'D';
             break;
           case 'E':
             $decrypted .= 'B';
             break;
           case 'F':
             $decrypted .= 'F';
             break;
         }
      }
      $i++;
      if ($i == 2) {
        $i = 0;
        //convert hex values back to binary file
        $bindata .= pack('H*', $decrypted);
        $decrypted = '';
      }
    }
    file_put_contents('tvrcerberaecu94110035unencrypted.bin', $bindata);
  }
?>
