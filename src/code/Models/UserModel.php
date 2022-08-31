<?php
declare(strict_types=1);

namespace Src\Code\Models;

use Src\Core\Model;

class UserModel extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'users';

    /**
     * @var array
     */
    private array $fillableColumns = [
        'name', 'unique_name', 'email', 
        'profile_pic', 'password', 'created_at' 
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