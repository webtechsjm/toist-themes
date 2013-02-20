<?php


if ($_COOKIE["villains"] == "voted") {
 echo "<html><head><META HTTP-EQUIV=refresh CONTENT=2;URL=http://torontoist.com/></head><body>";
 echo "<center><h1><font face=arial>Sorry, you can only vote for villains once.</font></h1><br><img src=http://torontoist.com/wp-content/uploads/2011/12/2011supervillainheader.jpg>";
 }
else {
 setcookie("villains", "voted", time()+3600*24*30);
 $info = $_POST['ballotOrder'];
 $writein = $_POST['nomination']."\n";
 parse_str($info);
 $ballots = fopen('villains-ballots.csv', 'a');
 fputcsv($ballots, $sortcontainer);
 fclose($ballots);
 $nominations = fopen('villains-nominations.txt', 'a');
 fwrite($nominations, $writein);
 fclose($nominations);
 echo "<html><head><META HTTP-EQUIV=refresh CONTENT=2;URL=http://torontoist.com/></head><body>";
 echo "<center><h1><font face=arial>Thanks for voting!</font></h1><br><img src=http://torontoist.com/wp-content/uploads/2011/12/2011supervillainheader.jpg>";
}


?>