
<?php

session_start(); //start the PHP_session function 

if(isset($_SESSION['page_count']))
{
     $_SESSION['page_count'] += 1;
}
else
{
     $_SESSION['page_count'] = 1;
}
 echo 'You are visitor number ' . $_SESSION['page_count'];

?>




<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$adresseip = getRealIpAddr();

// Script Online Users and Visitors - http://coursesweb.net/php-mysql/
if(!isset($_SESSION)) session_start();        // start Session, if not already started

$filetxt = 'userson.txt';  // the file in which the online users /visitors are stored
$timeon = 120;             // number of secconds to keep a user online
$sep = '^^';               // characters used to separate the user name and date-time
$vst_id = '-vst-';        // an identifier to know that it is a visitor, not logged user

/*
 If you have an user registration script,
 replace $_SESSION['nume'] with the variable in which the user name is stored.
 You can get a free registration script from:  http://coursesweb.net/php-mysql/register-login-script-users-online_s2
*/

// get the user name if it is logged, or the visitors IP (and add the identifier)

    $uvon = isset($_SESSION['nume']) ? $_SESSION['nume'] : $_SERVER['SERVER_ADDR']. $vst_id;

$rgxvst = '/^([0-9\.]*)'. $vst_id. '/i';         // regexp to recognize the line with visitors
$nrvst = 0;                                       // to store the number of visitors

// sets the row with the current user /visitor that must be added in $filetxt (and current timestamp)

    $addrow[] = $uvon. $sep. time();

// check if the file from $filetxt exists and is writable

    if(is_writable($filetxt)) {
      // get into an array the lines added in $filetxt
      $ar_rows = file($filetxt, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $nrrows = count($ar_rows);

            // number of rows

  // if there is at least one line, parse the $ar_rows array

      if($nrrows>0) {
        for($i=0; $i<$nrrows; $i++) {
          // get each line and separate the user /visitor and the timestamp
          $ar_line = explode($sep, $ar_rows[$i]);
      // add in $addrow array the records in last $timeon seconds
          if($ar_line[0]!=$uvon && (intval($ar_line[1])+$timeon)>=time()) {
            $addrow[] = $ar_rows[$i];
          }
        }
      }
    }

$nruvon = count($addrow);                   // total online
$usron = '';                                    // to store the name of logged users
// traverse $addrow to get the number of visitors and users
for($i=0; $i<$nruvon; $i++) {
 if(preg_match($rgxvst, $addrow[$i])) $nrvst++;       // increment the visitors
 else {
   // gets and stores the user's name
   $ar_usron = explode($sep, $addrow[$i]);
   $usron .= '<br/> - <i>'. $ar_usron[0]. '</i>';
 }
}
$nrusr = $nruvon - $nrvst;              // gets the users (total - visitors)

// the HTML code with data to be displayed
$reout = '<div id="uvon"><h4>Online: '. $nruvon. '</h4>Visitors: '. $nrvst. '<br/>Users: '. $nrusr. $usron. '</div>';

// write data in $filetxt
if(!file_put_contents($filetxt, implode("\n", $addrow))) $reout = 'Error: Recording file not exists, or is not writable';

// if access from <script>, with GET 'uvon=showon', adds the string to return into a JS statement
// in this way the script can also be included in .html files
if(isset($_GET['uvon']) && $_GET['uvon']=='showon') $reout = "document.write('$reout');";

echo $reout; 


?>

<script type="text/javascript" src="usersontxt.php?uvon=showon"></script>



<?php
// Script Online Users and Visitors - coursesweb.net/php-mysql/
if(!isset($_SESSION)) session_start();         // start Session, if not already started

// HERE add your data for connecting to MySQ database
$$server = "localhost";
$username = "root";
$password = "root";
$db       = "chile";

//create a connection

    //check connection
    
    
     // echo "Connected successfully";
/*
 If you have an user registration script,
 replace $_SESSION['nume'] with the variable in which the user name is stored.
 You can get a free registration script from:  http://coursesweb.net/php-mysql/register-login-script-users-online_s2
*/

// get the user name if it is logged, or the visitors IP (and add the identifier)
$vst_id = '-vst-';         // an identifier to know that it is a visitor, not logged user
$uvon = isset($_SESSION['nume']) ? $_SESSION['nume'] : $_SERVER['SERVER_ADDR']. $vst_id;

$rgxvst = '/^([0-9\.]*)'. $vst_id. '/i';         // regexp to recognize the rows with visitors
$dt = time();                                    // current timestamp
$timeon = 120;             // number of secconds to keep a user online
$nrvst = 0;                                     // to store the number of visitors
$nrusr = 0;                                     // to store the number of usersrs
$usron = '';                                    // to store the name of logged users

// connect to the MySQL server
$conn = mysqli_connect ( $server, $username, $password, $db );


// Define and execute the Delete, Insert/Update, and Select queries
$sqldel = "DELETE FROM `userson` WHERE `dt`<". ($dt - $timeon);
$sqliu = "INSERT INTO `userson` (`uvon`, `dt`) VALUES ('$uvon', $dt) ON DUPLICATE KEY UPDATE `dt`=$dt";
$sqlsel = "SELECT * FROM `userson`";

// Execute each query
if(!$conn->query($sqldel)) echo 'Error: '. $conn->error;
if(!$conn->query($sqliu)) echo 'Error: '. $conn->error;
$result = $conn->query($sqlsel);

// if the $result contains at least one row
if ($result->num_rows > 0) {
  // traverse the sets of results and set the number of online visitors and users ($nrvst, $nrusr)
  while($row = $result->fetch_assoc()) {
    if(preg_match($rgxvst, $row['uvon'])) $nrvst++;       // increment the visitors
    else {
      $nrusr++;                   // increment the users
      $usron .= '<br/> - <i>'.$row['uvon']. '</i>';    
        // stores the user's name
    }
  }
}

$conn->close();                  // close the MySQL connection

// the HTML code with data to be displayed
$reout = '<div id="uvon"><h4>Online: '. ($nrusr+$nrvst). '</h4>Visitors: '. $nrvst. '<br/>Users: '. $nrusr. $usron. '</div>';

// if access from <script>, with GET 'uvon=showon', adds the string to return into a JS statement
// in this way the script can also be included in .html files
if(isset($_GET['uvon']) && $_GET['uvon']=='showon') $reout = "document.write('$reout');";

echo $reout;             // output /display the result


?>




