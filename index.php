<?php
  require "./connection.php";
  $sql = "SELECT * FROM images GROUP BY created_at DESC";
  $result = mysqli_query($connect, $sql);
  if (isset($_GET['search'])) {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "SELECT * FROM images WHERE image_url LIKE('%${search}%') OR category LIKE('%${search}%') GROUP BY created_at DESC";
    $result = mysqli_query($connect, $sql);
  }

  if (isset($_GET['category'])) {
    $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($category === "all") {
      $category = "";
    }
    $sql = "SELECT * FROM images WHERE category LIKE('%${category}%') GROUP BY created_at DESC";
    $result = mysqli_query($connect, $sql);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinterest/Home</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
  <div class="wrapper" id="wrapper">
    <div class="header">
      <a class="logo" href="./index.php"><i class="fa-brands fa-pinterest"></i></a>
      <a class="btn" href="./index.php" style="color: white; background-color: black;">Home</a>
      <a class="btn" href="./create.php">Create pin</a>
      <form class="search" id="search" action="./index.php" method="GET">
        <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" id="search-input" placeholder="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ; ?>">
        <button type="submit" style="display: none;"></button>
        <a class="search-close-btn" id="close-search" style="display: none;" href="./index.php"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
      </form>
      <form id="filter" action="./index.php"  method="GET">
        <select class="select-filter" name="category" id="category">
          <option value="all">All Categories</option>
          <?php 
            $sqlCategory= "SELECT DISTINCT(category) AS category FROM images";
            $resultCategory = mysqli_query($connect, $sqlCategory);
            if (mysqli_num_rows($resultCategory) > 0) {
              while ($rowCategory = mysqli_fetch_assoc($resultCategory)) {
                if (isset($_GET['category']) && $_GET['category'] === $rowCategory['category']) {
                  ?>
                    <option value="<?= $rowCategory['category']; ?>" selected><?= $rowCategory['category']; ?></option>
                  <?php
                } else {
                  ?>
                    <option value="<?= $rowCategory['category']; ?>"><?= $rowCategory['category']; ?></option>
                  <?php
                }
              }
            }
          ?>
          </select>
      </form>
    </div>
    <div class="main">
      <div class="pin_container">
        <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <div class="card image">
                  <img src="<?= $row['image_url']; ?>" id="<?= $row['id'] ?>">
                  <a class="btn" href="./delete.php?delete=<?= $row['id']; ?>&image=<?= $row['image_url']; ?>">Delete image</a>
                </div>
              <?php
            }
          } else {
            ?>
              <h1>Images not found!</h1>
            <?php
          }
        ?>
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
    const images = document.getElementsByClassName('image');
    let inpFocus = false;
    const cardSmall = 150;
    const cardMedium = 250;
    const cardLarge = 400;

    Array.from(images).forEach(item => {
      let height = item.clientHeight;
      item.style.gridRowEnd = `span ${height + 20}`;
      console.log(item.clientHeight);
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