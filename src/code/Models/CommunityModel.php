<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class CommunityModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'communities';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'name', 'unique_name', 'description', 
        'community_picture', 'created_at', 'updated_at', 
        'created_by'
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