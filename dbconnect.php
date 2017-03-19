
<?php
$pdo = null;
function connect_to_db()
{
    $dbengine   = 'mysql';
    $dbhost     = 'localhost';
    $dbuser     = 'xhivko';
    $dbpassword = '3sy7Gri2';
    $dbname     = 'databaza1';

    try{
        $pdo = new PDO("".$dbengine.":host=$dbhost; dbname=$dbname", $dbuser,$dbpassword);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->exec("set names utf8");
        return $pdo;
    }
    catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
?>