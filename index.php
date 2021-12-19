<html>
<head>
 <title>NORTHPOLE MAINFRAME WEBUI 0.404a</title>
</head>
<body>

<!-- ====================================================== -->
<!-- Mainframe code available at: https://github.com/jclement/northpole-mainframe/ -->
<!-- Security, through open source code. -->
<!-- ====================================================== -->

<?php
$db = new mysqli("localhost", "web", "uWoothi8$", "mainframe"); //TODO: Move this into configuration somewhere else
session_start();

if ($_POST["action"] == "login") {
        $hashed_pw = md5($_POST["password"]);
        $name = $_POST["name"];
        $res = $db->query("select * from users where name='$name' and hashed_password='$hashed_pw'");
        if ($res->num_rows > 0) {
                $_SESSION["authorized"] = 1;
        } else {
                echo "<blink><font color=\"red\" size=6>UNAUTHORIZED</font></blink>";
        }
}

?>

<h1>MAINFRAME ACCESS</h1>

<?php
if ($_SESSION["authorized"]) {
?>
<h2>Transactions...</h2>
<form action="/" method="post">
 <table>
  <tr><th>Search:</th><td><input type="text" name="search" /></td></tr>
  <tr><th></th><td><input type="submit" value="search!" /></td></tr>
 </table>
</form>

<?php
$search = $_POST["search"];
system("/opt/mainframe/search \"$search\"");
?>

<?php } else { ?>
<p>Unauthorized access will have you added to the <b>naughty list</b>.</p>
<form action="/" method="post">
 <input type="hidden" name="action" value="login" />
 <table>
  <tr><th>Name:</th><td><input type="text" name="name" /></td></tr>
  <tr><th>Password:</th><td><input type="password" name="password" /></td></tr>
  <tr><th></th><td><input type="submit" value="login" /></td></tr>
 </table>
</form>
<?php } ?>

</body>
</html>
