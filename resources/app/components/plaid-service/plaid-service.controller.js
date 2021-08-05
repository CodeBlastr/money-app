export default {
    data: data,
    computed: getComputed(),
    methods: getMethods(),
    created: created
};

function data(){
    return {
        institution: null,
        plaidLinkPublicKey: null,
        account: null
    };
}

function getComputed(){
}

function created(){
    var vm = this;
    vm.plaidLinkPublicKey = appEnv.plaidLinkPublicKey; /*global appEnv*/
}

function getMethods(){

    return {
        plaidLink: plaidLink
    };

    function plaidLink(){
        const vm = this;
        let selectedInstitution = {};

        /*global Plaid*/
        const handler = Plaid.create({
            apiVersion: 'v2',
            clientName: 'Plaid Walkthrough Demo',
            env: 'sandbox',
            product: ['auth', 'transactions'],
            selectAccount: true,
            key: vm.plaidLinkPublicKey,
            onEvent: function(eventName, metaData){
                if(eventName === 'SELECT_INSTITUTION'){
                    selectedInstitution = {
                        institutionId: metaData.institution_id,
                        institutionName: metaData.institution_name
                    };
                }
            },
            onSuccess: function(publicToken, metaData){
                selectedInstitution.publicToken = publicToken;
                Vue.appApi().authorized().institutionCreate(metaData).then(handleSuccess);
            },
        });

        handler.open();

        function handleSuccess(response){
            if(response.data.institutionAccounts){
                response.data.institutionAccounts.forEach(function(value, key){
                    vm.account = value;
                    vm.$emit('accountSelected', vm.account);
                });
            }

            vm.institution = response.data.institution;
        }
    }
}
