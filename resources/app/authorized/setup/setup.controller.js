import draggable from 'vuedraggable';
import PlaidComponent from 'vue_root/components/plaid-service/plaid-service.vue';

export default {
    computed: getComputed(),
    components: {
        draggable,
        'plaid': PlaidComponent,
    },
    created: created,
    data: data,
    filters: getFilters(),
    methods: getMethods(),
};

function created(){
    this.loadDymAccounts();
}

function data(){
    this.loadInstitutions();
    return {
        institutionAccounts: [],
        dymAccounts: [],
    };
}

function getFilters(){
    return {
        titlecase: function(value){
            if(!value){ return ''; }
            value = value.toString();
            value = value.split(' ');
            return value.map(str => {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }).join(' ');
        }
    };
}

function getComputed(){
}

function getMethods(){
    return {
        addInstitution,
        addAccount,
        checkDymAccountLink,
        loadDymAccounts,
        loadInstitutions,
        unlinkAccounts
    };

    function addInstitution(){
        const vm = this;
        vm.$refs.plaidContainer.plaidLink();
    }

    function addAccount(account){
        const vm = this;
        vm.institutionAccounts.push(account);
    }

    function checkDymAccountLink(evt){
        const institutionAccountId = evt.item.dataset.institutionAccountId;
        const bankAccountTypeId = evt.to.attributes[0].value;
        if(bankAccountTypeId && institutionAccountId){
            const payload = {
                institutionAccountId: institutionAccountId,
                bankAccountTypeId: bankAccountTypeId,
            };
            Vue.appApi().authorized().bankAccountCreate(payload).then(true);
        }
    }

    function loadInstitutions(){
        const vm = this;
        Vue.appApi().authorized().institutionList().then(institutions);

        function institutions(response){
            if(response.data instanceof Array){
                vm.institutionAccounts = response.data;
            }
        }
    }

    function loadDymAccounts(){
        const vm = this;

        vm.dymAccounts = [{
            'id': 1,
            'name': 'Income Deposit',
            'color': 'light-gray',
            'icon': 'square',
            'linked': []
        }, {
            'id': 2,
            'name': 'Everyday Checking Account',
            'color': 'green',
            'icon': 'square',
            'linked': []
        }, {
            'id': 3,
            'name': 'Monthly Bills Checking Account',
            'color': 'pink',
            'icon': 'square',
            'linked': []
        }, {
            'id': 4,
            'name': 'Savings Access CC',
            'color': 'gray',
            'icon': 'credit-card',
            'linked': []
        }, {
            'id': 5,
            'name': 'Yearly Bills Savings',
            'color': 'orange',
            'icon': 'square',
            'linked': []
        }];

        Vue.appApi().authorized().institutionLinked().then(mapInstitutions);

        function mapInstitutions(response){
            vm.dymAccounts.forEach(function(obj, index){
                response.data.forEach(function(data){
                    if(obj.id === data.dym_account_id){
                        vm.dymAccounts[index].linked = [{
                            'id': data.id,
                            'name': data.name
                        }];
                    }
                });
            });
        }
    }

    function unlinkAccounts(dymAccount){
        this.institutionAccounts.push(dymAccount.linked[0]);
        Vue.appApi().authorized().unrelateDymAccount({
            institutionAccountId: dymAccount.linked[0].id
        }).then(true);
        dymAccount.linked = [];
    }
}
