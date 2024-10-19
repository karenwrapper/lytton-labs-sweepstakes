<?php

$str = isset($_GET['codeA']) ? $_GET['codeA'] : '';
$b = isset($_GET['codeB']) ? $_GET['codeB'] : '';

if ($str == '' || $b == '')
{
echo "<H1>GOLDEN TICKET Checker API</H1>\n";
echo "<br/>\n";
echo "<br/>\n";
echo "There is a secret code on the web server.  On the back of your cereal box<br/>\n";
echo "there are two codes.  You submit these two codes the web server, and it<br/>\n";
echo "will tell you if you win a GOLDEN TICKET, which gives you a<br/>\n";
echo "lifetime supply of psychotropic drugs, AND a free tour of the new Lytton Labs Academy<br/>\n";
echo "that was completed just last year!  [WARNING: There is NO WAY to cheat on this<br/>\n";
echo "contest, but in the event you figure out how to do it, you will NOT get the tour!!!]<br/>\n";
echo "<br/>\n";
echo "Submit the codes to the following URL as shown below...<br/>\n";
echo "<br/>\n";
//echo "https://goldenticket.lyttonlabs.org/goldenticketcheck.php?codeA=[CODEA]&codeB=[CODEB]<br/>\n";
echo "https://sweepstakes.lyttonlabs.org/lytton-labs-sweepstakes/goldenticketcheck.php?codeA=[CODEA]&codeB=[CODEB]<br/>\n";
exit();
}
else
{
$secretFile = '/var/www/secret.txt';
$secretContents = trim(file_get_contents($secretFile));

// Ensure the file was read successfully
if ($secretContents === false) {
    die("Error reading the secret file.\n");
}

$str .= $secretContents;
$a = md5($str);
// String must be 32 hex digits, and the hex hash of the string concatenated
// with the secret must start with a number...
if (!(preg_match('/^[0-9a-fA-F]{32}/',$str)) || !(preg_match('/[0-9a-fA-F]{32}/', $b)) || preg_match('/^[a-fA-f]/', $a))
{
    print "Sorry, Charlie... no GOLDEN TICKET for YOU!!! :( <br/>";
    exit();
}
//print "\$a = $a<br/>\n";
$b = hexdec($_GET['codeB']);
//print "\$b = $b<br/>\n";

if ($a == $b)
{
    $goldenTicketFile = '/var/www/goldenticket.txt';
    $goldenTicketFileContents = trim(file_get_contents($goldenTicketFile));
    print "<H1>YOU WIN!!!!</H1><br/>\n";
    print "<img src='charlie.jpeg'/><br/>\n";
    print "Matched Hash == $a<br/>\n";
    print "I got a GOLDEN TICKET... NAH NAH NAH NAH NAH NUH NAH NAH!!!</br>\n";
    print "<pre>$goldenTicketFileContents</pre><br/>";
}
else
{
    print "Sorry, Charlie... no GOLDEN TICKET for YOU!!! :( Better luck next time!<br/>";
}
}
?>
