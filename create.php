<?php
  require "./connection.php";
  if (isset($_POST['add'])) {
    $id = uniqid();
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $time = time();

    if (isset($_FILES['file'])) {
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $filePath = "pictures/" . $id . $fileName;
      move_uploaded_file($fileTmpName, $filePath);
    
      $sql = "INSERT INTO images (id, category, image_url, created_at) VALUES ('${id}', '${category}', '${filePath}', ${time});";
      if (mysqli_query($connect, $sql)) {
        header("Location: ./index.php");
      } else {
        unlink($filePath);
        header("Location: ./create.php?message=SQL error!&path=$filePath");
      }
    } else {
      header("Location: ./create.php?message=Something went wrong!");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinterest/Create pin</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
  <div class="wrapper" id="wrapper">
    <div class="header">
      <a class="logo" href="./index.php"><i class="fa-brands fa-pinterest"></i></a>
      <a class="btn" href="./index.php">Home</a>
      <a class="btn" href="./create.php">Create pin</a>
      <form class="search" id="search" action="./index.php" method="GET">
        <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" id="search-input" placeholder="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ; ?>">
        <button type="submit" style="display: none;"></button>
        <a class="search-close-btn" id="close-search" style="display: none;" href="./index.php"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
      </form>
      <form id="filter" action="./index.php" method="POST">
        <select name="category" id="category">
          <option value="all">All Category</option>
        </select>
      </form>
    </div>
    <div class="main" style="background-color: #e9e9e9;">
      <div class="inner-main-create">
        <form class="create-pin-form" action="./create.php" method="POST" enctype="multipart/form-data">
          <?php
            if (isset($_GET['message'])) {
              ?>
                <h3 style="color: red;"><?= $_GET['message']; ?></h3>
              <?php
            }
          ?>
          <label for="file" class="upload-image">
            <i id="label-icon" class="fa-solid fa-circle-up"></i>
            <p id="message">Click here for upload your image</p>
            <input type="file" name="file" id="file" style="display: none;"accept="image/jpeg, image/jpg, image/png, image/webp" required>
          </label>
          <div class="div">
            <input type="text" name="category" placeholder="Category..." required>
            <button type="submit" name="add">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/736804efb5.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    const icon = document.getElementById('search-icon');
    const search = document.getElementById('search');
    const inp = document.getElementById('search-input');
    const close = document.getElementById('close-search');
    const filter = document.getElementById('filter');
    const category = document.getElementById('category');
    const file = document.getElementById('file');
    const message = document.getElementById('message');
    const labelIcon = document.getElementById('label-icon');

    let inpFocus = false;

    file.addEventListener('change', (e) => {
      if (e.target.value !== "") {
        message.innerHTML = `
          File was changed from ${e.target.value},
          <br/>
          now click Save to continue:
        `;
      }
    });
    category.addEventListener('change', (e) => {
      filter.submit();
    });
    document.addEventListener('DOMContentLoaded', () => {
      if (inp.value !== "") {
        icon.style.display = 'none';
        search.style.gridTemplateColumns = 'auto 40px';
        close.style.display = 'block';
      }
    });
    inp.addEventListener('focus', () => {
      icon.style.display = 'none';
      search.style.border = '3px solid #7FC1FF';
      search.style.gridTemplateColumns = 'auto 40px';
      close.style.display = 'block';
    });
    inp.addEventListener('focusout', () => {

      if (inp.value !== ""){
        search.style.border = 'none';
      } else {
        icon.style.display = 'block';
        search.style.border = 'none';
        search.style.gridTemplateColumns = '30px auto';
        close.style.display = 'none';
        inp.value = "";
      }
    });
    $("#search-input").focusout(() => {
      inp.value !== ""? search.style.border = 'none' : () => {
        icon.style.display = 'block';
        search.style.border = 'none';
        search.style.gridTemplateColumns = '30px auto';
        close.style.display = 'none';
        inp.value = "";
      }; 
    });
  </script>
  
</body>
</html>