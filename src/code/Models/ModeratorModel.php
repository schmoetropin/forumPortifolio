<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class ModeratorModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'moderators';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'moderator', 'community'
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