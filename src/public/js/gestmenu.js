'use strict';
{
    const open = document.getElementById('gestMenu');
    const container = document.getElementById('gestContainer');
    const bg = document.getElementById('menuBg');
    const close = document.getElementById('close');

    open.addEventListener('click',()=>{
        container.classList.add('active');
        bg.classList.add('active');
        close.classList.add('active');
    });

    close.addEventListener('click',()=>{
        container.classList.remove('active');
        bg.classList.remove('active');
        close.classList.remove('active');
    });
}