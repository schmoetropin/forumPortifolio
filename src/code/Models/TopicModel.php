<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class TopicModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'topics';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'name', 'unique_name', 'content', 'file_extension',
        'file', 'link', 'created_at', 'updated_at', 
        'created_by', 'in_community' 
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