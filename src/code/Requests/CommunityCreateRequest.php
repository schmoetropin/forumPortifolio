<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class CommunityCreateRequest extends FormValidation
{
    /**
     * @var string
     */
    public array $fotoComunidade = [];
    public string $nomeComunidade = '';
    public string $descricaoComunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'fotoComunidade' => ['required_file', 'size:4000000', 'extension:jpg|jpeg|png'],
            'nomeComunidade' => ['required', 'min:4', 'max:20'],
            'descricaoComunidade' => ['required', 'min:4', 'max:120']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'fotoComunidade' => 'Imagem da comunidade',
            'nomeComunidade' => 'Nome da comunidade',
            'descricaoComunidade' => 'Descrição da comunidade'
        ];
    }
}