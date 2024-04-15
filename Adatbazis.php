<?php
class Adatbazis{
    private $host = "localhost";
    private $felhasznalonev = "root";
    private $jelszo = "";
    private $adatbazis = "magyarkartya";
    private $kapcsolat;

    public function __construct()

    {
        $this->kapcsolat=new mysqli(
            $this->host,
            $this->felhasznalonev,
            $this->jelszo,
            $this->adatbazis
        );
        $szoveg=0;
        if ($this->kapcsolat->connect_errno)
            $szoveg="Sikertelen kapcsolódás";
        else
            $szoveg="Sikeres kapcsolódás";
        echo $szoveg;

        $this->kapcsolat->query("SET NAMES UTF8");
        
    }
    public function kapcsolatBezar(){
        $this->kapcsolat->close();
    }
    public function adatLeker($oszlop, $tabla){
        $sql = "SELECT $oszlop FROM $tabla";
        return $this->kapcsolat->query($sql);
    }

    public function adatLeker2($oszlop1, $oszlop2, $tabla){
        $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
        return $this->kapcsolat->query($sql);
    }
    public function megjelenit($matrix){
        echo "<div style='text-align: center;'>";
        while ($row = $matrix->fetch_row()){
            echo "<img src=\"forras/$row[0]\" alt=\"$row[0]\">";
        }
        echo "</div>";
    }

    public function megjelenitTabla($matrix){
        echo "<table style='border: 1px solid white; color:white; margin: auto; width: 700px; text-align: center; background-color: rgba(4, 170, 109, 0.7);'>
        <tr style='border: 1px solid white;'>
            <th style='border: 1px solid white;'>Név</th>
            <th style='border: 1px solid white;'>Kép</th>
        </tr>";
        while($row = $matrix->fetch_row()){
            echo "<tr>";
            echo "<td style='border: 1px solid white;'>" .$row[0].  "</td>";
            echo "<td style='border: 1px solid white;'><img style='max-width:100px;' src=\"forras/$row[1]\" alt=\"$row[1]\"></td>";
            echo "</tr>";
        }
        echo "</table>";

    }
    public function rekordokSzama($tabla){
        $sql = "SELECT * FROM $tabla";
        return $this->kapcsolat->query($sql)->num_rows;
    }
    public function kartyaFeltolt($tabla){
        $szinOsszes = $this->rekordokSzama("szin")+1;
        $formaOsszes = $this->rekordokSzama("forma")+1;
        for ($szinIndex =1; $szinIndex < $szinOsszes; $szinIndex++) { 
            for ($formaIndex =1; $formaIndex < $formaOsszes; $formaIndex++) { 
                $sql = "INSERT INTO `kartya`(`szinAzon`, `formaAzon`) VALUES (\"$szinIndex\",\"$formaIndex\")";
                $this->kapcsolat->query($sql);
            }
        }
    }

    public function modosit($oszlop, $tabla, $mire, $mit){
        $sql = "UPDATE $tabla SET $oszlop ='$mire' WHERE $oszlop = '$mit'";
        return $this->kapcsolat->query($sql);
    }
}