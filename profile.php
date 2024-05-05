<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitChooser</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&family=Imperial+Script&display=swap"
      rel="stylesheet"
    />
    <style>
      :root {
          --lasuli: #416788;
          --erieblack: #1e1e1e;
          --erieblack_alpha: rgba(30, 30, 30, 0.544)e;
          --isabelline: #F5F0EE;
          --isabelline_alpha: #f5fdeea4;
          --red: #fd9696;
          --gray: rgba(217, 217, 217, 0.37);
        }
      html{
        background-color: var(--isabelline);
      }
      body{
        margin: 0;
      }
      header {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
            align-content: center;
            background: var(--lasuli);
            color: var(--isabelline);
            border-radius: 0 0 30px 30px;
            height: 20vh;
      }
      .logo{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        align-content: center;
        width: auto;
        height: 95%;
        transition: all 0.3s ease;
      }
      .logo:hover{
        cursor: pointer;
        transform: scale(1.1);
      }
      .logo img{
        --width: 20%;
        --height: 80%;
        width: var(--width);
        height: var(--height);
        margin-top: -2em;
        object-fit: cover;
        padding: 0 10px;
      }
      .logo h1{
        font-family: "Imperial Script", cursive;
        font-weight: 500;
        font-style: normal;
        text-decoration: none;
        color: var(--isabelline);
        font-size: 60pt;
        margin-top: 30px;
        padding: 0 30px;
      }
      header h2 {
        font-size: 1.5em;
        font-family: "IM Fell English SC", serif;
        font-weight: 400;
        font-style: normal;
        margin-top: -55px;
      }
      /* empieza la parte de datos del perfil*/
      .perfil{
        display: flex;
        flex-direction: row;
        margin-top: 50px;
        margin-left: 162px;
      }
      .perfil img{
        height: 150px;
        width: 125px;
        margin-left: 65px;
      }
      .perfil a{
        margin-top: 20px;
        font-size: 1.2em;
        margin-left: 40px;
        text-decoration: none;
      }
      .datos{
        margin-top: 32px;
        display: flex;
        flex-direction: column;
        margin-left: 200px;
      }
      .foto{
        margin-left: 25px;
        display: flex;
        flex-direction: column; 
      }
      #editar{
        font-size: 1.2em;
        margin: 40px;
        margin-left: 43%;
        background-color: var(--red);
        color: black;
        border: none;
        height: 50px;
        width: 200px;
        border-radius: 35px;
      }
      #editar:hover{
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        transform: scale(1.1);
        transition: all 0.3s ease;
      }
      label{
        font-size: 1.5em;
          margin-bottom: 20px;
      }
      /*empieza seccion de prendas agregadas */  
      .botones{
        margin: 30px;
        display: flex;
        justify-content: space-between;
      }
      .botones button{
        height: 70px;
        width: 70px;
        background-color: var(--red);
        border: none;
        border-radius: 50px;
      }
      .botones button:hover{
        cursor: pointer;
        background-color: var(--red);
        border: none;
        border-radius: 50px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        transform: scale(1.1);
        transition: all 0.3s ease;
      }
      .botones h2{
        font-size: 2.5em;
      }
      .botones #add{
        background-image: url("/img/add_black.png");
        background-size: 35px;
        background-repeat: no-repeat;
        background-position: 50% 50%;
      }
      .botones #delete{
        background-image: url("/img/basura.png");
        background-size: 35px;
        background-repeat: no-repeat;
        background-position: 50% 50%;
      }
      .prendas{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
      }
      .card{
        margin-top: 50px;
        width: 300px;
        height: 400px;
        background-color:black;
        display: flex;
        flex-direction: column;
        margin-bottom: 50px;
        justify-content: center;
        border-radius: 25px;
      }
      .card:hover{
        transform: scale(1.03);
        box-shadow: 0 0 30px -10px var(--erieblack);
        transition: all 0.3s ease;
      }
      .prendas .card img{
        margin-top: 60px;
        margin-left: 18px;
        height: 270px;
        width: 260px;
        border-radius: 25px;
        
      }
      .card h3{
        color: white;
        text-align: center;
        margin-bottom: 70px;
        font-size: 2em;
        font-family: "IM Fell English SC", serif;
        color: var(--isabelline);
      } 
      footer {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 10vh;
          background: var(--lasuli);
          color: var(--isabelline);
          border-radius: 30px 30px 0 0;
      }
    </style>
</head>
<body>
    <header>
        <div class="logo">
          <img src="img/logo.png" alt="Logo" />
          <a href="./dashboard.php" style="text-decoration: none"
            ><h1>Fit Chooser</h1></a
          >
        </div>
        <h2>Stay Cool</h2>
    </header>
    <div class="perfil">
        <div class="foto">
            <img src="img/user_black.png" alt="Profile" />
            
        </div>
        <div class="datos">
            <label for="email">Email: </label>
            <label for="edad">Edad:</label>
            <label for="telefono">Telefono:</label>
        </div>
        <div class="datos">
            <label for="nombre">Nombre: </label>
            <label for="pais">Pais:</label>
            <label for="estado">Estado:</label>
        </div>
        <div class="datos">
            <label for="localidad">Localidad: </label>
        </div>
    </div>
    <button id="editar">Editar informacion</button>
    <hr>
    <div class="botones">
      <button id="delete"></button>
      <h2>Prendas agregadas</h2>
      <button id="add"></button>
    </div>
    <div class="prendas">
        <div class="card">
          <img src="img/Hodie.jpg" alt="imagen" />
          <h3>Hoddie</h3>
        </div>
        <div class="card">
          <img src="img/tshirt.jpg" alt="imagen" />
          <h3>Camiseta</h3>
        </div>
        <div class="card">
          <img src="img/Jeans.jpg" alt="imagen" />
          <h3>Pantalon</h3>
        </div>
        <div class="card">
          <img src="img/gorra.jpg" alt="imagen" />
          <h3>Gorra</h3>
        </div>
    </div>
    <footer>
        <p>Fit Chooser 2021 ©</p>
    </footer>
</body>
</html>
