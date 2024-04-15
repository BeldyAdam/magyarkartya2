<?php 
include_once 'Adatbazis.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stilus.css">
    <title>Makkosék</title>
</head>
<body>
<?php
        $adatbazis = new Adatbazis();

        $eredmeny = $adatbazis->adatLeker("kep", "szin");
        $adatbazis->megjelenit($eredmeny);
        #$szam = $adatbazis->rekordokSzama("szin");
        #echo "A tabla rekordjainak száma: $szam";
        if ($adatbazis->rekordokSzama("kartya")==0){
            $adatbazis->kartyaFeltolt("kartya");
        }
        $eredmeny2 = $adatbazis->adatLeker2("nev", "kep", "szin");
        $adatbazis->megjelenitTabla($eredmeny2);
        $adatbazis->modosit("nev", "szin", "zold", "zöld");
        $adatbazis->kapcsolatBezar();
        ?>
</body>
</html>