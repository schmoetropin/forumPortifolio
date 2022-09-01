<?php
declare(strict_types=1);

namespace Src\Core;

class ConfigurableRoutePath
{
    /**
     * @var Query
     */
    private Query $query;

    private const TABLE_NAME = 'information_schema.tables';

    public function __construct()
    {
        $this->query = new Query();
        $this->query->tableName = self::TABLE_NAME;
    }

    /**
     * @param string $table
     * @param string $column
     * @return bool
     */
    public function configurablePath(string $table, string $column): bool
    {
        if ($this->checkIfTableExists($table)) {
            $this->query->tableName = $table;
            $this->query->select(['unique_name'])
                ->where(['unique_name' => $column]);
            if ($this->query->getRowCount() > 0) {
                $this->query->tableName = self::TABLE_NAME;
                return true;
            }
            $this->query->tableName = self::TABLE_NAME;
            return false;
        }
        return false;
    }

    /**
     * @param string $table
     * @return bool
     */
    private function checkIfTableExists(string $table): bool
    {
        $this->query->select(['*'])
            ->where([
                'table_schema' => $this->query->getDbName(),
                'table_name' => $table
            ]);
        if($this->query->getRowCount() > 0){
            return true;
        }
        return false;
    }
}