<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class CommunityEditPictureRequest extends FormValidation
{
    /**
     * @var string
     */
    public array $arquivoEditarFoto = [];
    public string $comunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'arquivoEditarFoto' => ['required_file', 'size:4000000', 'extension:jpg|jpeg|png']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'arquivoEditarFoto' => 'Imagem da comunidade'
        ];
    }
}