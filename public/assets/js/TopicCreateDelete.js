class TopicCreateDelete {

    createTopic = (e) => {
        e.preventDefault();
        let form = _id('postarTopicoForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayMessageCreateTopic('display');
                this.displayTopics();
                _id('mensagemPostarTopicoDiv').innerHTML = xhr.responseText;
                if (xhr.responseText === 'Topico criado') {
                    _id('tituloTopico').value = '';
                    _id('conteudoTopico').value = '';
                    _id('topicoUpload').value = '';
                    _id('topicoLink').value = '';
                }
            }
        }
        xhr.open('post', REQ_URI+'/createTopic');
        xhr.send(formData);
    }

    deleteTopic = (e, id) => {
        e.preventDefault();
        let form = _id('deletarTopicoForm'+id);
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            this.displayTopics();
            this.displayDeleteTopicBox('close');
            console.log(xhr.responseText);
        }
        xhr.open('post', REQ_URI+'/deleteTopic');
        xhr.send(formData);
    }

    displayTopics = () => {
        let formData = new FormData();
        formData.append('comunidade', _id('comunidadeNomeUnico').value);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            _cl('.areaTopicos').innerHTML = xhr.responseText;
            this.deleteTopicAction();
        }
        xhr.open('post', REQ_URI+'/displayTopics');
        xhr.send(formData);
    }

    deleteTopicAction = () => {
        _all('.topicoId').forEach((values) => {
            let val = values.value;
    
            _id('botaoDeletarTopico'+val).addEventListener('click', (e) => {
                topic.deleteTopic(e, val);
            });
    
            _id('deletarTopico'+val).addEventListener('click', () => {
                topic.displayDeleteTopicBox('display', val);
            });
    
            _id('fecharDelTopicoCaixa'+val).addEventListener('click', () => {
                topic.displayDeleteTopicBox('close', val);
            });
        });
    }
    
    displayCreateTopicBox = (type) => {
        if (type === 'display') {
            _id('criarTopicoCaixa').style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
            _cl('body').style.overflow = 'hidden';
        } else {
            _id('criarTopicoCaixa').style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
            _cl('body').style.overflow = 'auto';
        }
    }

    changeMidiaType = (type) => {
        if (type === 'upload') {
            _id('topicoUpload').style.display = 'block';
            _id('topicoLink').style.display = 'none';
        } else if (type === 'linkVideo') {
            _id('topicoUpload').style.display = 'none';
            _id('topicoLink').style.display = 'block';
        } else {
            _id('topicoUpload').style.display = 'none';
            _id('topicoLink').style.display = 'none';
        }
    }

    displayMessageCreateTopic = (type) => {
        if (type === 'display') {
            _id('mensagemErroDivCriarTopico').style.display = 'block';
            _id('fundoOpacoMensagemErroCriarTopico').style.display = 'block';
        } else {    
            _id('mensagemErroDivCriarTopico').style.display = 'none';
            _id('fundoOpacoMensagemErroCriarTopico').style.display = 'none';
        }
    }

    displayDeleteTopicBox = (type, id) => {
        if (type === 'display') {
            _id('delTopicoCaixa'+id).style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
        } else {    
            _id('delTopicoCaixa'+id).style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
        }
    }
}

let topic = new TopicCreateDelete();

if (_id('criarTopicoCaixa')) {
    _id('postarTopico').addEventListener('click', (e) => {
        topic.createTopic(e);
    });

    _id('botaoCriarTopicoDe').addEventListener('click', () => {
        topic.displayCreateTopicBox('display');
    });

    _id('fecharCriarTopicoCaixa').addEventListener('click', () => {
        topic.displayCreateTopicBox('close');
    });

    _all('.topicoArquivoRadio').forEach((values) => {
        let id = values.id;
        let value = values.value;
        _id(id).addEventListener('click', () => {
            topic.changeMidiaType(value);
        });
    });

    _id('fecharCriarTopMes').addEventListener('click', () => {
        topic.displayMessageCreateTopic('close');
    });
}

if (_id('deletarTopicoComunidade')) {
    topic.deleteTopicAction();
}