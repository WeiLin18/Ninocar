const seriesNames = {
    BS: '巴士系',
    EN: '工程系',
    TA: '計程車系',
    EM: '消防救護系',
    PM: 'PREMIUM系',
    PA: '警車系',
    RV: 'RV休旅系',
    CA: '轎車系'
};

export function sayHi(name){
    const btn = document.getElementById('modal_btn');
    const message = 'hello';
    btn.addEventListener('click', () => {
        alert(`${message} ${name}`);
    })
}

