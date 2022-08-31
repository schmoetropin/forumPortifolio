<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class CommunityEditDescriptionRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $txtaEditarDescricao = '';
    public string $comunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'txtaEditarDescricao' => ['required', 'min:4', 'max:120']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'txtaEditarDescricao' => 'Descrição da comunidade'
        ];
    }
}