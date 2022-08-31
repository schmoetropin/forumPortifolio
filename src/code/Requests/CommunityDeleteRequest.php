<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class CommunityDeleteRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $comunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'comunidade' => ['exists:unique_name-communities']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'comunidade' => 'Erro comunidade'
        ];
    }
}