<?php


if ($_COOKIE["heroes"] == "voted") {
 echo "<html><head><META HTTP-EQUIV=refresh CONTENT=2;URL=http://torontoist.com/></head><body>";
 echo "<center><h1><font face=arial>Sorry, you can only vote once for your heroes.</font></h1><br><img src=http://torontoist.com/wp-content/uploads/2011/12/superhero2011headershort.jpg>";
}
else {
 //setcookie("heroes", "voted", time()+3600*24*30);
 $info = $_POST['ballotOrder'];
 $writein = $_POST['nomination']."\n";
 parse_str($info);
 $ballots = fopen('http://www.livelythought.com/heroes-ballots.csv', 'a');
 fputcsv($ballots, $sortcontainer);
 fclose($ballots);
 //$nominations = fopen('http://www.torontoist.com/wp-content/themes/torontoist_theme20112/heroes-nominations.txt.php', 'a');
 //fwrite($nominations, $writein);
 //fclose($nominations);
 echo "<html><head><META HTTP-EQUIV=refresh CONTENT=2;URL=http://torontoist.com/></head><body>";
 echo "<center><h1><font face=arial>Thanks for voting!</font></h1><br><img src=http://torontoist.com/wp-content/uploads/2011/12/superhero2011headershort.jpg>";
}


?>