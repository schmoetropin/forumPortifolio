<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class TopicCreateRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $tituloTopico = '';
    public string $conteudoTopico = '';
    public array $topicoUpload = [];
    public string $topicoArquivoRadio = '';
    public string $topicoComunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'tituloTopico' => ['required', 'min:4', 'max:60'],
            'conteudoTopico' => ['required', 'min:4'],
            'topicoUpload' => ['size:4000000', 'extension:jpg|jpeg|png|gif|mp4'],
            'topicoArquivoRadio' => ['required', 'exact:upload|linkVideo|nenhum'],
            'topicoComunidade' => ['exists:unique_name-communities']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'tituloTopico' => 'Titulo do tópico',
            'conteudoTopico' => 'Conteúdo do tópico',
            'topicoUpload' => 'Arquivo do tópico',
            'topicoArquivoRadio' => 'Opção de mídia',
            'topicoComunidade' => 'Erro comunidade'
        ];
    }
}