<?php

include('info.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Placings and Wins</title>
  </head>

  <body bgcolor="white">

  <h1>Placings and Notable Wins</h1>

  <hr>

<form action="results_wins.php" method="POST">

<input type = "radio" name = "tag" value = "Armada" checked>Armada<br>
<input type = "radio" name = "tag" value = "Hungrybox">Hungrybox<br>
<input type = "radio" name = "tag" value = "Mango">Mango<br>
<input type = "radio" name = "tag" value = "Mew2king">Mew2king<br>
<input type = "radio" name = "tag" value = "Leffen">Leffen<br>
<input type = "radio" name = "tag" value = "Plup">Plup<br>
<input type = "radio" name = "tag" value = "Chudat">Chudat<br>
<input type = "radio" name = "tag" value = "SFAT">SFAT<br>
<input type = "radio" name = "tag" value = "Axe">Axe<br>
<input type = "radio" name = "tag" value = "Wizzrobe">Wizzrobe<br>
<input type="submit" value="Show">
</form>

<p>
<hr>
<?php
$tag = $_POST['tag'];
echo "<h2>Showing data for: $tag</h2>"
?>
<?php
$place_query = "Select tournament, place from results where tag =";
$place_query = $place_query."'".$tag."'";
?>
<?php
$win_query = "SELECT defeated, tournament, year from wins where tag =";
$win_query = $win_query."'".$tag."'";
?>

<h3>2017 Placings:</h3>
<table>
<thead>
        <tr>
                <td><h4>Tournament</h4></td>
                <td><h4>Place</h4></td>
        </tr>
</thead>
<tbody>
<?php

$result = mysqli_query($conn, $place_query)
or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
?>
        <tr>
                <td><?php echo $row['tournament']?> </td>
                <td><?php echo $row['place']?></td>
        </tr>
<?php
}
mysqli_free_result($result);
?>
</tbody>
</table>

<h3>Notable Wins:</h3>
<table>
<thead>
        <tr>
                <td><h4>Defeated</h4></td>
                <td><h4>Tournament</h4></td>
                                <td><h4>Year</h4></td>
        </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($conn, $win_query)
or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
?>
        <tr>
                <td><?php echo $row['defeated']?> </td>
                                <td><?php echo $row['tournament']?> </td>
                <td><?php echo $row['year']?></td>
        </tr>
<?php
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</tbody>
</table>

<p>
<hr>
<h3>Player Profiles</h3>
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
<form action ="main.php" method ="POST">
<input type = "submit" value = "Home">
</form>
</body>
</html>