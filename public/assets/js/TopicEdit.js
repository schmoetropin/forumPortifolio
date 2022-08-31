class TopicEdit {
    displayTopicEditBox = (type) => {
        if (type === 'display') {
            _cl('.editarTopico').style.display = 'block';
            _cl('.fundoOpacoPadrao').style.display = 'block';
        } else {
            _cl('.editarTopico').style.display = 'none';
            _cl('.fundoOpacoPadrao').style.display = 'none';
        }
    }
}
let topEd = new TopicEdit();

if (_id('editarTopico')) {
    _id('editarTopico').addEventListener('click', () => {
        topEd.displayTopicEditBox('display');
    });

    _id('fecharEditarTopico').addEventListener('click', () => {
        topEd.displayTopicEditBox('close');
    });
}