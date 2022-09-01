<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class UserEditPasswordRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $usuario = '';
    public string $trocarSenha = '';
    public string $trocarSenha2 = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'usuario' => ['exists:unique_name-users'],
            'trocarSenha' => ['required', 'min:6', 'max:30'],
            'trocarSenha2' => ['required', 'equals:regSenha']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'usuario' => 'Usuario',
            'trocarSenha' => 'Senha',
            'trocarSenha2' => 'Confirmação da senha'
        ];
    }
}