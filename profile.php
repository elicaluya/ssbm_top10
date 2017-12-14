<?php

include('info.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Profile</title>
  </head>

  <body bgcolor="white">


  <hr>
<?php

$tag = $_POST['profile'];

$tag = mysqli_real_escape_string($conn, $tag);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$basic_query = "select p.fname, p.lname, r.city, r.region_key, r.country
                from player p JOIN region r using (tag) where tag = ";
$basic_query = $basic_query."'".$tag."'";
?>
<?php
$social_query = "select so.twitch, so.twitter, group_concat(sp.sponsor_name) as spons
from sponsor sp JOIN social so using (tag)
where tag = ";
$social_query = $social_query."'".$tag."'";
?>
<?php
$char_query = "SELECT group_concat(DISTINCT main) as Main,
                                group_concat(DISTINCT secondary) as Secondary
                                from characters where tag = ";
$char_query = $char_query."'".$tag."'";
?>
<?php
$tourn_query = "select first_tourney, year from extras where tag = ";
$tourn_query = $tourn_query."'".$tag."'";
?>
<?php
$combo_query = "select combo_link from extras where tag =";
$combo_query = $combo_query."'".$tag."'";
?>
<?php
$photo_query = "select photo from player where tag = ";
$photo_query = $photo_query."'".$tag."'";
?>


<?php
$basic_result = mysqli_query($conn, $basic_query)
or die(mysqli_error($conn));

$social_result = mysqli_query($conn, $social_query)
or die(mysqli_error($conn));

$char_result = mysqli_query($conn, $char_query)
or die(mysqli_error($conn));

$tourn_result = mysqli_query($conn, $tourn_query)
or die(mysqli_error($conn));

$combo_result = mysqli_query($conn, $combo_query)
or die(mysqli_error($conn));

$photo_result = mysqli_query($conn, $photo_query)
or die(mysqli_error($conn));

print "<pre>";
echo "<h1>$tag</h1>";

while($info = mysqli_fetch_array($photo_result, MYSQLI_BOTH))
  {
    echo "\n";
    print "<img src='".$info['photo']."'/>";
  }

while($row = mysqli_fetch_array($basic_result, MYSQLI_BOTH))
  {
    echo "\n";
    echo "\n";
    echo "<h3>Basic Info</h3>";
    print "Name: $row[fname] $row[lname]           Region: $row[city], $row[region_key] $row[country]";
  }

while($row = mysqli_fetch_array($social_result, MYSQLI_BOTH))
  {
    echo "\n";
    echo "\n";
    echo "<h3>Social Media and Sponsor</h3>";
    print "Twitch: $row[twitch]     Twitter: $row[twitter]      Sponsor: $row[spons]";
  }

while($row = mysqli_fetch_array($char_result, MYSQLI_BOTH))
  {
    echo "\n";
    echo "\n";
    echo "<h3>Characters</h3>";
    print "Main: $row[Main]     Secondary: $row[Secondary]";
  }

while($row = mysqli_fetch_array($tourn_result, MYSQLI_BOTH))
  {
    echo "\n";
    echo "\n";
    echo "<h3>First Tournament</h3>";
    print "$row[first_tourney]  $row[year]";
  }

while($info = mysqli_fetch_array($combo_result, MYSQLI_BOTH))
  {
    echo "\n";
    echo "\n";
    echo "<h3>Combo Video</h3>";
    print '<a href="'.$info['combo_link'].'"target="_blank">'.$info['combo_link'].'</a>';
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>
<h3>View Placings and Notable Wins</h3>
<form action = "results_wins.php" method ="POST">
<input type = "submit" name = "tag" value ='<?php echo "$tag";?>'>
</form>
<p>
<hr>

<p>
<form action = "main.php" method = "POST">
<input type = "submit" value = "Home">
</body>
</html>