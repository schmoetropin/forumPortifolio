class CommunityCreateDelete {

    createCommunity = (e) => {
        e.preventDefault();
        let form = _id('criarComunidadeForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () =>{
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayCreateCommunityMessage('display');
                _id('mensagemCriarComunidadeDiv').innerHTML = xhr.responseText;
                this.displayCommunities();
            }
        }
        xhr.open('post', REQ_URI+'/communityCreate');
        xhr.send(formData);
    }

    deleteCommunity = (e, id) => {
        e.preventDefault();
        let form = _id('excluirComunidade'+id);
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () =>{
            if (xhr.status === 200 && xhr.readyState === 4) {
                console.log(xhr.responseText);
                _cl('.fundoOpacoPadrao').style.display = 'none';
                this.displayCommunities();
            }
        }
        xhr.open('post', REQ_URI+'/communityDelete');
        xhr.send(formData);
    }

    displayCommunities = () => {
        let formData = new FormData();
        formData.append('displayComs', 1);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () =>{
            if (xhr.status === 200 && xhr.readyState === 4) {
                _id('indexColunaPrincipal').innerHTML = xhr.responseText;
                this.deleteCommunityAction();
            }
        }
        xhr.open('get', REQ_URI+'/displayCommunities');
        xhr.send(formData);
    }

    displayCreateCommunityBox = (type) => {
        if (type === 'display') {
            _id('caixaCriarCominidade').style.display = 'block';
            _id('fundoOpacoMensagemComunidadeErro').style.display = 'block';
            _cl('body').style.overflow = 'hidden';
        } else {
            _id('caixaCriarCominidade').style.display = 'none';
            _id('fundoOpacoMensagemComunidadeErro').style.display = 'none';
            _cl('body').style.overflow = 'auto';
        }
    }
    
    displayCreateCommunityMessage = (type) => {
        if (type === 'display') {
            _id('mensagemErroComunidadeDiv').style.display = 'block';
        } else {
            _id('mensagemErroComunidadeDiv').style.display = 'none';
        }
    }

    displayDeleteCommunityBox = (type, id) =>{
        if (type === 'display') {
            _id('messConfirmDelComunidade'+id).style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
        } else {
            _id('messConfirmDelComunidade'+id).style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
        }
    }

    deleteCommunityAction = () => {
        _all('.comunidadeId').forEach((values) => {
            let id = values.value;
    
            _id('botaoConfirmacaoDeleterComunidade'+id).addEventListener('click', (e) => {
                com.deleteCommunity(e, id);
            });
    
            _id('botaoExcluirComunidade'+id).addEventListener('click', () => {
                com.displayDeleteCommunityBox('display', id);
            });
    
            _id('fecharMessConfirmDelComunidade'+id).addEventListener('click', () => {
                com.displayDeleteCommunityBox('close', id);
            });
        });
    }
}

let com = new CommunityCreateDelete();

if (_id('botaoCriarComunidade')) {
    _id('inputCriarComunidade').addEventListener('click', (e) => {
        com.createCommunity(e);
    });

    _id('botaoCriarComunidade').addEventListener('click', () => {
        com.displayCreateCommunityBox('display');
    });

    _id('fecharCaixaCriarCominidade').addEventListener('click', () => {
        com.displayCreateCommunityBox('close');
    });

    _id('fecharCriarComunidadeMes').addEventListener('click', () => {
        com.displayCreateCommunityMessage('close');
    });
}

if (_cl('.botaoExcluirComunidade')) {
    com.deleteCommunityAction();
}