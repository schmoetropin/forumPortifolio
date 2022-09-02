<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class LikeModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'likes';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'liked_by', 'in_topic', 'in_post'
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