<?php
namespace Core\Managers\Core;

use Core\DB\DBRequester;
use Core\DB\DBTableRetriver;
use Core\DB\DBValueRetriver;
use Core\DB\Fields\DBFieldsRetriver;
use Core\DB\QueryBuilder;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;

/**
 * Description of SuperManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class SuperManager extends DBRequester {

    /**
     * 
     * @var Serializer
     */
    private $serializer;

    /* -------------------------------------------------------------------------
     *                  BEGIN - SERIALIZER
     * ---------------------------------------------------------------------- */

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer {
        if (null === $this->serializer) {
            $this->serializer = $this->initSerializer();
        }
        return $this->serializer;
    }

    /**
     * @return Serializer
     */
    abstract protected function initSerializer();

    /* -------------------------------------------------------------------------
     *                  BEGIN - Fields Retrive Methods (protected/private)
     * ---------------------------------------------------------------------- */

    final private function getItems($items = null) {
        if (null === $items) {
            $className = $this->getSerializer()->getClassModel();
            $items = new $className();
        }
        return $items;
    }

    final protected function getInsertFields($items) {
        return DBFieldsRetriver::retriveInsertFields($items);
    }

    final protected function getSelectFields() {
        return DBFieldsRetriver::retriveSelectFields($this->getItems());
    }

    final protected function getPrimaryFields($items) {
        return DBFieldsRetriver::retrivePrimaryFields($items);
    }
    
    final protected function getUpdateFields() {
        return DBFieldsRetriver::retriveUpdatableFields($this->getItems());
    }

    final protected function getFieldByProperty(string $propertyName, $items = null) {
        return DBFieldsRetriver::retriveFieldByPropertyName($propertyName, $this->getItems($items));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Table Retrive Methods (protected)
     * ---------------------------------------------------------------------- */

    final protected function getTable($items = null) {
        if (null === $items) {
            $className = $this->getSerializer()->getClassModel();
            $items = new $className();
        }
        return DBTableRetriver::retrive($items);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Generic methods
     * ---------------------------------------------------------------------- */

    protected function create($items) {
        $fields = $this->getInsertFields($items);
        $table = $this->getTable($items);

        $qb = new QueryBuilder();
        $qb->setTable($table)
                ->insert()
                ->setFields($fields);
        if ($items instanceof Model) {
            $qb->addValue($items);
        } else {
            $qb->setValues($items);
        }

        return $this->execute($qb);
    }

    protected function update($items) {
        $qb = $this->prepareUpdate($items);
        
        return $qb;
        //$queryString = QueryStatementFactory::create($qb);
        //var_dump($queryString);die;
        
        
    }

    /**
     * 
     * @param type $clauses
     * @param type $limit
     * @return QueryBuilder
     */
    protected function prepareFindBy($clauses = [], $limit = null) {
        $fields = $this->getSelectFields();
        $table = $this->getTable();

        $qb = new QueryBuilder();

        $qb->setTable($table)
                ->select()
                ->setFields($fields);
        foreach ($clauses as $clause => $value) {
            $field = DBFieldsRetriver::retriveFieldByPropertyName($clause, $this->getItems());
            $qb->addClause($field, $value);
        }
        if (null !== $limit) {
            $qb->setLimit($limit);
        }

        return $qb;
    }

    /**
     * @return QueryBuilder
     */
    protected function prepareUpdate($items = null) {
        $table = $this->getTable($items);
        $primaries = $this->getPrimaryFields($items);

        $qb = new QueryBuilder();
        $qb->update()
                ->setTable($table);

        foreach ($primaries as $primary) {
            $qb->addClause($primary, DBValueRetriver::retrive($primary, $items));
        }
        
        return $qb;
    }

    public function findBy($clauses = [], $limit = null) {
        $qb = $this->prepareFindBy($clauses, $limit);
        $rawResults = $this->execute($qb);
        return $this->getSerializer()->unserialize($rawResults);
    }

}