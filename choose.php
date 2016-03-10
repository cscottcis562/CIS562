<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<form action="Standings.php" method="post">
  <label for="select">Select Division:</label>
<select name="Division" id="Division">
  <option value="5">B10</option>
  <option value="6">B12</option>
  <option value="7">B14</option>
  <option value="8">B16</option>
  <option value="9">B19</option>
  <option value="13">G10</option>
  <option value="14">G12</option>
  <option value="15">G14</option>
  <option value="16">G16</option>
  <option value="17">G19</option>
</select> 
<input name="submit" type="submit" id="submit" formaction="Standings.php" formmethod="POST" value="Submit">
</form>

<a href="Standings.php?Division=6">view</a>
</body>
</html>