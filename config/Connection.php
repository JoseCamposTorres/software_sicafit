<?php
session_start();
class Connect
{
    protected $dbh;

    protected function Connection()
    {
        try {
            // Development
            $connect = $this->dbh = new PDO("mysql:host=localhost;dbname=bd_sicafit", "root", "");
            return $connect;
        } catch (Exception $e) {
            print "Database Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function Set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public static function Path()
    {
        // Development
        return "http://localhost/SICAFIT/";
    }
}
