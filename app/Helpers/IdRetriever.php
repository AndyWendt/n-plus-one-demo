<?php
namespace App\Helpers;

use Carbon\Carbon;
use RuntimeException;

class IdRetriever
{
    protected $classOrTable;

    /**
     * @param string $class
     * @param int    $count
     * @param bool   $exactCountMustBeReturned
     *
     * @return \Illuminate\Support\Collection|int
     */
    public function randomModelId($class, $count = 1, $exactCountMustBeReturned = true)
    {
        $this->classOrTable = $class;
        $query = $class::orderBy(\DB::raw('RAND()'));

        return $this->queryForIds($query, $count, $exactCountMustBeReturned);
    }

    public function randomTableId($table, $count = 1, $exactCountMustBeReturned = true)
    {
        $this->classOrTable = $table;
        $query = \DB::table($table)->orderBy(\DB::raw('RAND()'));

        return $this->queryForIds($query, $count, $exactCountMustBeReturned);
    }

    /**
     * @param string $relationClass
     * @param string $table
     * @param int    $failures
     *
     * @return array  ['ancestor' => $ancestorId, 'descendant' => $descendantId];
     */
    public function randomIdsFromRelationForClosureTable($relationClass, $table, $failures = 0)
    {
        if ($failures > 10) {
            throw new \RuntimeException('could not find ids for closure table');
        }

        $ancestorId = $this->randomModelId($relationClass);
        $descendantId = $this->randomModelId($relationClass);

        if (false === $this->idsCanBeAddedToClosureTable($table, $ancestorId, $descendantId)) {
            return $this->randomIdsFromRelationForClosureTable($relationClass, $table, ++$failures);
        };

        return ['ancestor' => $ancestorId, 'descendant' => $descendantId];
    }

    /**
     * @param $table
     * @param $ancestorId
     * @param $descendantId
     */
    protected function closureTableInsert($table, $ancestorId, $descendantId)
    {
        return \DB::table($table)->insert(
            [
                'ancestor'   => $ancestorId,
                'descendant' => $descendantId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }

    /**
     * @param $table
     * @param $ancestorId
     *
     * @param $descendantId
     *
     * @return bool
     */
    protected function idsArePresentInClosureTable($table, $ancestorId, $descendantId)
    {
        return (bool)\DB::table($table)->where('ancestor', $ancestorId)->where('descendant', $descendantId)->count();
    }

    /**
     * @param $table
     * @param $ancestorId
     * @param $descendantId
     *
     * @return bool
     */
    protected function idsCanBeAddedToClosureTable($table, $ancestorId, $descendantId)
    {
        if ($ancestorId === $descendantId) {
            return false;
        }

        $idsCanBeAdded = !(bool)\DB::table($table)->where(function ($query) use ($ancestorId, $descendantId) {
            $query->where('ancestor', $ancestorId)->where('descendant', $descendantId);
        }
        )->orWhere(function ($query) use ($ancestorId, $descendantId) {
            $query->where('ancestor', $descendantId)->where('descendant', $ancestorId);
        }
        )->count();

        if ($idsCanBeAdded) {
            if (false === $this->idsArePresentInClosureTable($table, $ancestorId, $ancestorId)) {
                $this->closureTableInsert($table, $ancestorId, $ancestorId);
            }

            if (false === $this->idsArePresentInClosureTable($table, $descendantId, $descendantId)) {
                $this->closureTableInsert($table, $descendantId, $descendantId);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $query
     *
     * @param $count
     * @param $exactCountMustBeReturned
     *
     * @return \Illuminate\Support\Collection
     */
    protected function queryForIds($query, $count, $exactCountMustBeReturned)
    {
        if ($count === 1) {
            return $this->retrieveSingleId($query);
        }

        return $this->retrieveMultipleIds($count, $exactCountMustBeReturned, $query);
    }

    /**
     * @param $count
     * @param $exactCountMustBeReturned
     * @param $query
     *
     * @return \Illuminate\Support\Collection
     */
    protected function retrieveMultipleIds($count, $exactCountMustBeReturned, $query)
    {
        /** @var \Illuminate\Support\Collection $collection */
        $collection = $query->take($count)->lists('id');

        if ($exactCountMustBeReturned && $collection->count() != $count) {
            throw new RuntimeException('Retrieval of ids did not return the correct count');
        }

        return $collection;
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    protected function retrieveSingleId($query)
    {
        $result = $query->pluck('id');
        if ($result === null) {
            throw new RuntimeException($this->classOrTable . ' Model id not found');
        }

        return $result;
    }
}
