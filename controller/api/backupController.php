<?php
require_once("../../config/Connection.php");
require_once("../../models/Backup.php");
include 'api-google/vendor/autoload.php';

$backup = new Backup();

switch ($_GET["op"]) {
    case "generar":
        $databases = ['bd_sicafit'];
        $user = "root";
        $pass = "";
        $host = "localhost";

        date_default_timezone_set("America/Lima");

        putenv('GOOGLE_APPLICATION_CREDENTIALS=sicafit-9c3c55967938.json');

        $client = new Google_Client();

        $client->useApplicationDefaultCredentials();
        $client->setScopes(['https://www.googleapis.com/auth/drive.file']);

        try {
            $service = new Google_Service_Drive($client);

            foreach ($databases as $database) {
                //Desarrollo
                if (!file_exists(("C:/xampp/htdocs/SICAFIT/database/backup_bd/$database"))) {
                    mkdir("C:/xampp/htdocs/SICAFIT/database/backup_bd/$database");
                }

                $usuId = $_SESSION["usu_id"];
                $backupName = "backup_" . date("Y-m-d_H-i-s") . ".sql";

                $folder = "C:/xampp/htdocs/SICAFIT/database/backup_bd/$database/" . $backupName;;

                $resultadoFinal = exec("C:/xampp/mysql/bin/mysqldump --user={$user} --password={$pass} --opt --routines=TRUE --host={$host} {$database} --result-file={$folder}", $output);

                //Produccion
                // if (!file_exists(("/var/www/html/GenerarBackup/bd/$database"))) {
                //     mkdir("/var/www/html/GenerarBackup/bd/$database");
                // }

                // $filename = $database . "_" . date("F_D_Y") . "@" . date("g_ia") . uniqid("_", false);
                // $folder = "/var/www/html/GenerarBackup/bd/$database/" . $filename . ".sql";

                // $resultadoFinal = exec("usr/bin/mysqldump --user={$user} --password={$pass} --opt --routines=TRUE --host={$host} {$database} --result-file={$folder}", $output);
            }

            if (!$backup->guardarBackup($backupName, $usuId)) {
                echo json_encode(["status" => "error", "message" => "Error al guardar en la base de datos."]);
                exit;
            }

            $file_path = $folder;

            $file = new Google_Service_Drive_DriveFile();
            $file->setName($backupName);

            $file->setParents(array("1eYL_vqYrBX-HV28jSqLNPL_zIuAdgMoj"));
            $file->setDescription("ARCHIVO CARGADO AL DRIVE");

            $resultado = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($file_path)
                )
            );
        } catch (Google_Service_Exception $gs) {
            $mensaje = json_decode($gs->getMessage());
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;

        /**TODO: Listar cargo en tabla */
    case 'listar':
        $datos = $backup->get_backup();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["back_name"];

            $sub_array[] = $row["usu_name"] . ' ' . $row["usu_lastname"];
            $sub_array[] = $row["back_date_new"];



            $backupFile = $row["back_name"]; // Ejemplo: 'backup_2025-03-05_10-35-12.sql'
            $filePath = "../../database/backup_bd/bd_sicafit/" . $backupFile;
            
            // Verifica si el archivo existe antes de mostrar el botón
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/SICAFIT/database/backup_bd/bd_sicafit/" . $backupFile)) {
                $downloadLink = "<a href='$filePath' class='btn btn-primary'>
                                    <i class='fa fa-cloud-download'></i> Descargar
                                 </a>";
            } else {
                $downloadLink = "<span class='text-danger'>❌ Archivo no encontrado</span>";
            }
            
            $sub_array[] = $downloadLink;
            

            // if ($row["cargo_status"] == "1") {
            //     $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            // } else {
            //     $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            // }
            $data[] = $sub_array;
        }
        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($result);
        break;
}
