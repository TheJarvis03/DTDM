<!DOCTYPE html>
<html>
<head>
    <title>Thêm Điểm</title>
</head>
<body>
    <h2>Thêm Điểm Sinh Viên</h2>

    <form method="post" action="xemdiem.php">
        <label for="masv">Mã Sinh Viên:</label>
        <input type="text" id="masv" name="masv" required><br>

        <label for="mamonhoc">Mã Môn Học:</label>
        <input type="text" id="mamonhoc" name="mamonhoc" required><br>

        <label for="mamonhoc">Điểm:</label>
        <input type="text" id="mamonhoc" name="mamonhoc" required><br>

        <input type="submit" value="Thêm điểm">
    </form>

    <?php
    // Kết nối đến cơ sở dữ liệu MySQL
    $servername = "rds.c7akaseoohte.ap-southeast-1.rds.amazonaws.com";
    $username = "admin";
    $password = "12345678";
    $database = "myDB";

    $conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý khi nhận form submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $masv = $_POST["masv"];
        $mamonhoc = $_POST["mamonhoc"];
        $diem = $_POST["diem"];

        // Truy vấn điểm của sinh viên
        $sql = "INSERT INTO Diem (MaSV, MaMonHoc, Diem) VALUES ('$masv', '$mamonhoc', '$diem')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị điểm của sinh viên
            $row = $result->fetch_assoc();
            echo "Điểm đã được thêm";
        } else {
            echo "Không thể thêm điểm cho sinh viên có Mã SV: $masv và Mã Môn Học: $mamonhoc";
        }
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
