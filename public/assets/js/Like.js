class Like {
    likeTopic = (e) => {
        e.preventDefault();
        let form = _id('likeTopic');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                let array = xhr.responseText.split(_id('STRING_TO_ARRAY_SEPARATOR').value);
                if (array[0] === 'unlike') {
                    _cl('.likeAreaBotao').innerHTML = '<img src="'+_id('IMG').value+'blue-like.png">';
                } else {
                    _cl('.likeAreaBotao').innerHTML = '<img src="'+_id('IMG').value+'gray-like.png">';
                }
                _id('topicoNumeroLikes').innerHTML = array[1];
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/likeTopic');
        xhr.send(formData);
    }

    likePost = (e, id) => {
        e.preventDefault();
        let form = _id('likePostForm'+id);
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                let array = xhr.responseText.split(_id('STRING_TO_ARRAY_SEPARATOR').value);
                if (array[0] === 'unlike') {
                    _id('likePostButton'+id).innerHTML = '<img src="'+_id('IMG').value+'blue-like.png">';
                } else {
                    _id('likePostButton'+id).innerHTML = '<img src="'+_id('IMG').value+'gray-like.png">';
                }
                _id('numLikesPost'+id).innerHTML = array[1];
                console.log(xhr.responseText);
            }
        }
        xhr.open('post', REQ_URI+'/likePost');
        xhr.send(formData);
    }
}
let like = new Like();

if (_id('likeTopic')) {
    _id('like').addEventListener('click', (e) => {
        like.likeTopic(e);
    });
}

if (_id('likePost')) {
    _all('.postId').forEach((values) => {
        let val = values.value;
        _id('likePostButton'+val).addEventListener('click', (e) => {
            like.likePost(e, val);
        });
    });
}