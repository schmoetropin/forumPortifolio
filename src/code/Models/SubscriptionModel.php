<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class SubscriptionModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'subscriptions';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'user', 'community'
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