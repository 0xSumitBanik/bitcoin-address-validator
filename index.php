<?php include 'header.php'?>
<?php

function decodeBase58($inputAddress)
{
        $validCharacters = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz"; //Supported Characters in BTC Address
       
        $arrayNew = array_fill(0, 25, 0); // Array ( [0]=>0 ..... [24]=>0 )

        for($i=0;$i<strlen($inputAddress);$i++)
        {
                if(($p=strpos($validCharacters, $inputAddress[$i]))===false) //Checks for invalid character
                {
                    $message = "Bitcoin Address contains invalid character";
                }
                else
                {
                    $message = "Bitcoin Address is valid";
                    
                    $c = $p;
                    for ($j = 25; $j--; ) 
                    {
                            $c += (int)(58 * $arrayNew[$j]);
                            $arrayNew[$j] = (int)($c % 256);
                            (int) $c /= 256;
                    }
                    if($c != 0)
                    {
                        $message = "Bitcoin Address too long";
                    }
                    else    
                    {
                        $message = "Bitcoin Address is valid";
                    }
                }
        }
 
        $result = "";
        foreach($arrayNew as $asciiValue)
        {
                $result .= chr($asciiValue);
        }
  
        return $result;
}
    if(isset($_POST['submit']))
    {
        $addressToBeChecked = $_POST['address']; //Stores the address provided in the text box
        
        $decoded = decodeBase58($addressToBeChecked); //Stores the decoded address

        $hashingAlgorithm = "sha256"; //Algorithm used to hash the String

        $d1 = hash($hashingAlgorithm, substr($decoded,0,21), true);
        $d2 = hash($hashingAlgorithm, $d1, true);

        if(substr_compare($decoded, $d2, 21, 4))
        {
                $message = "Invalid Bitcoin Address";
        }
        else
        {
                $message = "Bitcoin Address is valid";
        }
    }

?>

<?php include 'form.php'?>