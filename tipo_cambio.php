<?php
function getPriceusd($url) {
$decode = file_get_contents ($url);
return json_decode ($decode, true);
}

$btcUSD = getPriceusd('https://bitpay.com/api/rates/usd');
$btcPriceusd = $btcUSD ["rate"];
//pesos
function getPricemxn($url2) {
$decode2 = file_get_contents ($url2);
return json_decode ($decode2, true);
}

$btcMXN = getPricemxn('https://api.bitso.com/v2/ticker');
$btcPricemxn = $btcMXN ["last"];
//coindesk

function getPriceusd2($url3) {
$decode3 = file_get_contents ($url3);
return json_decode ($decode3);
}

$btcUSD2 = getPriceusd2('http://api.coindesk.com/v1/bpi/currentprice.json');
$btcPriceusd2 = $btcUSD2->bpi->USD->rate_float;


$btcDisplay1 = round($btcPriceusd, 2);
$btcDisplay2 = round($btcPricemxn, 2);
$btcDisplay3 = round($btcPriceusd2, 2);


  $locale = "es_MX";
  if( is_callable("locale_accept_from_http") ){
    $locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
  }
  $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);

 ?>
 <tr>
   <td>USD</td>
   <td style="text-align:right;"><?php
      echo $fmt->formatCurrency($btcDisplay1,  "USD");
   ?> </td>
   <td>(Bitpay)</td>
 </tr>
 <tr>
   <td>USD</td>
   <td style="text-align:right;"><?php
     echo $fmt->formatCurrency($btcDisplay3,  "USD");
   ?> </td>
   <td>(Coindesk)</td>
 </tr>
 <tr>
   <td>MXN</td>
   <td style="text-align:right;"><?php
     echo $fmt->formatCurrency($btcDisplay2,  "MXN");
     echo "<input type ='hidden' id='bitso_value' value='".$btcDisplay2."' />";
   ?> </td>
   <td>(Bitso)</td>
 </tr>
