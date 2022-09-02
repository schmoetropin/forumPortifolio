<?php
declare(strict_types=1);

namespace Src\Core;

use PDO;

abstract class Model extends Connection
{
    /**
     * @var const
     */
    private const UNIQUE_NAME = 'unique_name';
    private const PREG = '/[^a-zA-Z0-9]/';
    private const EQUALS = 'equals';
    private const LIKE = 'like';

    /**
     * @var string|null
     */
    private ?string $type;

    /**
     * @var string
     */
    private string $query;

    /**
     * @var array
     */
    private array $data = [];
    
    /**
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * @return array
     */
    abstract public function tableColumns(): array;

    /**
     * @param string $name
     * @return string
     */
    public function uniqueName(string $name): string
    {
        $name = strtolower($name);
        $name = preg_replace(self::PREG, '', $name);
        $unique_name = $name;
        $this->data = [self::UNIQUE_NAME => $unique_name];
        $this->select([self::UNIQUE_NAME])->where($this->data);
        $i = 0;
        while ($this->getRowCount() > 0) {
            $unique_name = $name.$i;
            $this->data = [self::UNIQUE_NAME => $unique_name];
            $this->select([self::UNIQUE_NAME])->where($this->data);
            $i++;
        }
        return $unique_name;
    }

    /**
     * @param array $data
     * @return void
     */
    public function insert(array $data): void
    {
        $this->data = $data;
        $params = $this->params($this->data);
        $this->query = 'INSERT INTO '.$this->tableName().'('.
            implode(',', $this->tableColumns()).') VALUES ('.implode(',', $params)
            .')';
        $this->executeQuery();
    }

    /**
     * @param array $columns
     * @return self
     */
    public function select(array $columns): self
    {
        $this->query = 'SELECT '.implode(',', $columns).' FROM '.$this->tableName();
        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function update(array $data): self
    {
        $this->data = $data;
        $this->type = self::EQUALS;
        $params = $this->columnsAndParams($data);
        $this->query = 'UPDATE '.$this->tableName().' SET '.$params;
        return $this;
    }

    /**
     * @return self
     */
    public function delete(): self
    {
        $this->query = 'DELETE FROM '.$this->tableName();
        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function where(array $data): self
    {
        if (empty($this->data)) {
            $this->data = $data;
        } else {
            $this->data = array_merge($this->data, $data);
        }
        $this->type = self::EQUALS;
        $params = $this->columnsAndParams($data);
        $this->query .= ' WHERE '.$params;
        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function whereLike(array $data): self
    {
        if (empty($this->data)) {
            $this->data = $data;
        } else {
            $this->data = array_merge($this->data, $data);
        }
        $this->type = self::LIKE;
        $params = $this->columnsAndParams($data);
        $this->query .= ' WHERE '.$params;
        return $this;
    }

    /**
     * @param string $column
     * @param string $order
     * @return self
     */
    public function order(string $column, string $order): self
    {
        $this->query .= ' ORDER BY '.$column.' '.$order;
        return $this;
    }

    public function limit(int $val1, int $val2 = null): self
    {
        $this->query .= ' LIMIT '.$val1;
        if (!is_null($val2)) {
            $this->query .= ', '.$val2;
        }
        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    private function params(array $data): array
    {
        $params = [];
        
        foreach ($data as $key => $value) {
            $params[] = ':'.$key;
        }
        return $params;
    }

    /**
     * @param array $data
     * @return string
     */
    private function columnsAndParams(array $data): string
    {
        $params = '';
        $i = 1;
        $count = count($data);
        foreach ($data as $key => $value) {
            if ($this->type === self::EQUALS) {
                $params .= $key.'=:'.$key;
            } else {
                $params .= $key.' LIKE :'.$key;
            }
            if ($i < $count) {
                $params .= ' AND ';
            }
            $i++;
        }
        return $params;
    }

    /**
     * @return int|null
     */
    public function getRowCount(): int
    {
        $prepare = $this->con()->prepare($this->query);
        if (!empty($this->data)) {
            foreach ($this->data as $key => $value) {
                $prepare->bindValue(':'.$key, $value);
            }
        }
        $prepare->execute();
        $this->data = [];
        return $prepare->rowCount();
    }

    /**
     * @return void
     */
    public function executeQuery(): void
    {
        $prepare = $this->con()->prepare($this->query);
        foreach ($this->data as $key => $value) {
            $prepare->bindValue(':'.$key, $value);
        }
        $prepare->execute();
        $this->data = [];
    }

    /**
     * @return array
     */
    public function getDbData(): array
    {
        $prepare = $this->con()->prepare($this->query);
        if (!empty($this->data)) {
            foreach ($this->data as $key => $value) {
                if ($this->type === self::EQUALS) {
                    $prepare->bindValue(':'.$key, $value);
                } else {
                    $prepare->bindValue(':'.$key, '%'.$value.'%');
                }
            }
        }
        $prepare->execute();
        $dbData = [];
        $i = 0;
        while ($fetch = $prepare->fetch(PDO::FETCH_ASSOC)) {
            $dbData[$i] = $fetch;
            $i++;
        }
        $this->data = [];
        return $dbData;
    }
}