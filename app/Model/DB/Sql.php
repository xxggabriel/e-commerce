<?php 

namespace App\Model\DB;

use Config\FileConfig;

class Sql
{

    private $conn;
    public function __construct()
    {
        try {
            $config = new FileConfig();
            $this->conn = new \PDO('mysql:host='.$config->getDatabase('HOST').
            ';dbname='.$config->getDatabase('DB_NAME').';'.
            'port='. $config->getDatabase('PORT'),
            $config->getDatabase('USER'),
			$config->getDatabase('PASSWORD'),
			array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$config->getDatabase('CHARSET')));   
        } catch (\PDOException $e) {
            throw new \Exception("Erro: ".$e->getMessage()."\n".
                                "Code: ".$e->getCode()."\n".
                                "File: ".$e->getFile()."\n".
                                "Line: ".$e->getLine()."\n" );
        }
        
    }

    private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);
		}
	}
	private function bindParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
	}
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function backup()
	{
		$config = new FileConfig;
		exec("mysqldump --routines -u ".$config->getDatabase("USER")." -p". $config->getDatabase("PASSWORD")." ".$config->getDatabase("DB_NAME") ."> ". __DIR__ . "/Backups/backup-".date("Y-m-d_H:i:s").".sql");
		
		// sleep(5);
		exec("git add ".__DIR__ . "/Backups/*");
		exec("git commit -m 'Backup do banco de dados '". date("Y/m/d"));
		exec("git push origin master");
		
	}	
}