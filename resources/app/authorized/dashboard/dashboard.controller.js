export default {
    data: data,
    computed: getComputed(),
    methods: getMethods(),
    created: created,
};

function created(){}

function data(){
    return {
        available_account_balances: getAvailableAccountBalances(),
        checking: {
            total: 1500,
            spent: 810.45,
        }
    };
    function getAvailableAccountBalances(){
        return [
            {
                'balance': '951.83',
                'color': 'light-gray',
                'id': 1,
                'name': 'Income Deposit Account',

            },
            {
                'balance': '689.55',
                'color': 'green',
                'id': 2,
                'name': 'Everyday Checking',
            },
            {
                'balance': '414.82',
                'color': 'pink',
                'id': 3,
                'name': 'Monthly Bills Checking',
            },
            {
                'balance': '83.06',
                'color': 'light-orange',
                'id': 4,
                'name': 'Improvement Savings',
            },
            {
                'balance': '306.25',
                'color': 'purple',
                'id': 5,
                'name': 'Vacation Savings',
            },
            {
                'balance': '228.39',
                'color': 'violet',
                'id': 6,
                'name': 'Clothing Savings',
            },
            {
                'balance': '246.73',
                'color': 'teal',
                'id': 7,
                'name': 'Holiday/Gift Savings',
            },
            {
                'balance': '339.55',
                'color': 'light-orange',
                'id': 8,
                'name': 'Yearly Bills Savings'
            }
        ];
    }
}

function getComputed(){
    return {
        getSpentWidth,
        getAvailableWidth,
        getTodayOffset,
        dateNow: getDateNow
    };
    function getDateNow(){
        return new Date();
    }

    function getSpentWidth(){
        return 100 * (this.checking.spent / this.checking.total) + '%';
    }
    function getAvailableWidth(){
        return 100 * ((this.checking.total - this.checking.spent) / this.checking.total) + '%';
    }
    function getTodayOffset(){
        return 100 * (this.dateNow.getDate() / this.getDaysInMonth()) + '%';
    }
}

function getMethods(){
    return {
        getDaysInMonth
    };

    function getDaysInMonth(){
        return new Date(this.dateNow.getFullYear(), this.dateNow.getMonth(), 0).getDate();
    }
}
