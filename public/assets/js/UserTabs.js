class UserTabs {
    displayTabContent = (value) => {
        this.hideTabsHr();
        this.hideTabsLr();
        this.hideContent();
        if (value === 'sobre') {
            _id('btSobre').style.backgroundColor = '#1A237E';
            _id('brSobre').style.backgroundColor = '#1A237E';
            _cl('.cSobre').style.display = 'block';
        } else if (value === 'topicos') {
            _id('btTopicos').style.backgroundColor = '#1A237E';
            _id('brTopicos').style.backgroundColor = '#1A237E';
            _cl('.cTopicos').style.display = 'block';
        } else if (value === 'posts') {
            _id('btPosts').style.backgroundColor = '#1A237E';
            _id('brPosts').style.backgroundColor = '#1A237E';
            _cl('.cPosts').style.display = 'block';
        } else if (value === 'amigos'){
            _id('btAmigos').style.backgroundColor = '#1A237E';
            _id('brAmigos').style.backgroundColor = '#1A237E';
            _cl('.cAmigos').style.display = 'block';
        } else if (value === 'mensagens') {
            _id('btMensagens').style.backgroundColor = '#1A237E';
            _id('brMensagens').style.backgroundColor = '#1A237E';
            _cl('.cMensagens').style.display = 'block';
        } else {
            _id('btRequerimento').style.backgroundColor = '#1A237E';
            _id('brRequerimento').style.backgroundColor = '#1A237E';
            _cl('.cRequerimento').style.display = 'block';
        }
    }

    hideTabsHr = () => {
        _id('btSobre').style.backgroundColor = '';
        _id('btTopicos').style.backgroundColor = '';
        _id('btPosts').style.backgroundColor = '';
        _id('btAmigos').style.backgroundColor = '';
        _id('btMensagens').style.backgroundColor = '';
        _id('btRequerimento').style.backgroundColor = '';
    }

    hideTabsLr = () => {
        _id('brSobre').style.backgroundColor = '';
        _id('brTopicos').style.backgroundColor = '';
        _id('brPosts').style.backgroundColor = '';
        _id('brAmigos').style.backgroundColor = '';
        _id('brMensagens').style.backgroundColor = '';
        _id('brRequerimento').style.backgroundColor = '';
    }

    hideContent = () => {
        _cl('.cSobre').style.display = 'none';
        _cl('.cPosts').style.display = 'none';
        _cl('.cTopicos').style.display = 'none';
        _cl('.cAmigos').style.display = 'none';
        _cl('.cMensagens').style.display = 'none';
        _cl('.cRequerimento').style.display = 'none';
    }

    displayLowResMenu = () => {
        if (_id('baixResMenu').style.display === 'block') {
            _id('baixResMenu').style.display = 'none';
        } else {
            _id('baixResMenu').style.display = 'block';
        }
    }
}
let prof = new UserTabs();

if (_id('btSobre')) {
    prof.displayTabContent('posts');

    // High res
    _id('btSobre').addEventListener('click', () => {
        prof.displayTabContent('sobre');
    });

    _id('btTopicos').addEventListener('click', () => {
        prof.displayTabContent('topicos');
    });

    _id('btPosts').addEventListener('click', () => {
        prof.displayTabContent('posts');
    });

    _id('btAmigos').addEventListener('click', () => {
        prof.displayTabContent('amigos');
    });

    _id('btMensagens').addEventListener('click', () => {
        prof.displayTabContent('mensagens');
    });

    _id('btRequerimento').addEventListener('click', () => {
        prof.displayTabContent('requerimento');
    });

    // Low res
    _id('brSobre').addEventListener('click', () => {
        prof.displayTabContent('sobre');
    });

    _id('brTopicos').addEventListener('click', () => {
        prof.displayTabContent('topicos');
    });

    _id('brPosts').addEventListener('click', () => {
        prof.displayTabContent('posts');
    });

    _id('brAmigos').addEventListener('click', () => {
        prof.displayTabContent('amigos');
    });

    _id('brMensagens').addEventListener('click', () => {
        prof.displayTabContent('mensagens');
    });

    _id('brRequerimento').addEventListener('click', () => {
        prof.displayTabContent('requerimento');
    });

    // Low res menu
    _id('baixResBotao').addEventListener('click', () => {
        prof.displayLowResMenu();
    });
}