   <?php
 ini_set('display_errors',1);


$country=array('notset' =>"(not set)",
'AF' =>"Afghanistan",
'AX' =>"Aland Islands",
'AL' =>"Albania",
'DZ' =>"Algeria",
'AS' =>"American Samoa",
'AD' =>"Andorra",
'AO' =>"Angola",
'AI' =>"Anguilla",
'AQ' =>"Antarctica",
'AG' =>"Antigua and Barbuda",
'AR' =>"Argentina",
'AM' =>"Armenia",
'AW' =>"Aruba",
'AU' =>"Australia",
'AT' =>"Austria",
'AZ' =>"Azerbaijan",
'BS' =>"Bahamas",
'BH' =>"Bahrain",
'BD' =>"Bangladesh",
'BB' =>"Barbados",
'BY' =>"Belarus",
'BE' =>"Belgium",
'BZ' =>"Belize",
'BJ' =>"Benin",
'BM' =>"Bermuda",
'BT' =>"Bhutan",
'BO' =>"Bolivia, Plurinational State of",
'BA' =>"Bosnia and Herzegovina",
'BW' =>"Botswana",
'BV' =>"Bouvet Island",
'BR' =>"Brazil",
'IO' =>"British Indian Ocean Territory",
'BN' =>"Brunei Darussalam",
'BG' =>"Bulgaria",
'BF' =>"Burkina Faso",
'BI' =>"Burundi",
'KH' =>"Cambodia",
'CM' =>"Cameroon",
'CA' =>"Canada",
'CV' =>"Cape Verde",
'KY' =>"Cayman Islands",
'CF' =>"Central African Republic",
'TD' =>"Chad",
'CL' =>"Chile",
'CN' =>"China",
'CX' =>"Christmas Island",
'CC' =>"Cocos (Keeling) Islands",
'CO' =>"Colombia",
'KM' =>"Comoros",
'CG' =>"Congo",
'CD' =>"Congo, The Democratic Republic of the",
'CK' =>"Cook Islands",
'CR' =>"Costa Rica",
'CI' =>"Côte d'Ivoire",
'HR' =>"Croatia",
'CU' =>"Cuba",
'CY' =>"Cyprus",
'CZ' =>"Czech Republic",
'DK' =>"Denmark",
'DJ' =>"Djibouti",
'DM' =>"Dominica",
'DO' =>"Dominican Republic",
'EC' =>"Ecuador",
'EG' =>"Egypt",
'SV' =>"El Salvador",
'GQ' =>"Equatorial Guinea",
'ER' =>"Eritrea",
'EE' =>"Estonia",
'ET' =>"Ethiopia",
'FK' =>"Falkland Islands [Islas Malvinas]",
'FO' =>"Faroe Islands",
'FJ' =>"Fiji",
'FI' =>"Finland",
'FR' =>"France",
'GF' =>"French Guiana",
'PF' =>"French Polynesia",
'TF' =>"French Southern Territories",
'GA' =>"Gabon",
'GM' =>"Gambia",
'GE' =>"Georgia",
'DE' =>"Germany",
'GH' =>"Ghana",
'GI' =>"Gibraltar",
'GR' =>"Greece",
'GL' =>"Greenland",
'GD' =>"Grenada",
'GP' =>"Guadeloupe",
'GU' =>"Guam",
'GT' =>"Guatemala",
'GG' =>"Guernsey",
'GN' =>"Guinea",
'GW' =>"Guinea-Bissau",
'GY' =>"Guyana",
'HT' =>"Haiti",
'HM' =>"Heard Island and McDonald Islands",
'VA' =>"Holy See (Vatican City State)",
'HN' =>"Honduras",
'HK' =>"Hong Kong",
'HU' =>"Hungary",
'IS' =>"Iceland",
'IN' =>"India",
'ID' =>"Indonesia",
'IR' =>"Iran, Islamic Republic of",
'IQ' =>"Iraq",
'IE' =>"Ireland",
'IM' =>"Isle of Man",
'IL' =>"Israel",
'IT' =>"Italy",
'JM' =>"Jamaica",
'JP' =>"Japan",
'JE' =>"Jersey",
'JO' =>"Jordan",
'KZ' =>"Kazakhstan",
'KE' =>"Kenya",
'KI' =>"Kiribati",
'KP' =>"South Korea",
'KR' =>"North Korea",
'KW' =>"Kuwait",
'KG' =>"Kyrgyzstan",
'LA' =>"Lao People's Democratic Republic",
'LV' =>"Latvia",
'LB' =>"Lebanon",
'LS' =>"Lesotho",
'LR' =>"Liberia",
'LY' =>"Libya",
'LI' =>"Liechtenstein",
'LT' =>"Lithuania",
'LU' =>"Luxembourg",
'MO' =>"Macao",
'MK' =>"Macedonia [FYROM]",
'MG' =>"Madagascar",
'MW' =>"Malawi",
'MY' =>"Malaysia",
'MV' =>"Maldives",
'ML' =>"Mali",
'MT' =>"Malta",
'MH' =>"Marshall Islands",
'MQ' =>"Martinique",
'MR' =>"Mauritania",
'MU' =>"Mauritius",
'YT' =>"Mayotte",
'MX' =>"Mexico",
'FM' =>"Micronesia, Federated States of",
'MD' =>"Moldova, Republic of",
'MC' =>"Monaco",
'MN' =>"Mongolia",
'ME' =>"Serbia and Montenegro",
'MS' =>"Montserrat",
'MA' =>"Morocco",
'MZ' =>"Mozambique",
'MM' =>"Myanmar [Burma]",
'NA' =>"Namibia",
'NR' =>"Nauru",
'NP' =>"Nepal",
'NL' =>"Netherlands",
'AN' =>"Netherlands Antilles",
'NC' =>"New Caledonia",
'NZ' =>"New Zealand",
'NI' =>"Nicaragua",
'NE' =>"Niger",
'NG' =>"Nigeria",
'NU' =>"Niue",
'NF' =>"Norfolk Island",
'MP' =>"Northern Mariana Islands",
'NO' =>"Norway",
'OM' =>"Oman",
'PK' =>"Pakistan",
'PW' =>"Palau",
'PS' =>"Palestinian Territories",
'PA' =>"Panama",
'PG' =>"Papua New Guinea",
'PY' =>"Paraguay",
'PE' =>"Peru",
'PH' =>"Philippines",
'PN' =>"Pitcairn",
'PL' =>"Poland",
'PT' =>"Portugal",
'PR' =>"Puerto Rico",
'QA' =>"Qatar",
'RE' =>"Réunion",
'RO' =>"Romania",
'RU' =>"Russia",
'RW' =>"Rwanda",
'BL' =>"Saint Barthélemy",
'SH' =>"Saint Helena",
'KN' =>"Saint Kitts and Nevis",
'LC' =>"Saint Lucia",
'MF' =>"Saint Martin",
'PM' =>"Saint Pierre and Miquelon",
'VC' =>"Saint Vincent and the Grenadines",
'WS' =>"Samoa",
'SM' =>"San Marino",
'ST' =>"Sao Tome and Principe",
'SA' =>"Saudi Arabia",
'SN' =>"Senegal",
'RS' =>"Serbia",
'SC' =>"Seychelles",
'SL' =>"Sierra Leone",
'SG' =>"Singapore",
'SK' =>"Slovakia",
'SI' =>"Slovenia",
'SB' =>"Solomon Islands",
'SO' =>"Somalia",
'ZA' =>"South Africa",
'GS' =>"South Georgia and the South Sandwich Islands",
'ES' =>"Spain",
'LK' =>"Sri Lanka",
'SD' =>"Sudan",
'SR' =>"Suriname",
'SJ' =>"Svalbard and Jan Mayen",
'SZ' =>"Swaziland",
'SE' =>"Sweden",
'CH' =>"Switzerland",
'SY' =>"Syrian Arab Republic",
'TW' =>"Taiwan",
'TJ' =>"Tajikistan",
'TZ' =>"Tanzania, United Republic of",
'TH' =>"Thailand",
'TL' =>"Timor-Leste",
'TG' =>"Togo",
'TK' =>"Tokelau",
'TO' =>"Tonga",
'TT' =>"Trinidad and Tobago",
'TN' =>"Tunisia",
'TR' =>"Turkey",
'TM' =>"Turkmenistan",
'TC' =>"Turks and Caicos Islands",
'TV' =>"Tuvalu",
'UG' =>"Uganda",
'UA' =>"Ukraine",
'AE' =>"United Arab Emirates",
'GB' =>"United Kingdom",
'US' =>"United States",
'UM' =>"United States Minor Outlying Islands",
'UY' =>"Uruguay",
'UZ' =>"Uzbekistan",
'VU' =>"Vanuatu",
'VE' =>"Venezuela, Bolivarian Republic of",
'VN' =>"Viet Nam",
'VG' =>"British Virgin Islands",
'VI' =>"U.S. Virgin Islands",
'WF' =>"Wallis and Futuna",
'EH' =>"Western Sahara",
'YE' =>"Yemen",
'ZM' =>"Zambia",
'ZW' =>"Zimbabwe");
 

require_once('gapi.class.php');
 
define('ga_account'     ,'islandpeeps1@gmail.com');
define('ga_password'    ,'elance987');
define('ga_profile_id'  ,'85622792'); 
 
$ga = new gapi(ga_account,ga_password);
 
/* We are using the 'source' dimension and the 'visits' metrics */
$dimensions = array('source');
$metrics    = array('visits');
 
/* We will sort the result be desending order of visits, 
    and hence the '-' sign before the 'visits' string */
$ga->requestReportData(ga_profile_id,array('country'),array('visits'),'-visits','','','',1,200);
$gaResults = $ga->getResults();
$sampledata='';
foreach($ga->getResults() as $result)
{
 
  $sampledata .= '"'.strtolower(array_search($result->getCountry(), $country)).'":"'. $result->getVisits() .'",';
}

$ga->requestReportData(ga_profile_id,array('country'),array('visits'),'-visits','ga:country!~(not set)');
$gaResults = $ga->getResults();
$countries ='';
foreach($ga->getResults() as $result)
{
 
  $countries .= '{  label: "'.$result->getCountry().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}

$ga->requestReportData(ga_profile_id,array('city'),array('visits'),'-visits','ga:city!~(not set)');
$gaResults = $ga->getResults();
$cities='';
foreach($ga->getResults() as $result)
{
 
  $cities .= '{  label: "'.$result->getCity().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}

/*
$ga->requestReportData(ga_profile_id,array('language'),array('visits'),'-visits');
$gaResults = $ga->getResults();
$languages ='';
foreach($ga->getResults() as $result)
{
 
  $languages .= '{  label: "'.$result->getLanguage().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}*/

$ga->requestReportData(ga_profile_id,array('browser'),array('visits'),'-visits','ga:browser!~(not set)');
$gaResults = $ga->getResults();
$browsers ='';
foreach($ga->getResults() as $result)
{
 
  $browsers .= '{  label: "'.$result->getBrowser().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}

$ga->requestReportData(ga_profile_id,array('operatingSystem'),array('visits'),'-visits');
$gaResults = $ga->getResults();
$os ='';
foreach($ga->getResults() as $result)
{
 
  $os .= '{  label: "'.$result->getOperatingSystem().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}

//$ga->requestReportData(ga_profile_id,array('networkLocation'),array('visits'),'-visits','ga:networkLocation!~(not set)');
$ga->requestReportData(ga_profile_id,array('networkLocation'),array('visits'),'-visits');
$gaResults = $ga->getResults();
$networkLocations ='';
foreach($ga->getResults() as $result)
{
  $networkLocations .= '{  label: "'.$result->getNetworkLocation().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}

$ga->requestReportData(ga_profile_id,array('screenResolution'),array('visits'),'-visits');
$gaResults = $ga->getResults();
$screenResolutions ='';
foreach($ga->getResults() as $result)
{
 
  $screenResolutions .= '{  label: "'.$result->getScreenResolution().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
}
 $Date=date('Y-m-d');
$ga->requestReportData(ga_profile_id,array('year','month','day'),array('visits','pageviews'),'year','',date('Y-m-d', strtotime($Date. '-10 days')),date('Y-m-d'));
$gaResults = $ga->getResults();
$visits ='';
$pageviews = '';
$pagetrackingviews = '';
foreach($ga->getResults() as $result)
{
 //echo '<pre>';print_r($result);echo '</pre>';
 
 $pagetrackingviews.= '{  date: "'.date('jS M', strtotime($result->getYear().'-'.$result->getMonth().'-'.$result->getDay())).'", value1: '.$result->getVisits().', value2: '.$result->getPageviews().' },';
 
$visits .='[gd('.$result->getYear().', '.$result->getMonth().', '.$result->getDay().') , '.$result->getVisits().'] ,'; 
$pageviews .='[gd('.$result->getYear().', '.$result->getMonth().', '.$result->getDay().') , '.$result->getPageviews().'] ,'; 
 
}

$fml = date('Y-m-d', strtotime("-4 months"));
$ga->requestReportData(ga_profile_id,array('source'),array('visits'),'-visits','ga:source!~(not set)');

 
$gaResults = $ga->getResults();
 
$smi=0;
$smii=0;
$sourcemedium ='';

foreach($ga->getResults() as $result)
{
 //echo '<pre>';print_r($result->getSourceMedium());echo '</pre>';
 
$sourcemedium .= '{  label: "'.$result->getSource().'['.$result->getVisits().']",data: '.$result->getVisits().' },';
 $smii++;
}

$fml = date('Y-m-d', strtotime("-4 months"));
$ga->requestReportData(ga_profile_id,array('userType'),array('visits'),'','');

 
$gaResults = $ga->getResults();

$sut=0;
$userType ='';
foreach($ga->getResults() as $result)
{
 
 
$userType.= '{  label: "'.$result->getUserType().'",data: '.$result->getVisits().' },';
 $sut++;
}

 
//$ga->requestReportData(ga_profile_id,array('keyword'),array('visits'),'-visits', ('ga:keyword!~(not set)'));
$ga->requestReportData(ga_profile_id,array('keyword'),array('visits'),'','',$fml);
 
$gaResults = $ga->getResults();
 
$gkey=0;
$gkeyword ='';
foreach($ga->getResults() as $result)
{
 
if($result->getKeyword()!='(not provided)') 
 $gkeyword.= '{  label: "'.$result->getKeyword().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
 $gkey++;
}

//$ga->requestReportData(ga_profile_id,array('socialNetwork'),array('visits'),'-visits','ga:socialNetwork!~(not set)');
$ga->requestReportData(ga_profile_id,array('socialNetwork'),array('visits'),'','',$fml);
 
$gaResults = $ga->getResults();
 
$scalt=0;
$socialtr ='';
foreach($ga->getResults() as $result)
{
 
 
$socialtr.= '{  label: "'.$result->getSocialNetwork().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
 $scalt++;
}

$ga->requestReportData(ga_profile_id,array('deviceCategory'),array('visits'),'-visits','ga:deviceCategory!~(not set)');
$gaResults = $ga->getResults();

$dev=0;
$device ='';
foreach($ga->getResults() as $result)
{
	$device.= '{  label: "'.$result->getDeviceCategory().'",data: '.$result->getVisits().' },';
    $dev++;
}

$fml = date('Y-m-d', strtotime("1 month ago"));
$ga->requestReportData(ga_profile_id,array('mobileDeviceInfo'),array('visits'),'-visits','ga:mobileDeviceInfo!~(not set)');
$gaResults = $ga->getResults();
$mdv=0;
$mobdiv ='';
foreach($ga->getResults() as $result)
{
    $mobdiv.= '{  label: "'.$result->getMobileDeviceInfo().' ['.$result->getVisits().']",data: '.$result->getVisits().' },';
    $mdv++;
}

?>
