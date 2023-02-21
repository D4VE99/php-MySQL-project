<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE if not exists progettocogliati";
if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error creating database: " . $conn->error;
}
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "progettocogliati";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE if not exists utente (
  nomeutente VARCHAR(30) NOT NULL PRIMARY KEY,
  email VARCHAR(50),
  telefono varchar(15),
  password varchar(20),
  immagine varchar(30)
  )";
  
  if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  $sql = "CREATE TABLE if not exists scrive (
    idblog INT(6) unique,
    nomeutente VARCHAR(30) 
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "";
    } else {
      echo "Error creating table: " . $conn->error;
    }
  $sql = "CREATE TABLE if not exists post (
    idpost INT(6) AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(30) NOT NULL,
    titolo VARCHAR(30) NOT NULL,
    testo VARCHAR(900),
    autore VARCHAR(30),
    coautore VARCHAR(30),
    dora DATETIME(1),
    idblog int(6)
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE if not exists commento (
      idcommento INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      idpost INT(6),
      utente VARCHAR(30) NOT NULL,
      testo VARCHAR(300)
      )";
      
      if ($conn->query($sql) === TRUE) {
        echo "";
      } else {
        echo "Error creating table: " . $conn->error;
      }
      $sql = "CREATE TABLE if not exists pro (
        nomeutente varchar(30) PRIMARY KEY,
        carta varchar(30),
        cvv varchar(4),
        pro int(1) default 0
        )";
        
        if ($conn->query($sql) === TRUE) {
          echo "";
        } else {
          echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE if not exists grafica (
          idimm int(6) AUTO_INCREMENT PRIMARY KEY,
          nome int(6),
          immagine varchar(60)
          )";
          
          if ($conn->query($sql) === TRUE) {
            echo  "";
          } else {
            echo "Error creating table: " . $conn->error;
          }
          $sql = "CREATE TABLE if not exists blog (
            nomeb varchar(30),
            coautore1 varchar(30),
            coautore2 varchar(30),
            idblog int(6) AUTO_INCREMENT PRIMARY KEY,
            descrizione varchar(60),
            colore varchar(10),
            stile varchar(20)
            )";
            
            if ($conn->query($sql) === TRUE) {
              echo  "";
            } else {
              echo "Error creating table: " . $conn->error;
            }
            $sql = "CREATE TABLE if not exists mette (
              nomeutente varchar(30),
              idpost int(6)
              )";
              
              if ($conn->query($sql) === TRUE) {
                echo  "";
              } else {
                echo "Error creating table: " . $conn->error;
              }
              $sql = "CREATE TABLE if not exists likes (
                likes int(9) default 0,
                idpost int(6)
                )";
                
                if ($conn->query($sql) === TRUE) {
                  echo  "";
                } else {
                  echo "Error creating table: " . $conn->error;
                }
            
$conn->close();
?>