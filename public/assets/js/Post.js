class Post {
    createPost = (e) => {
        e.preventDefault();
        let form = _id('postForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if(xhr.status === 200 && xhr.readyState === 4) {
                this.displayPostMessage('display');
                _id('mensagemPostDiv').innerHTML = xhr.responseText;
                this.displayPosts();
            }
        }
        xhr.open('post', REQ_URI+'/createPost');
        xhr.send(formData);
    }

    displayPosts = () => {
        let formData = new FormData();
        formData.append('topic', _id('noTopico').value);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if(xhr.status === 200 && xhr.readyState === 4) {
                _cl('.postArea').innerHTML = xhr.responseText;
            }
        }
        xhr.open('post', REQ_URI+'/displayPost');
        xhr.send(formData);
    }

    displayPostMessage = (type) => {
        if (type === 'display') {
            _id('mensagemErroPostDiv').style.display = 'block';
            _id('fundoOpacoMensagemPost').style.display = 'block';
        } else {
            _id('mensagemErroPostDiv').style.display = 'none';
            _id('fundoOpacoMensagemPost').style.display = 'none';
        }
    }

    displayEditPost = (type, id) => {
        if (type === 'display') {
            _id('editPost'+id).style.display = 'block';
            _id('fundoOpacoMensagemPost').style.display = 'block';
        } else {
            _id('editPost'+id).style.display = 'none';
            _id('fundoOpacoMensagemPost').style.display = 'none';
        }
    }

    displayDeletePost = (type, id) => {
        if (type === 'display') {
            _id('delPost'+id).style.display = 'block';
            _id('fundoOpacoMensagemPost').style.display = 'block';
        } else {
            _id('delPost'+id).style.display = 'none';
            _id('fundoOpacoMensagemPost').style.display = 'none';
        }
    }
}
let pos = new Post();

if (_id('postarComentario')) {
    _id('postarComentario').addEventListener('click', (e) => {
        pos.createPost(e);
    });

    _id('fecharPostMes').addEventListener('click', (e) => {
        pos.displayPostMessage('close');
    });
}

if (_cl('.delEditPost')) {
    _all('.postId').forEach((values) => {
        let val = values.value;
        _id('editPostBotao'+val).addEventListener('click', () => {
            pos.displayEditPost('display', val);
        });

        _id('fecharEditPost'+val).addEventListener('click', () => {
            pos.displayEditPost('close', val);
        });

        _id('delPostBotao'+val).addEventListener('click', () => {
            pos.displayDeletePost('display', val);
        });

        _id('fecharDelPost'+val).addEventListener('click', () => {
            pos.displayDeletePost('close', val);
        });
    });
}