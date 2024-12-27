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

        <label for="diem">Điểm:</label>
        <input type="text" id="diem" name="diem" required><br>

        <input type="submit" value="Thêm điểm">
    </form>

    <?php
    // Kết nối đến cơ sở dữ liệu MySQL
    $servername = "rds.c7akaseoohte.ap-southeast-1.rds.amazonaws.com";
    $username = "admin";
    $password = "12345678";
    $database = "myDB";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý dữ liệu khi form được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $masv = $_POST['masv'];
        $mamonhoc = $_POST['mamonhoc'];
        $diem = $_POST['diem'];

        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = $conn->prepare("INSERT INTO diem (masv, mamonhoc, diem) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $masv, $mamonhoc, $diem);

        if ($stmt->execute()) {
            echo "Thêm điểm thành công.";
        } else {
            echo "Lỗi: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
