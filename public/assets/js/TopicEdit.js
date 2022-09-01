class TopicEdit {
    editName = (e) => {
        e.preventDefault();
        let form = _id('editarTituloTopico');
        let formData =  new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayTopic();
                this.displayTopicEditMessage('display');
                _id('editarTopicoMensagem').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editTopicName');
        xhr.send(formData);
    }

    editMedia = (e) => {
        e.preventDefault();
        let form = _id('editarMidiaTopico');
        let formData =  new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayTopic();
                this.displayTopicEditMessage('display');
                _id('editarTopicoMensagem').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editTopicMedia');
        xhr.send(formData);
    }

    editContent = (e) => {
        e.preventDefault();
        let form = _id('editarConteudoTopico');
        let formData =  new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayTopic();
                this.displayTopicEditMessage('display');
                _id('editarTopicoMensagem').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editTopicContent');
        xhr.send(formData);
    }

    displayTopic = () => {
        let formData =  new FormData();
        formData.append('topic', _id('noTopico').value);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                _id('exibirTopicoPricipal').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/displayTopic');
        xhr.send(formData);
    }

    displayTopicEditBox = (type) => {
        if (type === 'display') {
            _cl('.editarTopico').style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
        } else {
            _cl('.editarTopico').style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
        }
    }

    displayTopicEditMessage = (type) => {
        if (type === 'display') {
            _id('mensagemErroDivEditarTopico').style.display = 'block';
            _id('fundoOpacoMensagemErroEditarTopico').style.display = 'block';
        } else {
            _id('mensagemErroDivEditarTopico').style.display = 'none';
            _id('fundoOpacoMensagemErroEditarTopico').style.display = 'none';
        }
    }
}
let topEd = new TopicEdit();

if (_id('editarTopico')) {
    _id('editarTituloTopicoBotao').addEventListener('click', (e) => {
        topEd.editName(e);
    });

    _id('editarMidiaTopicoBotao').addEventListener('click', (e) => {
        topEd.editMedia(e);
    });

    _id('editarConteudoTopicoBotao').addEventListener('click', (e) => {
        topEd.editContent(e);
    });

    _id('editarTopico').addEventListener('click', () => {
        topEd.displayTopicEditBox('display');
    });

    _id('fecharEditarTopico').addEventListener('click', () => {
        topEd.displayTopicEditBox('close');
    });

    _id('fecharEditarTopicoMes').addEventListener('click', () => {
        topEd.displayTopicEditMessage('close');
    });
}