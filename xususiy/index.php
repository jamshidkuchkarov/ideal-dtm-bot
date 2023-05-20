<?php

$dbHost = "localhost"; // Ma'lumotlar omborining host nomi
$dbUser = "a116152_idealbot"; // Ma'lumotlar omborining foydalanuvchi nomi
$dbPassword = "xt.RqQRkLKI~5&yi"; // Ma'lumotlar omborining paroli
$dbName = "a116152_ideal_bot"; // Ma'lumotlar ombori nomi
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Ma'lumotlar omboriga ulanishda xatolik yuz berdi: " . mysqli_connect_error());
}
$sql = "SELECT data_json,chatID FROM users";

$result = mysqli_query($conn, $sql);

//?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <table id="myTable" class="table">
        <thead>
        <tr>
            <th scope="col">FISH</th>
            <th scope="col">Kasb</th>
            <th scope="col">Manzili</th>
            <th scope="col">Tamomlagan yoki o'qiyotgan oliy ta'limi</th>
            <th scope="col">Oliy ta'limni tamomlagan yilingiz yoki o'qiyotgan kursi</th>
            <th scope="col">Tamomlagan yoki o'qiyotgan mutaxasissligingiz:</th>
            <th scope="col">Yil yoki Fani:</th>
            <th scope="col">Tel</th>
            <th scope="col">Qo'shimcha TEL</th>
            <th scope="col">Rus tilida dars o'tish</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $dbHost = "localhost"; // Ma'lumotlar omborining host nomi
        $dbUser = "a116152_idealbot"; // Ma'lumotlar omborining foydalanuvchi nomi
        $dbPassword = "xt.RqQRkLKI~5&yi"; // Ma'lumotlar omborining paroli
        $dbName = "a116152_ideal_bot"; // Ma'lumotlar ombori nomi
        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

        if (!$conn) {
            die("Ma'lumotlar omboriga ulanishda xatolik yuz berdi: " . mysqli_connect_error());
        }
        $sql = "SELECT data_json,chatID FROM users";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if(isset($row['data_json']) && isset($row['chatID'])){
                $text = base64_decode(json_decode($row['data_json'],true)['course']);
                if(base64_decode(json_decode($row['data_json'],true)['subject'])=='Zavuch👨‍💼' ||base64_decode(json_decode($row['data_json'],true)['subject'])=='Удовольствие👨‍💼'){
                    $text = base64_decode(json_decode($row['data_json'],true)['zavuch_year']);
                }
                echo "<tr>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['firstName'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['subject'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['map'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['university'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['year'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['subject_year'])."</td>";
                echo "<td>".$text."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['phoneNumber'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['addPhone'])."</td>";
                echo "<td>".base64_decode(json_decode($row['data_json'],true)['showlang'])."</td>";


                echo "</tr>";


            }
}

        ?>
        </tbody>
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    </table>


<button onclick="dowload()">Yuklash</button>
<script>

    function dowload(){
        var table = document.getElementById('myTable');

        // Fayl nomini va turi
        var filename = 'data.xlsx';
        var fileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
        var fileExtension = '.xlsx';

        // Faylni yaratish
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.table_to_sheet(table);

        // Faylga jadvallarni qo'shish
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Faylni joylash va yuklash
        var wbout = XLSX.write(wb, {bookType: 'xlsx', type: 'binary'});
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) {
                view[i] = s.charCodeAt(i) & 0xFF;
            }
            return buf;
        }

        // Faylni yuklash uchun ss-link yaratish
        var downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(new Blob([s2ab(wbout)], {type: fileType}));
        downloadLink.download = filename + fileExtension;

        // Faylni yuklashni boshlash
        downloadLink.click();
    }
</script>
</body>
</html>