<?php

require( 'vendor/autoload.php' );


$site_id            = 'default';

$controlleruser     = 'admin';

$controllerpassword = 'Smhau$31.%';

$controllerurl      = 'https://unifi.smarthaus.com.mx:8443';

$cookietimeout      = '3600';

$ap_mac             = "fc:ec:da:1c:e0:50";


$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);


$login  = $unifidata->login();

if($login > 400) {
  echo "Fallo de conexion";
  die;
}


$unifiSpectrum= $unifidata->spectrum_scan_state($ap_mac);

$spectrumJson = json_encode($unifiSpectrum, JSON_PRETTY_PRINT);


$unifiDevices = $unifidata->list_devices();

$devicesJson = json_encode($unifiDevices, JSON_PRETTY_PRINT);


$unifiSettings = $unifidata->list_settings();

$settingsJson = json_encode($unifiSettings, JSON_PRETTY_PRINT);


$unifiUsers = $unifidata->list_users();

$usersJson = json_encode($unifiUsers, JSON_PRETTY_PRINT);


$unifiClients = $unifidata->list_clients();

$clientsJson = json_encode($unifiClients, JSON_PRETTY_PRINT);


$unifiAuths = $unifidata->stat_auths();

$authsJson = json_encode($unifiAuths, JSON_PRETTY_PRINT);


$unifiGuests = $unifidata->list_guests();

$guestsJson = json_encode($unifiGuests, JSON_PRETTY_PRINT);


$unifiEvents = $unifidata-> list_events();

$eventsJson = json_encode($unifiEvents, JSON_PRETTY_PRINT);


$unifiDpi = $unifidata-> list_dpi_stats();

$dpiJson = json_encode($unifiDpi,  JSON_PRETTY_PRINT);


$unifiAllusers= $unifidata-> stat_allusers();

$allusersJson = json_encode($unifiAllusers, JSON_PRETTY_PRINT);


$unifiSysinfo = array($unifidata-> stat_sysinfo());

$inputSysJson= json_encode($unifiSysinfo, JSON_PRETTY_PRINT);


$sysinfoArray = json_decode($inputSysJson);

$valuePrint = array_search("build", $unifiSysinfo);

$sysInfoJson = json_decode(json_encode($unifiSysinfo), true);

?>
<?php
function showKeys($input){
  foreach($input as $x => $y){
    echo $x;
  }
}
showKeys($inputSysJson)


?>

<?php
foreach($characters as $sysinfoArray){
  echo $sysinfoArray->build . '<br>';
}
?>

<?php
while ($sysArray = current($unifiSysinfo)){
  if($sysArray == "key"){
    echo key($unifiSysinfo)."<br />";
  }
  next ($unifiSysinfo);
}
?>

<?php
function releaseId($unifiArray){
  foreach($unifiArray as $key => $value){
    print_r( "Imprimir valor", $value);
  }
}
?>

<?php
function releaseData($unifiArray){
  foreach ($unifiArray as $key => $value){
    if ($value[$key] === true){
      echo $value[$key];
    }
  }
}
releaseData($sysinfoArray)
?>

<?php
function searchArray($unifiArray){
    $mainArray = array($unifiArray);
    $key = array_search("_id", $mainArray);
    global $key;
}
searchArray($unifiSettings)
?>

<!DOCTYPE html>
<html>
<head>
  <title>Unifi Smarthaus</title>
  <script type="text/javascript">
    setTimeout(function(){
      location.reload();
    },1000);
</script>
</head>
  <body>
    <style>
      .smart-title{
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
      }
      .scan-description {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
      }
      .status-codes {
        text-align: center;
      }
      .overflow-box{
        border: solid black;
        overflow: scroll;
        height: 400px;
      }
      .black-border {
        border: solid black;
      }
      .center-box{
        padding: 5%;
      }
      .top-title-box{

      }
    </style>
    <div class = "black-border" >
      <h1 class = "smart-title">UNIFI Smarthaus</h1>

      <div class = "black-border">
        <h3  class = "scan-description">Status conexión </h3>
        <pre class = "status-codes"> <?php echo $sysinfoArray?></pre>
      </div>


      <div class = "top-title-box">
        <h3 class = "scan-description">Unifi Settings</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $settingsJson?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description">System Info</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $inputSysJson?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description" >Scanning state</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $spectrumJson ?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description">List Devices</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $devicesJson ?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description">List Users</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $usersJson ?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description">List all users</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $allusersJson ?></pre>
        </div>
      </div>

      <div class = "top-title-box">
        <h3 class = "scan-description">List Clients</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $clientsJson ?></pre>
        </div>
      </div>

    <!--
      <div class = "top-title-box">
        <h3 class = "scan-description">List Auths</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $authsJson ?></pre>
        </div>
      </div>
    -->

      <div class = "top-title-box">
        <h3 class = "scan-description">List Guests</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $guestsJson?></pre>
        </div>
      </div>

    <!--
      <div class = "top-title-box">
        <h3 class = "scan-description">List DPI stats</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $dpiJson ?></pre>
        </div>
      </div>
    -->

      <div class = "top-title-box">
        <h3 class = "scan-description">List events</h3>
      </div>
      <div class = "overflow-box">
        <div class = "center-box">
          <pre><?php echo $eventsJson ?></pre>
        </div>
      </div>

    </div>

  </body>
</html>
