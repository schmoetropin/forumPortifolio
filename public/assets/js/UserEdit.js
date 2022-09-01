class UserEdit {
    editName = (e) => {
        e.preventDefault();
        let form = _id('trocarNomeForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/editUserName');
        xhr.send(formData);
    }

    editEmail = (e) => {
        e.preventDefault();
        let form = _id('trocarEmailForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/editUserEmail');
        xhr.send(formData);
    }

    editPic = (e) => {
        e.preventDefault();
        let form = _id('trocarFotoPerfilForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/editUserPic');
        xhr.send(formData);
    }

    editPass = (e) => {
        e.preventDefault();
        let form = _id('trocarSenhaForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/editUserPass');
        xhr.send(formData);
    }

    displayEditUserBox = () => {
        if (_cl('.editarPerfilCaixa').style.display === 'block') {
            _cl('.editarPerfilCaixa').style.display = 'none'
        } else {
            _cl('.editarPerfilCaixa').style.display = 'block'
        }
    }
}
let usEd = new UserEdit();

if (_id('botaoEditarPerfilCaixa')) {

    _id('trocarFotoPerfilBotao').addEventListener('click', (e) => {
        usEd.editPic(e);
    });

    _id('trocarNomeBotao').addEventListener('click', (e) => {
        usEd.editName(e);
    });

    _id('trocarEmailBotao').addEventListener('click', (e) => {
        usEd.editEmail(e);
    });

    _id('trocarSenhaBotao').addEventListener('click', (e) => {
        usEd.editPass(e);
    });
    
    _id('botaoEditarPerfilCaixa').addEventListener('click', () => {
        usEd.displayEditUserBox();
    });
}