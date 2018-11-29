<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 29/11/2018
 * Time: 16:51
 */

namespace Generic\Entity;


Interface EntityInterface
{
    public function getArrayForDatabase(): array;
}