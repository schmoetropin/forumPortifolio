<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class UserEditNameRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $usuario = '';
    public string $trocarNome = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'usuario' => ['exists:unique_name-users'],
            'trocarNome' => ['required', 'min:4', 'max:20']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'usuario' => 'Usuario',
            'trocarNome' => 'Nome de usuario'
        ];
    }
}