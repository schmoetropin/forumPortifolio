<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class CommunityEditNameRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $inputEditarNome = '';
    public string $comunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'inputEditarNome' => ['required', 'min:4', 'max:20']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'inputEditarNome' => 'Nome da comunidade'
        ];
    }
}