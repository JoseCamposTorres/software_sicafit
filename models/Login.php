<?php
class Login extends Connect
{
    public function login()
    {
        $connection = parent::Connection();
        parent::Set_names();
        if (isset($_POST["send"])) {
            $dni = htmlspecialchars(trim($_POST["usu_dni"]), ENT_QUOTES, 'UTF-8');
            $password = trim($_POST["usu_password"]);
            if (empty($dni) and empty($password)) {
                header("Location:" . Connect::Path() . "index.php?m=2");
                exit();
            } else {
                $sql = "SELECT * FROM tm_usuarios WHERE usu_dni=? AND usu_status=1";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(1, $dni);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (is_array($result) and count($result) > 0) {
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    if (password_verify($password, $result["usu_password"])) {

                        $_SESSION["usu_id"] = $result["usu_id"];
                        $_SESSION["usu_name"] = $result["usu_name"];
                        $_SESSION["usu_lastname"] = $result["usu_lastname"];
                        $_SESSION["usu_rol"] = $result["usu_rol"];
                        $_SESSION["usu_email"] = $result["usu_email"];
                        $_SESSION["usu_photo"] = $result["usu_photo"];
                        header("Location:" . Connect::Path() . "view/Home/");
                        exit();
                    } else {
                        header("Location:" . Connect::Path() . "index.php?m=1");
                        exit();
                    }
                } else {
                    header("Location:" . Connect::Path() . "index.php?m=1");
                    exit();
                }


                return;
            }
        }
    }
}
