<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class ChatModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'chat';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'unique_name'
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