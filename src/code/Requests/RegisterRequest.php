<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class RegisterRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $regNome = '';
    public string $regEmail = '';
    public string $regEmail2 = '';
    public string $regSenha = '';
    public string $regSenha2 = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'regNome' => ['required', 'min:4', 'max:20'],
            'regEmail' => ['required', 'email', 'unique:email-users'],
            'regEmail2' => ['required', 'equals:regEmail'],
            'regSenha' => ['required', 'min:6', 'max:30'],
            'regSenha2' => ['required', 'equals:regSenha']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'regNome' => 'Nome de usuario',
            'regEmail' => 'Email',
            'regEmail2' => 'Confirmação do email',
            'regSenha' => 'Senha',
            'regSenha2' => 'Confirmação da senha'
        ];
    }
}