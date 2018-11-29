<?php
namespace Generic\Database;

class Database
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $dbName;
    /**
     * @var string
     */
    private $dbUser;
    /**
     * @var string
     */
    private $dbPassword;

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(string $host, string $dbName, string $dbUser, string $dbPassword)
    {
        // Initialisation des paramètres
        $this->host = $host;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        // Connexion à la BDD
        $this->connect();
    }

    /**
     * Fermeture de la connexion PDO
     */
    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * Connexion à la BDD avec PDO
     * @throws \Exception
     */
    private function connect()
    {
        try {
            $this->pdo = new \PDO(
                'mysql:host='.$this->host.';dbname='.$this->dbName,
                $this->dbUser,
                $this->dbPassword,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            );
        } catch (\PDOException $e) {
            throw new \Exception('Erreur de connexion à la BDD');
        }
    }

    /**
     * Effectue une requête avec PDO
     * @param string $query - Requête à exécuter
     * @param string|null $className
     * @return array
     */
    public function query(string $query, ?string $className = null): array
    {
        // Doit-on faire un fetchMode (mode de récupération) particulier ?
        if(is_null($className)) {
            // Si aucune classe n'est fournie => on récupère dans un tableau
            $statement = $this->pdo->query($query);
        } else{
            // Sinon on renvoie les résultats dans la classe fournie
            $statement = $this->pdo->query($query, \PDO::FETCH_CLASS, $className);
        }

        return $statement->fetchAll();
    }

    /**
     * Effectue une requête préparée avec PDO
     * @param string $query
     * @param array $params
     * @param string|null $className
     * @return array
     */
    public function prepare(string $query, array $params, ?string $className = null): array
    {
        $query = $query . ' WHERE ';
        // Booléen permettant de tester le premier tour de boucle
        $isFirst = true;
        foreach ($params as $column => $value) {
            // Si c'était le premier tour
            if($isFirst) {
                // On rajoute PAS le "AND"
                $query .= " $column = ?";
                // On change le booléen car ce n'est plus le 1er tour
                $isFirst = false;
            } else {
                // On rajoute le "AND"
                $query .= " AND $column = ?";
            }
        }

        // On prépare la requête
        $statement = $this->pdo->prepare($query);
        // On exécute la requête
        $statement->execute(array_values($params));
        // On retourne le résultat

        // Doit-on faire un fetchMode (mode de récupération) particulier ?
        if(is_null($className)) {
            // Si aucune classe n'est fournie => on récupère dans un tableau
            return $statement->fetchAll();
        } else{
            // Sinon on renvoie les résultats dans la classe fournie
            return $statement->fetchAll(\PDO::FETCH_CLASS, $className);
        }
    }
    // Insert into db
    public function insert(string $tableName, array $params): bool{

        //prepartion de la requéte sql

         $query = 'INSERT INTO ' . $tableName.' ';
         $isFirst = true;
         foreach($params as $key => $param){
             if($isFirst){
                 $query .= '( '.$key;
                 $isFirst =false;
             }else{
                 $query .=','.$key;
             }
         }
         $query .=')';
         var_dump($query);
         die('formation requete SQL');

        //PDO->prepare

        //on "bind" les parametre

        // on execute

    }
}



