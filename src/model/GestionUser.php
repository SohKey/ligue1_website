<?php

class GestionUser{

    private PDO $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    function register(User $user) {
        $clubFavori = $user->getIdClub();
        $nom = $user->getNomUti();
        $prenom = $user->getPrenomUti();
        $email = $user->getMailUti();
        $password = $user->getPasswordUti();
        $sexe = $user->getSexeUti();
        $photo = $user->getImageUti();
        $date = $user->getDateInscription();

        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO utilisateur VALUES (default, $clubFavori, '$nom','$prenom', '$sexe', '$password', '$date', '$photo', '$email', false)";
        try{
            $this->cnx->query($sql);
        } catch(Exception $err) {
            echo $err;
        }
        
    }

    function updateUser(User $user) {
        $id_uti = $user->getIdUti();
        $clubFavori = $user->getIdClub();
        $nom = $user->getNomUti();
        $prenom = $user->getPrenomUti();
        $email = $user->getMailUti();
        $password = $user->getPasswordUti();
        $sexe = $user->getSexeUti();
        $photo = $user->getImageUti();
        $date = $user->getDateInscription();
        $is_admin = $user->isAdminUti();
        $admin = $is_admin ? 'true' : 'false';

        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE utilisateur
        SET id_club = ".$clubFavori.",
            nom_uti = '".$nom."',
            prenom_uti = '".$prenom."',
            sexe_uti = '".$sexe."',
            password_uti = '".$password."',
            date_inscription = '".$date."',
            image_uti = '".$photo."',
            mail_uti = '".$email."',
            admin_uti = ".$admin."
        WHERE id_uti = ".$id_uti.";
        ";
        try{
            $this->cnx->query($sql);
            return true;
        } catch(Exception $err) {
            echo $err;
            return false;
        }
    }

    function get_user($mail) {
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from utilisateur where mail_uti = '".$mail."'";
        
        $res = $this->cnx->query($sql);
        $user = null;
        while ($ligne = $res->fetch()) {
            $user = new User($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4], $ligne[5], $ligne[6], $ligne[7], $ligne[8], $ligne[9]);
        }
        return $user;
    }

    function get_users_list() {
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from utilisateur ORDER BY id_uti ASC;";
        
        $res = $this->cnx->query($sql);
        $users = [];
        while ($ligne = $res->fetch()) {
            $users[] = new User($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4], $ligne[5], $ligne[6], $ligne[7], $ligne[8], $ligne[9]);
        }
        return $users;
    }

    function get_user_byid($id) {
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from utilisateur where id_uti = '".$id."'";
        
        $res = $this->cnx->query($sql);
        $user = null;
        while ($ligne = $res->fetch()) {
            $user = new User($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4], $ligne[5], $ligne[6], $ligne[7], $ligne[8], $ligne[9]);
        }
        return $user;
    }

    function isAlreadyUsed($mail) {
        if ($this->get_user($mail) != null) {
            return true;
        } return false;   
    }

    function deleteUser($id) {
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM utilisateur
        WHERE id_uti = ".$id;

        try {
            $this->cnx->query($sql);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    function auth_user($mail, $password) {
        $user = $this->get_user($mail);

        if($user != null && password_verify($password, $user->getPasswordUti())) {
            $_SESSION['UserInfo'] = (object) ['id' => $user->getIdUti(), 'mail' => $user->getMailUti()];
            return true;
        }
        return false;
    }
}