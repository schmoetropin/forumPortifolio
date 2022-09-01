<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class PostModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'posts';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'content', 'created_at', 'updated_at', 
        'created_by', 'in_topic', 'in_community'
    ];

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
        return $this->fillableColumns;
    }
}