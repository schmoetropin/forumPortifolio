<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class UserEditPictureRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $usuario = '';
    public array $trocarFotoPerfil = [];

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'usuario' => ['exists:unique_name-users'],
            'trocarFotoPerfil' => ['required_file', 'size:500000', 'extension:jpg|jpeg|png']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'usuario' => 'Usuario',
            'trocarFotoPerfil' => 'Foto de perfil'
        ];
    }
}