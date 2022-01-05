let productMixins = {
  data() {
    return {
      productList: [],
      myProductIdList: [],
      showProductList: [],
      keywordText: '',
      targetProduct: {},
    };
  },
  watch: {
    memberId(val) {
      if (val) {
        this.handleGetMemberOwnProductIdList();
      } else {
        //若登出，更新myProductIdList
        this.myProductIdList.splice(0);
      }
    },
  },
  computed: {
    memberSeriesGroupCountList() {
      //搭配isMemberHasSeriesPin // pin-svg :disabled使用//
      if (this.myProductList.length === 0) {
        return [];
      } else {
        //先把過濾成只剩系列名
        const seriesList = this.myProductList.map((product) => product.series);
        //每系列擁有的個數，若是各一種的徽章，最多為１
        const RVCount = seriesList.filter((series) => series === 'RV').length >= 1 ? 1 : 0;
        const BSCount = seriesList.filter((series) => series === 'BS').length >= 1 ? 1 : 0;
        const PACount = seriesList.filter((series) => series === 'PA').length >= 1 ? 1 : 0;
        const CACount = seriesList.filter((series) => series === 'CA').length >= 1 ? 1 : 0;
        const EMCount = seriesList.filter((series) => series === 'EM').length;
        const PMCount = seriesList.filter((series) => series === 'PM').length;
        const TACount = seriesList.filter((series) => series === 'TA').length;
        const ENCount = seriesList.filter((series) => series === 'EN').length;

        return [{
            name: 'RV',
            count: RVCount + BSCount,
          },
          {
            name: 'BS',
            count: RVCount + BSCount,
          },
          {
            name: 'PA',
            count: PACount + CACount,
          },
          {
            name: 'CA',
            count: PACount + CACount,
          },
          {
            name: 'EM',
            count: EMCount > 3 ? 3 : EMCount,
          },
          {
            name: 'PM',
            count: PMCount > 3 ? 3 : PMCount,
          },
          {
            name: 'TA',
            count: TACount > 3 ? 3 : TACount,
          },
          {
            name: 'EN',
            count: ENCount > 3 ? 3 : ENCount,
          },
        ];
      }
    },
    limitLabel() {
      if (this.targetProduct.limitLabel === '2') {
        return {
          text: '期間限定',
          className: 'badge badge--primary',
        };
      } else if (this.targetProduct.limitLabel === '4') {
        return {
          text: '點數限定',
          className: 'badge bg-blue',
        };
      } else {
        return null;
      }
    },
    myProductList() {
      if (this.productList && this.myProductIdList) {
        return this.productList.filter((product) => this.myProductIdList.indexOf(product.productId) >= 0);
      } else {
        return [];
      }
    },
  },
  methods: {
    bgClass(productSeries) {
      return `bg-series-${productSeries}`;
    },
    pinClass(productId) {
      return this.myProductIdList.indexOf(productId) >= 0 ? 'pin' : 'pin pin--disabled';
    },
    isMemberHasPin(productId) {
      return this.myProductIdList.indexOf(productId) >= 0;
    },
    isMemberHasSeriesPin(productSeriesName) {
      if (this.memberSeriesGroupCountList.length === 0) {
        return false;
      }
      const series = this.memberSeriesGroupCountList.find((series) => series.name === productSeriesName);
      const doubleList = ['RV', 'BS', 'PA', 'CA']; //各一的徽章

      if (doubleList.indexOf(productSeriesName) < 0) {
        //三個以上的徽章
        return series.count >= 3;
      } else {
        //各一的徽章
        return series.count >= 2;
      }
    },
    getProductListByKeyword() {
      const filteredProductList = this.productList.filter((product) => {
        const keyword = this.keywordText.toLowerCase().trim();
        let isIncludeWord = false;
        product.name.toLowerCase().includes(keyword) ? (isIncludeWord = true) : '';
        product.eName.toLowerCase().includes(keyword) ? (isIncludeWord = true) : '';
        product.series.toLowerCase().includes(keyword) ? (isIncludeWord = true) : '';
        product.series.toLowerCase().concat(product.seriesId).includes(keyword) ? (isIncludeWord = true) : '';
        return isIncludeWord;
      });
      return filteredProductList;
    },
    handleGetMemberOwnProductIdList() {
      axios
        .post('./assets/php/getMemberOwnProductIdList.php', {
          memberId: this.memberId,
        })
        .then((res) => {
          // console.log(res);
          if (Array.isArray(res.data) && res.data != []) {
            this.myProductIdList = res.data.map((obj) => obj['product_id']);
          } else {
            // console.log(res.data)
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    const getProductList = async() => {
      const result = await axios.get(`./assets/php/getProductList.php`);
      return result;
    };
    //拿所有商品清單
    getProductList()
      .then((res) => {

        // console.log(res.data);

        const filterProductList = res.data.filter((product) => {
          return product['product_spec'] !== '5' && product['product_type'] == '0';
        });

        fetchProductList = filterProductList.map((product) => {
          // 系列數字轉名稱
          let thisSeriesIndex = parseInt(product[`product_series`]) - 1;
          thisSeriesIndex.toString();
          // 系列Id若是單位數，前面加0
          // 將字串型別轉換數值
          let thisPoints = parseInt(product['product_points']);
          let thisPrice = parseInt(product['product_price']);

          let img = product['product_img'];
          if (product['product_year'] == '2021') {
            img = `./upload/${img}`;
          } else {
            img = img;
          }

          let thisSeriesId;
          if (product[`product_seriesid`].length === 1) {
            thisSeriesId = 0 + product[`product_seriesid`];
          } else {
            thisSeriesId = product[`product_seriesid`];
          }
          return {
            name: product[`product_name`].trim(),
            eName: product['product_ename'].trim().toUpperCase(),
            series: this.seriesList[thisSeriesIndex].eName,
            seriesIndex: thisSeriesIndex,
            seriesId: thisSeriesId,
            imgURL: img,
            displayImgURL: product['product_img1'],
            productId: product['product_id'],
            year: product['product_year'],
            size: product['product_size'],
            description: product['product_des'],
            limitLabel: product['product_spec'],
            price: thisPrice,
            points: thisPoints,
            productNum: 1,
            totalPrice: 0,
            totalPointCost: 0,
            type: '1123123123123123',
          };
        });
        // console.log('a')
        this.productList = fetchProductList;
        this.showProductList = this.productList;
        this.targetProduct = this.showProductList[0];
      })
      .catch((error) => {
        console.log(error);
      });
  },
};