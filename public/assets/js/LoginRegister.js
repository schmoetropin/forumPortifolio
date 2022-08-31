const REQ_URI = _id('REQ_URI').value;

class LoginRegister {

    register = (e) => {
        e.preventDefault();
        let form = _id('registroForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                this.displayRegisterMessage('display');
                _id('mensagemRegistro').innerHTML = xhr.responseText;
                _id('regNome').value = '';
                _id('regEmail').value = '';
                _id('regEmail2').value = '';
                _id('regSenha').value = '';
                _id('regSenha2').value = '';
            }
        }
        xhr.open('post', REQ_URI+'/register');
        xhr.send(formData);
    }

    login = (e) => {
        e.preventDefault();
        let form = _id('loginForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                if (xhr.responseText === 'User found') {
                    window.location.reload();
                } else {
                    _id('mensagemLogin').innerHTML = xhr.responseText;
                }
            }
        }
        xhr.open('post', REQ_URI+'/login');
        xhr.send(formData);
    }

    logout = () => {
        let formData = new FormData();
        formData.append('logout', 1);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                window.location.reload();
            }
        }
        xhr.open('post', REQ_URI+'/logout');
        xhr.send(formData);
    }

    displayRegisterDiv = (type) => {
        if (type === 'display') {
            _id('caixaRegistro').style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
            _cl('body').style.overflow = 'hidden';
        } else {
            _id('caixaRegistro').style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
            _cl('body').style.overflow = 'auto';
        }
    }

    displayLoginDiv = () => {
        if (_id('caixaLogin').style.display === 'block') {
            _id('caixaLogin').style.display = 'none';
        } else {
            _id('caixaLogin').style.display = 'block';
        }
    }

    displayRegisterMessage = (type) => {
        if (type === 'display') {
            _id('mensagemErroRegDiv').style.display = 'block';
            _id('fundoOpacoMensagemRegErro').style.display = 'block';
            _cl('body').style.overflow = 'hidden';
        } else {
            _id('mensagemErroRegDiv').style.display = 'none';
            _id('fundoOpacoMensagemRegErro').style.display = 'none';
            _cl('body').style.overflow = 'auto';
        }
    }
}

let logReg = new LoginRegister();

if (_id('caixaRegistro')) {
    _id('inputRegistroForm').addEventListener('click', (e) => {
        logReg.register(e);
    });

    _id('inputLoginForm').addEventListener('click', (e) => {
        logReg.login(e);
    });

    _id('botaoLogin').addEventListener('click', () => {
        logReg.displayLoginDiv();
    });

    _id('botaoRegistro').addEventListener('click', () => {
        logReg.displayRegisterDiv('display');
    });

    _id('fecharCaixaRegistro').addEventListener('click', () => {
        logReg.displayRegisterDiv('close');
    });

    _id('fecharRegistroMes').addEventListener('click', () => {
        logReg.displayRegisterMessage('close');
    });
}

if (_id('botaoLogout1')) {
    _id('botaoLogout1').addEventListener('click', () => {
        logReg.logout();
    })
}