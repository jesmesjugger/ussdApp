<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$ussd_string_exploded = explode("*", $text);
        // Get ussd menu level number from the gateway
        $level = count($ussd_string_exploded);

if ($text == "" ) {
    // This is the first request. Note how we start the response with CON
    $response  = "CON Welcome to OldMutual Kindly Select one Option \n";
    $response .= "1. My Account \n";
    $response .= "2. My phone number \n";
    $response .= "3. Get Covid-19 Updates";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Account number \n";
    $response .= "2. Account balance \n";
    $response .= "3. Open New Account \n";
    $response .= "0. HOME";

}else if ($text == "3") {
        // Business logic for first level response
        $response = "CON Choose your prefered Covid-19  \n";
        $response .= "1. Get  Current News On Covid-19 \n";
        $response .= "2. Get information on Safety ways from Covid-19 \n";
}
else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is ".$accountNumber;

} else if ( $text == "1*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $balance  = "KES 10,000";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your balance is ".$balance;
}else if ($text == "1*3") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "CON Choose type of account register \n";
    $response .= "1. Mobile Banking \n";
    $response .= "2. Physical Bank";
}
elseif ($text == "1*3*1") {
    // when use response with option django
    $response = "CON Please enter your first name";
}

elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 3 && $level == 3) {
            $response = "CON Please enter your last name";
        }
elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 3 && $level == 4) {
            $response = "CON Please enter your phone number";
        }
 elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 3 && $level == 5) {
            $response = "CON Please enter your National Identity card Number";
        }
elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 3 && $level == 6) {
            $response = "CON Please enter your Email Address";
        }
        elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 3 && $level == 7) {
            // save data in the database
            $response = "END Your data has been captured successfully! Thank you for opening bank account with Faulu Bank";
        }

else if ( $text == "1*3*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $account1  = "Physical Bank";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your Account type will be ".$account1." Please visit any Nearest Faulu Bank ";
}
else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;
}
else if ( $text == "3*1" ) {
    // This is a second level response where the user selected 1 in the first instance
    $covidNews  = "Kenya records 14 more Covid-19 cases, 3 other recoveries";

    // This is a terminal request. Note how we start the response with END
    $response = "END Latest News ".$covidNews;
}
else if ( $text == "3*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $covidInfo = "is an infectious disease caused by a new virus.The disease causes respiratory illness (like the flu) with symptoms such as a cough, fever, and in more severe cases, difficulty breathing";

    // This is a terminal request. Note how we start the response with END
    $response = "END What is Covid-19".$covidInfo;
}
elseif ($ussd_string_exploded[0]) {
   return [0]:
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;
?>
