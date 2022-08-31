class Subscription {
    subscribe = (e) => {
        e.preventDefault();
        let form = _id('inscreverForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.status === 200 && xhr.readyState === 4) {
                let array = xhr.responseText.split(_id('STRING_TO_ARRAY_SEPARATOR').value);
                _id('areaInscricao2').innerHTML = array[0];
                _id('areaInscricao').innerHTML = array[1];
                this.clickSubscribe();
            }
        }
        xhr.open('post', REQ_URI+'/subscribe');
        xhr.send(formData);
    }

    clickSubscribe = () => {
        _all('.inscreverComunidadeBotao').forEach((values) => {
            let id = values.id;
            _id(id).addEventListener('click', (e) => {
                subs.subscribe(e);
            });
        });
    }
}
let subs = new Subscription();

if (_id('inscreverComunidadeBotao')) {

    subs.clickSubscribe();    
}