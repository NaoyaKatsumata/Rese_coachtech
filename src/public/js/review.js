'use strict';
{
    const star1 = document.getElementById('star1');
    const star2 = document.getElementById('star2');
    const star3 = document.getElementById('star3');
    const star4 = document.getElementById('star4');
    const star5 = document.getElementById('star5');
    let review = document.getElementById('review');

    star1.addEventListener('click',()=>{
        star1.src="../img/star_yellow.svg";
        star2.src="../img/star_gray.svg";
        star3.src="../img/star_gray.svg";
        star4.src="../img/star_gray.svg";
        star5.src="../img/star_gray.svg";
        review.value = 1;
        console.log(review.value);
    });
    star2.addEventListener('click',()=>{
        star1.src="../img/star_yellow.svg";
        star2.src="../img/star_yellow.svg";
        star3.src="../img/star_gray.svg";
        star4.src="../img/star_gray.svg";
        star5.src="../img/star_gray.svg";
        review.value = 2;
        console.log(review.value);
    });
    star3.addEventListener('click',()=>{
        star1.src="../img/star_yellow.svg";
        star2.src="../img/star_yellow.svg";
        star3.src="../img/star_yellow.svg";
        star4.src="../img/star_gray.svg";
        star5.src="../img/star_gray.svg";
        review.value = 3;
        console.log(review.value);
    });
    star4.addEventListener('click',()=>{
        star1.src="../img/star_yellow.svg";
        star2.src="../img/star_yellow.svg";
        star3.src="../img/star_yellow.svg";
        star4.src="../img/star_yellow.svg";
        star5.src="../img/star_gray.svg";
        review.value = 4;
        console.log(review.value);
    });
    star5.addEventListener('click',()=>{
        star1.src="../img/star_yellow.svg";
        star2.src="../img/star_yellow.svg";
        star3.src="../img/star_yellow.svg";
        star4.src="../img/star_yellow.svg";
        star5.src="../img/star_yellow.svg";
        review.value = 5;
        console.log(review.value);
    });
}