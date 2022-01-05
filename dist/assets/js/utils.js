const store = new Vuex.Store({ //global store
  state: { //類似 new Vue() 裡面的data
    memberId: null,
    memberCurrentPoint: null,
    isLoginModalShow: false,
    seriesList: [{
      name: '工程系',
      eName: 'EN',
    }, {
      name: 'RV休旅系',
      eName: 'RV',
    }, {
      name: '計程車系',
      eName: 'TA',
    }, {
      name: '巴士系',
      eName: 'BS',
    }, {
      name: '警車系',
      eName: 'PA',
    }, {
      name: '消防救護系',
      eName: 'EM',
    }, {
      name: '轎車系',
      eName: 'CA',
    }, {
      name: 'PREMIUM系',
      eName: 'PM',
    }],
    //cart購物車 store 
    buyList: [],
    totalProductNum: null,
    totalPointCost: null,
    selectCoupon: " ",
    selectPayment: " ",
    selectShipping: " ",
    finallyPrice: 0,
    discountPrice: 0,
    sendPrice: 0,
    totalMoney: 0,
    getPoints: 0,

  },
  mutations: { //類似 new Vue() 裡面的methods

    setMemberId(state, id) {
      state.memberId = id;
    },
    setLoginModalShow(state, order) {
      state.isLoginModalShow = order;
    },
    testVueXConnect() {
      console.log('connecting')
    },
    setMemberPoint(state, point) {
      state.memberCurrentPoint = point;
    },
    //cart購物車 store 

    //訂單比數跟詳細資料
    addBuyList(state, val) {
      state.buyList = val;
    },
    addTotalPointCost(state, val) {
      state.totalPointCost = val;
    },
    // 購買商品比數
    addBuyNum(state, val) {
      state.totalProductNum = val;
    },
    // 選擇的折價卷
    selectCoupon(state, val) {
      state.selectCoupon = val;
    },
    //選擇的付費方法
    selectPayment(state, val) {
      state.selectPayment = val;
    },
    //選擇的運送方式
    selectShipping(state, val) {
      state.selectShipping = val;
    },
    // 最後的價格
    addFinalPrice(state, val) {
      state.finallyPrice = val;
    },
    // 折扣金額
    addDiscountPrice(state, val) {
      state.discountPrice = val;
    },
    // 運費
    addSendPrice(state, val) {
      state.sendPrice = val;
    }, //totalprice
    addTotalMoney(state, val) {
      state.totalMoney = val;
    }, //獲得點數
    addGetPoints(state, val) {
      state.getPoints = val;
    },


  }
});