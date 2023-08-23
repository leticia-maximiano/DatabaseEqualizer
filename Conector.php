<?php
class Conector {
  private $pdo;

  public function __construct()
  {
    $this->pdo = new \PDO(
      "pgsql:host=localhost;port=5432;dbname=equalizer;",
      "postgres",
      "111",
      [PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION]
    );

    $tableScripts = $this->execute(
      "SELECT EXISTS (SELECT 1 FROM PG_TABLES WHERE TABLENAME = 'adexecutedscripts' and schemaname = 'public') AS TABLEEXISTENCE"
    );

    if(!$tableScripts["tableexistence"]) {
      $this->execute(
        "CREATE TABLE ADEXECUTEDSCRIPTS (
          ADIDEXECUTEDSCRIPTS SERIAL PRIMARY KEY,
          ADNMEXECUTEDSCRIPTS VARCHAR(100) NOT NULL
        )"
      );
    }
  }

  public function execute($sql, $params = null, $isInsert = false){
    $statement=$this->pdo->prepare($sql);
    $statement->execute($params);

    if ($isInsert) {
       return $this->pdo->lastInsertId();
    }

    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}