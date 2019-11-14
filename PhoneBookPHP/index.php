<?php
$computers = simplexml_load_file("kniga.xml");
$counter = 0;
$date_today = date("m.d.y");
echo $computers -> kontakt[0] -> attributes() -> id;

function searchByName($query){
    global $computers;
    $result = array();
    foreach ($computers -> kontakt as $computer){
        if (substr(strtolower($computer -> nimi), 0, strlen($query))==strtolower($query))
            array_push($result, $computer);
    }
    return $result;
}
function searchByNumber($query){
    global $computers;
    $result = array();
    foreach ($computers -> kontakt as $computer){
        if (substr(strtolower($computer -> telefon), 0, strlen($query))==strtolower($query))
            array_push($result, $computer);
    }
    return $result;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>XML Reading</title>
        <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="skeleton.css">
    </head>
    <body>
        <h1>Telefoniraamat</h1>
       
        <table border="1">
            <tr>
                <th>Nimi</th>
                <th>Perenimi</th>
                <th>Telefon</th>
				<th>E-mail</th>
				
            </tr>
            <?php
          
            foreach($computers -> kontakt as $arvuti) {
                echo "<tr>";
                echo "<td>".($arvuti -> nimi)."</td>";
                echo "<td>".($arvuti -> perekonnanimi)."</td>";
                echo "<td>".($arvuti -> telefon)."</td>";
				echo "<td>".($arvuti -> email)."</td>";
				
                echo "</tr>";
                }
            
            ?>
        </table>

        

        <br />
        <form action="?" method="post">
            Search: <input type="text" name="search"/>
			Otsing nimi jargi<input type="radio" name="radiofind"  value="name" checked>
			Otsing telefoni numbri jargi<input type="radio" name="radiofind"  value="num">
            <input type="submit" value="Find" />
        </form>
        <table border="1">
         <tr>
                <th>Nimi</th>
                <th>Perenimi</th>
                <th>Telefon</th>
				<th>E-mail</th>
				
            </tr>
            <?php
            
			if(!empty($_POST["search"])){
				$answer = $_POST['radiofind'];
				if ($answer == "name"){
					$result = searchByName($_POST["search"]);
				}
				else if($answer == "num"){
					$result = searchByNumber($_POST["search"]);
				}
			
            foreach($result as $arvuti) {
				$counter++;
                echo "<tr>";
                echo "<td>".($arvuti -> nimi)."</td>";
                echo "<td>".($arvuti -> perekonnanimi)."</td>";
                echo "<td>".($arvuti -> telefon)."</td>";
				echo "<td>".($arvuti -> email)."</td>";
				
                echo "</tr>";
                }
				echo "Leitud ".($counter)." kontakti";
            }
			
            ?>
        </table>
		

    </body>
</html>