class Like {
    likeTopic = (e) => {
        e.preventDefault();
    }
}
let like = new Like();

if (_id('likeTopic')) {
    _id('like').addEventListener('click', (e) => {
        like.likeTopic(e);
    });
}