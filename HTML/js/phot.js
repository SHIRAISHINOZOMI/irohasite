let album=[
    {src: '../assets/img/menu/irohaactive.jpg', msg:'いつもの活動'},
    {src: '../assets/img/menu/irohamenuhanami.jpg', msg:'花見'},
    {src: '../assets/img/menu/irohamenu4.jpg', msg:'ブドウ狩り'},
    {src: '../assets/img/menu/irohaocean.jpg', msg:'海'},
    {src: '../assets/img/menu/irohamenupresen.jpg', msg:'presentation'},
    {src: '../assets/img/menu/irohamenu3.jpg', msg:'BBQ'},
];


let mainImage =document.createElement('img');
mainImage.setAttribute('src', album[0].src);
mainImage.setAttribute('alt', album[0].msg);


let mainMsg = document.createElement('p');
mainMsg.innerText = mainImage.alt;

let mainFlame = document.querySelector('#gallery .main');
mainFlame.insertBefore(mainImage, null);
mainFlame.insertBefore(mainMsg, null);

let thumbFlame = document.querySelector('#gallery .thumb');
for(let i = 0; i< album.length; i++){
    let thumbImage = document.createElement('img');
    thumbImage.setAttribute('src', album[i].src);
    thumbImage.setAttribute('alt', album[i].msg);
    thumbFlame.insertBefore(thumbImage, null);
}

thumbFlame.addEventListener('click', function(event){
    if(event.target.src){
        mainImage.src = event.target.src;
        mainMsg.innerText = event.target.alt;
    }
});

