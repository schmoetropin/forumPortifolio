class CommunityEdit {

    editPicture = (e) => {
        e.preventDefault();
        let form = _id('trocarFotoComForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayEditCommunityMessage('display');
                this.displayUpdatedData();
                _id('mensagemEditarComunidadeDiv').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editCommunityPic');
        xhr.send(formData);
    }

    editName = (e) => {
        e.preventDefault();
        let form = _id('trocarNomeComForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayEditCommunityMessage('display');
                this.displayUpdatedData();
                _id('mensagemEditarComunidadeDiv').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editCommunityName');
        xhr.send(formData);
    }

    editDescription = (e) => {
        e.preventDefault();
        let form = _id('trocarDescricaoComForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayEditCommunityMessage('display');
                this.displayUpdatedData();
                _id('mensagemEditarComunidadeDiv').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/editCommunityDesc');
        xhr.send(formData);
    }

    displayUpdatedData = () => {
        let comunidade = _id('comunidadeNomeUnico').value;
        let formData = new FormData();
        formData.append('comunidade', comunidade);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                let array = xhr.responseText.split(_id('STRING_TO_ARRAY_SEPARATOR').value);
                _id('imagemComunidadeIMG').src = _id('UPLOAD').value+array[0];
                _id('nomeComunidade').innerHTML = array[1];
                _id('descricaoComunidadeP').innerHTML = array[2];
            }
        }
        xhr.open('post', REQ_URI+'/displayUpdatedCommunity');
        xhr.send(formData);
    }
    
    displayEditCommunityBox = (type) => {
        if (type === 'display') {
            _id('editarComunidadeCaixa').style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
        } else {
            _id('editarComunidadeCaixa').style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
        }
    }

    displayEditCommunity = (type) => {
        if (type === 'pic') {
            _id('editarFotoCaixa').style.display = 'block';
            _id('editarNomeCaixa').style.display = 'none';
            _id('editarDescricaoCaixa').style.display = 'none';
        } else if (type === 'name') {
            _id('editarFotoCaixa').style.display = 'none';
            _id('editarNomeCaixa').style.display = 'block';
            _id('editarDescricaoCaixa').style.display = 'none';
        } else {
            _id('editarFotoCaixa').style.display = 'none';
            _id('editarNomeCaixa').style.display = 'none';
            _id('editarDescricaoCaixa').style.display = 'block';
        }
    }

    displayEditCommunityMessage = (type) => {
        if (type === 'display') {
            _id('mensagemErroEditarComunidadeDiv').style.display = 'block';
            _id('fundoOpacoMensagemEditarComunidadeErro').style.display = 'block';
        } else {
            _id('mensagemErroEditarComunidadeDiv').style.display = 'none';
            _id('fundoOpacoMensagemEditarComunidadeErro').style.display = 'none';
        }
    }
}

let comE = new CommunityEdit();

if (_id('editarComunidadeCaixa')) {

    _id('trocarFotoComunidadeBotao').addEventListener('click', (e) =>{
        comE.editPicture(e);
    });

    _id('trocarNomeComunidadeBotao').addEventListener('click', (e) =>{
        comE.editName(e);
    });

    _id('trocarDescricaoComunidadeBotao').addEventListener('click', (e) =>{
        comE.editDescription(e);
    });

    _id('trocarFotoComunidade').addEventListener('click', () =>{
        comE.displayEditCommunityBox('display');
        comE.displayEditCommunity('pic');
    });

    _id('trocarNomeComunidade').addEventListener('click', () =>{
        comE.displayEditCommunityBox('display');
        comE.displayEditCommunity('name');
    });

    _id('trocarDescricaoComunidade').addEventListener('click', () =>{
        comE.displayEditCommunityBox('display');
        comE.displayEditCommunity('description');
    });

    _id('trocarDescricaoComunidade2').addEventListener('click', () =>{
        comE.displayEditCommunityBox('display');
        comE.displayEditCommunity('description');
    });

    _id('fecharEditarComunidadeCaixa').addEventListener('click', () =>{
        comE.displayEditCommunityBox('close');
    });

    _id('fecharEditarComunidadeMes').addEventListener('click', () =>{
        comE.displayEditCommunityMessage('close');
    });
}