// $(document).ready(function(){
//     console.log('恭喜可以寫JQ囉');
// });

// var ary = [];
// for (let i = 0; i < 30; i++) {
//     ary.push((i + 1).toString());
// }
// //console.log(ary);

// function showBtn() {
//     var page = document.querySelector('.page_btn_nb');

//     if (page) {
//         var btnNum = Math.ceil(ary.length / 10);
//         console.log(btnNum);

//         var str = '';
//         for (var i = 0; i < btnNum; i++) {
//             str += `<span>${i + 1}</span>`;
//         }
//         page.innerHTML = str;

//         //監聽按鈕
//         var btn = document.querySelectorAll('.page span');
//         for (var i = 0; i < btn.length; i++) {
//             btn[i].addEventListener('click', changePage.bind(this, i + 1, ary));
//         }
//     }
// }

// showBtn();

// function changePage(page, data) {
//     var item = 10;
//     var pageIndexStart = (page - 1) * item;
//     var pageIndexEnd = page * item;
//     var str = '';
//     for (var i = pageIndexStart; i < pageIndexEnd; i++) {
//         if (i >= data.length) {
//             break;
//         }
//         str += `<div class="card">${data[i]}</div}`;
//     }
//     document.querySelector('.card').innerHTML = str;
// }
