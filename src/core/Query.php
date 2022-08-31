<?php
declare(strict_types=1);

namespace Src\Core;

class Query extends Model
{
    /**
     * @var string
     */
    public string $tableName;

    /**
     * @return string
     */
    public function tableName(): string
    {
        return $this->tableName;
    }

    /**
     * @return array
     */
    public function tableColumns(): array
    {
        return [];
    }
}