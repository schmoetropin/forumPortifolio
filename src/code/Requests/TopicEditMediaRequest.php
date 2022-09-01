<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class TopicEditMediaRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $topPagId = '';
    public array $editarArquivo = [];
    public string $topArqRadio = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'topPagId' => ['exists:unique_name-topics'],
            'editarArquivo' => ['size:4000000', 'extension:jpg|jpeg|png|gif|mp4'],
            'topArqRadio' => ['required', 'exact:upload|linkVideo|nenhum|manter']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'topPagId' => 'Tópico não existe',
            'editarArquivo' => 'Arquivo do tópico',
            'topArqRadio' => 'Opção de mídia'
        ];
    }
}