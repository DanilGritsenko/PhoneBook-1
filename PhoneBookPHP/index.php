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

function searchBySurname($query){
    global $computers;
    $result = array();
    foreach ($computers -> kontakt as $computer){
        if (substr(strtolower($computer -> perekonnanimi), 0, strlen($query))==strtolower($query))
            array_push($result, $computer);
    }
    return $result;
}

function searchByEmail($query){
    global $computers;
    $result = array();
    foreach ($computers -> kontakt as $computer){
        if (substr(strtolower($computer -> email), 0, strlen($query))==strtolower($query))
            array_push($result, $computer);
    }
    return $result;
}

$computer = array();
foreach($computers->kontakt as $item) {
    $computer[] = array(
                     'id'             => (string)$item->id,
                     'name'          => (string)$item->name,
                     'surname'           => (string)$item->surname,
                     'number'         => (string)$item->number,
                     'email' => (string)$item->email
                    );
}
array_sort_by_column($computer, 'Name');
var_dump($computer);

function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    array_multisort($reference_array, $direction, $array);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Telefoniraamat</title>
        <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="skeleton.css">
    </head>
    <body>
	<input type="submit" name="sort" value="Sort" onClick="array_sort_by_column">
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
		
        <form method="post">
            Search: <input type="text" name="search"/>
			Otsing nimi järgi<input type="radio" name="radiofind"  value="name" checked>
			Otsing perekonnanimi järgi<input type="radio" name="radiofind"  value="surname">
			Otsing telefoni numbri järgi<input type="radio" name="radiofind" value="num">
			Otsing emaili järgi<input type="radio" name="radiofind" value="email">
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
				else if($answer == "surname"){
					$result = searchBySurname($_POST["search"]);
				}
				else if($answer == "email"){
					$result = searchByEmail($_POST["search"]);
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
		
		<h2>Esimene nimi XML failis</h2>
		<?php
			echo "<h4>".$computers -> kontakt -> nimi[0]."</h4>";
		?>
		

    </body>
</html>