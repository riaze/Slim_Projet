<?php
namespace Generic\Repository;

use Generic\Database\Database;

abstract class AbstractRepository
{
    /**
     * Le nom de la table à requêter : CHAQUE REPOSITORY DOIT LA DEFINIR
     */
    protected const TABLE_NAME = null;

    /**
     * Le nom complet de l'entité liée à la table
     */
    protected const ENTITY_NAME = null;

    /**
     * @var Database
     */
    protected $bdd;

    public function __construct(Database $bdd)
    {
        $this->bdd = $bdd;
    }

    /**
     * Retrouve TOUS les enregistrements de la table
     */
    public function findAll(): array
    {
        return $this->bdd->query(
            'SELECT * FROM ' . static::TABLE_NAME,
            static::ENTITY_NAME
        );
    }

    /**
     * Retrouve l'enregistrement lié à l'id fourni
     * @param int $id
     */
    public function findById(int $id)
    {
        // Récupération des résultats (éventuels)
        $result = $this->bdd->prepare(
            'SELECT * FROM ' . static::TABLE_NAME,
            ["id" => $id],
            static::ENTITY_NAME
        );

        // On veut savoir si on a des résultats
        if(empty($result)) {
            return null;
        } else {
            return $result[0];
        }

        // Version ternaire (courte)
        // return (empty($result)) ? null : $result[0];
    }

    public function insert(object $entity ) : bool{

        $params = $entity->getArrayForDatabase();
        return $this->bdd->insert(static::TABLE_NAME,$params);
    }
}













