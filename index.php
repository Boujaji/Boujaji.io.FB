<html>
<head>
<title>My friends book</title>
<style>

/* Style the header */
header {
    background-color: #666;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}

/*Style the footer*/ 
footer {
    background-color: #777;
    padding: 10px;
    text-align: center;
    color: white;
}
</style>
</head>
<body>
<?php
include('head.html');
?>
<br>
<form action="index.php" method="post">
Name: <input type="text" name="name">
<input type="submit" value="Add new friend">
</form>

<h1>My best friends:</h1>

<?php

$filename = 'friends.txt';
$nameFilter="";
if (isset($_POST['nameFilter'])) {
    $nameFilter = $_POST['nameFilter'];
} 

echo "<ul>";

$file = fopen( $filename, "r" );
 //-
if( $file != false ) {
    while (!feof($file)) {
        $name = fgets($file); //-
        if ($nameFilter=="" || strpos($name, $nameFilter)!==FALSE) {
	    if (strlen($name)>0) {
            	echo "<li>$name <button type='submit' name='delete' value='$i'>Delete</button> </li>";
		
	    }
        }
    }
    fclose( $file );
}

 //*
if (isset($_POST['name']) && strlen($_POST['name'])>0) {
    $newFriendName = $_POST['name'];//* 

    $file = fopen( $filename, "a+" );
    if( $file != false ) { 
        echo "<li><b>$newFriendName</b></li>";
        fwrite( $file, "$newFriendName\n" );
        fclose( $file );
    }
}

if (isset($_POST['delete'])) {
        $indexToBeRemoved = $_POST['delete'];
        unset($friendsArray[$indexToBeRemoved]);
        $friendsArray = array_values($friendsArray);
    }


?>

<form action="index.php" method="post">
<input type="text" name="nameFilter" value="<?=$nameFilter?>">
<input type="checkbox" name="startingWith" <?php if ($startingWith=='TRUE') echo "checked"?> value="TRUE"> Only names starting with</input>
<input type="submit" value="Filter list">
</form>

<?php
echo "</ul>";
include('foot.html');
?>

</body>
</html>

