<?php
// Variable
$name = "Windi Suarsih";
$age = 21;
echo "Nama: " . $name . "<br>";
echo "Umur: " . $age . " tahun<br>"; 

// Konstanta
define("SITE_NAME", "PKL di Microdata Indonesia");

//Tipe Data Integer
$integerNumber = 100;
echo "Nilai Integer: " . $integerNumber . "<br>";

// Tipe Data String
$stringText = "Hello, Wind! <br> ";
echo "Nama Situs: " . SITE_NAME . "<br>";

// Tipe Data Float
$floatNumber = 10.5;
echo "Nilai Float: " . $floatNumber . "<br>";

// Operator Aritmatika
$a = 10;
$b = 5;
$sum = $a + $b;  // Penjumlahan
$diff = $a - $b; // Pengurangan
$mul = $a * $b;  // Perkalian
$div = $a / $b;  // Pembagian
$mod = $a % $b;  // Modulus

// Menampilkan hasil
echo "Nilai A: $a <br>";
echo "Nilai B: $b <<br>";

echo "Penjumlahan (A + B): $sum <br>";
echo "Pengurangan (A - B): $diff <br>";
echo "Perkalian (A * B): $mul <br>";
echo "Pembagian (A / B): $div <br>";
echo "Modulus (A % B): $mod <br>";

// Operator Logika
$x = true;
$y = false;
$andResult = $x && $y; // AND
$orResult = $x || $y;  // OR
$notResult = !$x;      // NOT

// Struktur Logika IF
if ($age >= 18) {
    echo "Windi sudah pulang <br>";
} else {
    echo "Windi belum pulang <br>";
}

// Struktur Logika SWITCH
$day = "Senin";
switch ($day) {
    case "Senin":
        echo "Hari ini adalah Senin <br>";
        break;
    case "Selasa":
        echo "Hari ini adalah Selasa <br>";
        break;
    default:
        echo "Hari tidak dikenali <br>";
}

// 10. Perulangan For
for ($i = 1; $i <= 5; $i++) {
    echo "Angka: $i <br>";
}

// 11. Perulangan Foreach
$animals = ["Kucing", "Anjing", "Kelinci"];
foreach ($animals as $animal) {
    echo "Hewan: $animal <br>";
}


// 12. Perulangan While
$counter = 1;
while ($counter <= 3) {
    echo "Perulangan While ke-$counter ";
    $counter++;
}

// 13. Penulisan Function
function greet($name) {
    return "Halo, $name! <br> ";
}

echo greet("Windi");

?>
