<?php

include('info.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>


<html>
<head>
       <title>CIS 451 Final Project</title>
</head>

<body bgcolor="white">

<h1>Super Smash Bros. Melee Top 10 Power Ranking</h1>

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Smash_Ball.png/200px-Smash_Ball.png">

<hr>


<h3>
Search for Players by category
<h3>


<form action="search.php" method="POST">

<input type = "radio" name = "category" value = "tag" checked>Tag<br>
<input type = "radio" name = "category" value = "character">Character<br>
<input type = "radio" name = "category" value = "location">Location<br>
<input type="text" name="name"> <br>
<input type="submit" value="submit">
<input type="reset" value="erase">
</form>

<hr>
<h2>
Summer/Fall 2017 Rankings
</h2>

<table>
<thead>
        <tr>
                <td><h4>Rank</h4></td>
                <td><h4>Tag</h4></td>
                <td><h4>Rank 2016</h4></td>
                <td><h4>Movement</h4></td>
                <td><h4>Score</h4></td>
        </tr>
</thead>
<tbody>
<?php
$query = "select rank,tag,rank_2016,movement,score from ranking order by rank";

$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
?>
        <tr>
                <td><?php echo $row['rank']?> </td>
                <td><?php echo $row['tag']?></td>
                <td><?php echo $row['rank_2016']?></td>
                <td><?php echo $row['movement']?></td>
                <td><?php echo $row['score']?></td>
        </tr>
<?php
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</tbody>
</table>

<hr>
<h3>View Placings and Notable Wins</h3>
<form action = "results_wins.php" method = "POST">
<input type = "submit" value ="View">
</form>

<hr>
<h3>
View Player Profiles
</h3>

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

</body>
</html>