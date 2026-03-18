<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="T2-1-logincss.css" />
  </head>

  <body>
    <div class="latar"></div>

    <div class="isi">
      <div class="kiri">
        <div class="sapa">
          <h2>Temukan Film Favoritmu <br />dan pesan tiket dengan mudah <br />kapan saja dan di mana saja</h2>
        </div>
        <div class="bagmer">
          <img src="coverFilm/bag mer.jpg" alt="" />
        </div>
      </div>

      <div class="kanan">
        <form action="T2-2-dashbord.php" method="post">
          <p class="login">Login</p>
          <div class="inputemailpassword">
            <div class="email">
              <label for="email">Email</label><br />
              <input type="email" id="email" name="email" placeholder="124250135@example.com" />
            </div>
            <div class="password">
              <label for="password">Password</label><br />
              <input type="password" id="password" name="password" required />
            </div>
            <button type="submit">Login</button>
          </div>
        </form>
      </div>

      <!--  -->
      <?php 
      if($_SERVER["REQUEST_METHOD"] == "post"){
        // php Variabel
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($_POST["email"] === "135@gmail.com" and $_POST["password"] === "135")

      }
      ?>

    </div>
  </body>
</html>
