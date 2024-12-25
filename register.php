<!DOCTYPE HTML>  
<html>
<head>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 20px;
  padding: 20px;
  background-color: #f9f9f9;
}
.error {
  color: #FF0000;
}
h2 {
  color: #333;
}
form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
input[type="text"], textarea {
  width: 100%;
  padding: 8px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
}
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type="submit"]:hover {
  background-color: #45a049;
}
</style>
</head>
<body>  

<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "จำเป็นต้องกรอกชื่อ";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Zก-ํ\-' ]*$/",$name)) {
      $nameErr = "อนุญาตให้ใช้ตัวอักษรและช่องว่างเท่านั้น";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "จำเป็นต้องกรอกอีเมล";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "รูปแบบอีเมลไม่ถูกต้อง";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "รูปแบบ URL ไม่ถูกต้อง";
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "จำเป็นต้องเลือกเพศ";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>ตัวอย่างแบบฟอร์มตรวจสอบข้อมูล PHP</h2>
<p><span class="error">* จำเป็นต้องกรอกข้อมูล</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  ชื่อ: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  อีเมล: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  เว็บไซต์: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  ข้อคิดเห็น: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  เพศ:
  <input type="radio" name="gender" value="female">หญิง
  <input type="radio" name="gender" value="male">ชาย
  <input type="radio" name="gender" value="other">อื่น ๆ
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="ส่งข้อมูล">  
</form>

<?php
echo "<h2>ข้อมูลที่คุณกรอก:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>
