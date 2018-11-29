<?php
namespace App\Repository;

use App\Entity\Project;
use Generic\Repository\AbstractRepository;

class ProjectRepository extends AbstractRepository
{
    protected const TABLE_NAME = 'projet';

    protected const ENTITY_NAME = Project::class;
}








