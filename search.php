<?php

include('info.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Melee</title>
  </head>

  <body bgcolor="white">


  <hr>

<?php

$entry = $_POST['name'];
$category = $_POST['category'];

$entry = mysqli_real_escape_string($conn, $entry);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

if ($category == 'tag'){
                $query = "SELECT * from player where tag =";
                $query = $query."'".$entry."'";
} elseif ($category == 'character'){
                $query = "SELECT p.tag, p.fname, p.lname, p.region
                                        FROM player p JOIN characters c USING (tag) where c.main =";
                $query = $query."'".$entry."' OR c.secondary =";
                $query = $query."'".$entry."' GROUP BY tag;";
} else if ($category == 'location'){
                $query = "SELECT p.tag, p.fname, p.lname, p.region
                                        FROM player p JOIN region r USING (tag) where r.region_key =";
                $query = $query."'".$entry."' OR r.city =";
                $query = $query."'".$entry."' OR r.country =";
                $query = $query."'".$entry."' GROUP BY tag;";
}
?>
<p>
<h3>You Searched:</h3>
<p>
<?php
print $entry;
?>
<p>
<h3>Category:</h3>
<p>
<?php
print $category;
?>

<hr>
<p>
<h3>Results:</h3>
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[tag]    $row[fname] $row[lname]    $row[region]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>
<p>
<h4>Player Profiles</h5>
<form action = "profile.php" method = "POST">
<input type ="submit" name = "profile" value ="Armada">
<input type ="submit" name = "profile" value ="Hungrybox">
<input type ="submit" name = "profile" value ="Mango">
<input type ="submit" name = "profile" value ="Mew2king">
<input type ="submit" name = "profile" value ="Leffen">
<input type ="submit" name = "profile" value ="Plup">
<input type ="submit" name = "profile" value ="Chudat">
<input type ="submit" name = "profile" value ="SFAT">
<input type ="submit" name = "profile" value ="Axe">
<input type ="submit" name = "profile" value ="Wizzrobe">
</form>
<p>
<hr>
<form action = "main.php" method = "POST">
<input type = "submit" value = "Home">
</form>

</body>
</html>