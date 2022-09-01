<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class UserEditEmailRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $usuario = '';
    public string $trocarEmail = '';
    public string $trocarEmail2 = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'usuario' => ['exists:unique_name-users'],
            'trocarEmail' => ['required', 'email', 'unique:email-users'],
            'trocarEmail2' => ['required', 'equals:trocarEmail']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'usuario' => 'Usuario',
            'trocarEmail' => 'Senha',
            'trocarEmail2' => 'Confirmação da Senha'
        ];
    }
}