<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<style type="text/css">
	body, td, tr {color: #bbb; font: 15px "Helvetica Neue",Helvetica,Arial,sans-serif; line-height: 1.625;}
	#section-vocab-list {width: 584px; margin: 0 auto;}
	.wp {margin: 1em auto; max-width: 1000px; background: #0f0f0f; padding: 2em 0 2em 0;}
	a {color: #2dabe0; text-decoration: none;}
</style>
<title>Word List Generator</title>
</head>
<body style="background-color: #191b1c;">
<div class="wp">
<div id="section-vocab-list">
<?php
// Code written by Tìtstewan - https://forum.learnnavi.org/profile/?area=summary;u=10322 March 12, 2016
// Use this tool wisely! This code is supposed to be used offline.
// Why this code exist? I've created this PHP script to generate a Na'vi vocab list one can see on the Vocab section of the LN homepage.
// One can use this to generate an offline dictionary in a browser. To run ths code, one need PHP 5.5 (it could work in lower PHP versions) and MySQLi 5.0 environment.
##################### DATABASE INFO #####################
// One will have to enter some info to let this script access the database.
$db_name = ''; # this should be the database name
$db_loca = ''; # usually, your computer
$db_pass = ''; # database password, if you have set up one
$db_user = ''; # database username, default is "root"
// Following are for choosing the right tables and columns in the DB
$db_metawo = ''; # this is the table where the Na'vi words, IPA, part of speech are stored
$db_localw = ''; # this is the table where the translated words are
$db_langco = ''; # obviously, the language code column
$db_lnnavi = ''; # Na'vi word column
// Select your language. Following are available (according the EE's NaviData.sql)
// eng, de, pl, est, hu, sv, nl and ru (ru = russian will show no words only ???, so don't use it)
$lang = "'eng'";
// One html to rule them all!
$dblock = '<p style="margin: 2em 0 1em 0; text-align: center;"><span style="font-size: 1.2em;">';
$vblock = '</span></p><div style="width: 100%; padding-left: 0.7em; -moz-column-count: 2; -webkit-column-count: 2; column-count: 2; -moz-column-width: 49%; -webkit-column-width: 49%; column-width: 49%; -moz-column-gap: 2em; -webkit-column-gap: 2em; column-gap: 2em;">';
// So, all necessary things are done now...
// ...let's connect to the db!
$db_link = mysqli_connect($db_loca ,$db_user ,$db_pass ,$db_name);
// check if the connection has been etablished
if (mysqli_connect_errno())
{
	echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
	exit();
}
// Change character set to utf8, just in case
mysqli_set_charset($db_link, 'utf8');
##################### LOADING THE STUFF #####################
// load the words, IPA, part of speech and the translation
$sql = '
	SELECT * FROM ' . $db_metawo . '
	LEFT JOIN ' . $db_localw . ' ON (' . $db_metawo . '.id = ' . $db_localw . '.id)
		AND ' . $db_localw . '.' . $db_langco . ' = ' . $lang . '
	ORDER BY ' . $db_lnnavi . ' ASC ';
// Putting the result into one variable and execute the query
$db_erg = mysqli_query($db_link, $sql);
// Check if the query works correct
if (!$db_erg) {
	die('Invalid query: ' . mysqli_error($db_link));
}
// Let's roll
while ($data = mysqli_fetch_array($db_erg, MYSQLI_ASSOC))
{
	$vocab[] = $data;
}
// Creating a function just to make stuff easier
function ayliu()
{
	global $data2;
	// stuff to echo with the power to just edit this line for more stuff!
	echo '<span style="font-weight: bold; margin-left: -0.7em;">', $data2['navi'], '</span> [', $data2['ipa'] ,'] <em>', $data2['partOfSpeech'],'</em> ', $data2['localized'], '<br />';
}
##################### THE GENERATOR #####################
// tìftang!
// Vocab block title
echo $dblock, '’ [ʔ] (<em>tìftang, Apostrophe, Glottal Stop</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == '\'')
		ayliu();
}
// just to close the <div>
echo '</div>';
// a!
// Vocab block title
echo $dblock, 'A [a]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'a' || substr($data2['navi'], 0, 1) == 'A')
		ayliu();
}
// just to close the <div>
echo '</div>';
// ä!
// Vocab block title
echo $dblock, 'Ä [æ]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'ä' || substr($data2['navi'], 0, 2) == 'Ä')
		ayliu();
}
// just to close the <div>
echo '</div>';
// e!
// Vocab block title
echo $dblock, 'E [ɛ]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'e' || substr($data2['navi'], 0, 1) == 'E')
		ayliu();
}
// just to close the <div>
echo '</div>';
// f!
// Vocab block title
echo $dblock, 'F [f] (<em>Fä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'f' || substr($data2['navi'], 0, 1) == 'F')
		ayliu();
}
// just to close the <div>
echo '</div>';
// h!
// Vocab block title
echo $dblock, 'H [h] (<em>Hä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'h' || substr($data2['navi'], 0, 1) == 'H')
		ayliu();
}
// just to close the <div>
echo '</div>';
// i!
// Vocab block title
echo $dblock, 'I [i]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'i' || substr($data2['navi'], 0, 1) == 'I' || substr($data2['navi'], 0, 1) == 'j' || substr($data2['navi'], 0, 1) == 'J')
		ayliu();
}
// just to close the <div>
echo '</div>';
// ì!
// Vocab block title
echo $dblock, 'Ì [ɪ]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'ì' || substr($data2['navi'], 0, 2) == 'Ì')
		ayliu();
}
// just to close the <div>
echo '</div>';
// k!
// Vocab block title
echo $dblock, 'K [k] (<em>KeK</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'k' && substr($data2['navi'], 0, 2) != 'kx' || substr($data2['navi'], 0, 1) == 'K' && substr($data2['navi'], 0, 2) != 'Kx')
		ayliu();
}
// just to close the <div>
echo '</div>';
// kx!
// Vocab block title
echo $dblock, 'KX [k’] (<em>KxeKx</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'kx' || substr($data2['navi'], 0, 2) == 'Kx')
		ayliu();
}
// just to close the <div>
echo '</div>';
// l!
// Vocab block title
echo $dblock, 'L [l] (<em>LeL</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'l' || substr($data2['navi'], 0, 1) == 'L')
		ayliu();
}
// just to close the <div>
echo '</div>';
// m!
// Vocab block title
echo $dblock, 'M [m] (<em>MeM</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'm' || substr($data2['navi'], 0, 1) == 'M')
		ayliu();
}
// just to close the <div>
echo '</div>';
// n!
// Vocab block title
echo $dblock, 'N [n] (<em>NeN</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'n' && substr($data2['navi'], 0, 2) != 'ng' || substr($data2['navi'], 0, 1) == 'N' && substr($data2['navi'], 0, 2) != 'Ng')
		ayliu();
}
// just to close the <div>
echo '</div>';
// ng!
// Vocab block title
echo $dblock, 'NG [ŋ] (<em>NgeNg</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'ng' || substr($data2['navi'], 0, 2) == 'Ng')
		ayliu();
}
// just to close the <div>
echo '</div>';
// o!
// Vocab block title
echo $dblock, 'O [o]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'o' || substr($data2['navi'], 0, 1) == 'O')
		ayliu();
}
// just to close the <div>
echo '</div>';
// p!
// Vocab block title
echo $dblock, 'P [p] (<em>PeP</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'p' && substr($data2['navi'], 0, 2) != 'px' || substr($data2['navi'], 0, 1) == 'P' && substr($data2['navi'], 0, 2) != 'Px')
		ayliu();
}
// just to close the <div>
echo '</div>';
// px!
// Vocab block title
echo $dblock, 'PX [p’] (<em>PxePx</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'px' || substr($data2['navi'], 0, 2) == 'Px')
		ayliu();
}
// just to close the <div>
echo '</div>';
// r!
// Vocab block title
echo $dblock, 'R [ɾ] (<em>ReR</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'r' || substr($data2['navi'], 0, 1) == 'R')
		ayliu();
}
// just to close the <div>
echo '</div>';
// s!
// Vocab block title
echo $dblock, 'S [s] (<em>Sä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 's' || substr($data2['navi'], 0, 1) == 'S')
		ayliu();
}
// just to close the <div>
echo '</div>';
// t!
// Vocab block title
echo $dblock, 'T [t] (<em>TeT</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 't' && substr($data2['navi'], 0, 2) != 'tx' && substr($data2['navi'], 0, 2) != 'ts' || substr($data2['navi'], 0, 1) == 'T' && substr($data2['navi'], 0, 2) != 'Tx' && substr($data2['navi'], 0, 2) != 'Ts')
		ayliu();
}
// just to close the <div>
echo '</div>';
// ts!
// Vocab block title
echo $dblock, 'TS [t͡s] (<em>Tsä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'ts' && substr($data2['navi'], 0, 2) != 'tx' || substr($data2['navi'], 0, 2) == 'Ts' && substr($data2['navi'], 0, 2) != 'Tx')
		ayliu();
}
// just to close the <div>
echo '</div>';
// tx!
// Vocab block title
echo $dblock, 'TX [t’] (<em>TxeTx</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 2) == 'tx' && substr($data2['navi'], 0, 2) != 'ts' || substr($data2['navi'], 0, 2) == 'Tx' && substr($data2['navi'], 0, 2) != 'Ts')
		ayliu();
}
// just to close the <div>
echo '</div>';
// u!
// Vocab block title
echo $dblock, 'U [u|ʊ]', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'u' || substr($data2['navi'], 0, 1) == 'U')
		ayliu();
}
// just to close the <div>
echo '</div>';
// v!
// Vocab block title
echo $dblock, 'V [v] (<em>Vä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'v' || substr($data2['navi'], 0, 1) == 'V')
		ayliu();
}
// just to close the <div>
echo '</div>';
// w!
// Vocab block title
echo $dblock, 'W [w] (<em>Wä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'w' || substr($data2['navi'], 0, 1) == 'W')
		ayliu();
}
// just to close the <div>
echo '</div>';
// y!
// Vocab block title
echo $dblock, 'Y [j] (<em>Yä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'y' || substr($data2['navi'], 0, 1) == 'Y')
		ayliu();
}
// just to close the <div>
echo '</div>';
// z!
// Vocab block title
echo $dblock, 'Z [z] (<em>Zä</em>)', $vblock;
// the thing that reads the stuff from the db
foreach ($vocab as $data2)
{
	if (substr($data2['navi'], 0, 1) == 'z' || substr($data2['navi'], 0, 1) == 'Z')
		ayliu();
}
// just to close the <div>
echo '</div>';
// Let's become free!
mysqli_free_result($db_erg);
// done
mysqli_close($db_link);
?>
</div>
</div>
</body>
</html>
