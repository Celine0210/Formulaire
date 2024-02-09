<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
     
    $servername = "localhost";
    $utilisateur = "root"; 
    $mdp = "root"; 
    $BDA = "Formulaire";

    $connexion = new mysqli($servername, $utilisateur, $mdp, $BDA);

    if ($connexion->connect_error) {
        die("Connexion échouée : " . $connexion->connect_error);
    } else {
        if(isset($_POST['valider'])) {
            $identifiant = $_POST['identifiant'];
            $motDePasse = $_POST['motDePasse'];
                        
            $ope = $connexion->prepare("SELECT * FROM informations WHERE identifiant = ?");
            if ($ope) {
                $ope->bind_param("s", $identifiant);
                $ope->execute();
                $result = $ope->get_result();
                if ($result->num_rows > 0) {
                    while($ligne = $result->fetch_assoc()) {
                        if (password_verify($motDePasse,$ligne['mot_de_passe'])) {
                            
                            header("location:index.html?param=1");
                        } else {

                            header("location:index.html?param=2");
                          }
                    }
                } else {
                    header("location:index.html?param=2");
                } 

            }
        }
        if(isset($_POST['ajout'])) {
            echo "message";
            $identifiant = $_POST['identifiant'];
            $motDePasse = $_POST['motDePasse'];
            $hashedMotDePasse = password_hash($motDePasse,PASSWORD_DEFAULT);
            $sql = "INSERT INTO informations (identifiant,mot_de_passe) VALUES ('$identifiant', '$hashedMotDePasse')";

            if ($connexion->query($sql) === TRUE) {
                header("location:index.html?param=3");
            } else {
                header("location:index.html?param=4");
            }

        }
    }
    $connexion->close();


}
?>
