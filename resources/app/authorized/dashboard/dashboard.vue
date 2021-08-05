<template>
    <b-container class="dashboard-container">
        <b-row>
            <b-col cols="12">
                <section>
                    <b-card
                        title="Everyday Checking"
                        title-tag="h1">

                        <div class="progress">
                            <div class="progress-bar spent flex-row justify-content-start" role="progressbar" :style="{flex: getSpentWidth }" :aria-valuenow="getSpentWidth" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-badge">
                                    <span>$ {{ checking.spent }} spent</span>
                                </span>
                            </div>
                            <div class="progress-bar available flex-row justify-content-end" role="progressbar" :aria-valuenow="getAvailableWidth" aria-valuemin="0" aria-valuemax="100" :style="{flex: getAvailableWidth}">
                                <span class="progress-badge">
                                    <span>$ {{ checking.total - checking.spent }} available</span>
                                </span>
                            </div>
                            <div class="today-marker d-flex align-items-end" :style="{left: getTodayOffset }">
                                <span class="pl-3"><strong>Today</strong>  {{ dateNow | date }}</span>
                            </div>
                        </div>
                    </b-card>
                </section>
            </b-col>
            <b-col cols="6">
                <section>
                    <b-card class="everyday-spending-status">
                        <div class="d-flex justify-content-start">
                            <div class="circle">
                                <div>
                                    <i class="icon-dym-cup" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div>
                                <h3>Great News!</h3>
                                <p>Your Everyday spending is on track.</p>
                            </div>
                        </div>
                    </b-card>
                </section>
                <section>
                    <div class="align-items-center border border-bottom-0 border-gray card-padding d-flex no-gutters">
                        <b-col cols="6">
                            <span>You need to assign</span><br>
                            <strong class="text-primary">3</strong>
                            <span> Credit Card Transactions</span>
                        </b-col>
                        <b-col cols="6" class="text-center">
                            <button class="btn btn-md w-75 btn-primary">Assign</button>
                        </b-col>
                    </div>
                    <div class="align-items-center border border-gray card-padding d-flex no-gutters">
                        <b-col cols="6">
                            <strong class="text-secondary">11</strong>
                            <span> Days until you</span><br>
                            <span>Defend Your Money</span>
                        </b-col>
                        <b-col cols="6" class="text-center">
                            <button class="btn btn-md w-75 btn-secondary">Defend</button>
                        </b-col>
                    </div>
                </section>
                <section>
                    <b-card
                        title="You Have Defended Your Money For"
                        title-tag="p">
                        <p class="mb-0"><strong class="lg-text pr-1">2 years</strong> and <strong class="pl-1 lg-text">8 months</strong></p>
                    </b-card>
                </section>
            </b-col>
            <b-col cols="6">
                <section>
                    <b-card
                        title="Available Balances"
                        title-tag="h1"
                    >
                        <div class="available-balance-items" v-for="account in available_account_balances" :key="account.id">
                            <div class="d-flex">
                                <b-col cols="1">
                                    <span :class="['available-balance-item-icon',account.color]"></span>
                                </b-col>
                                <b-col cols="7">
                                    <span>{{ account.name }}</span>
                                </b-col>
                                <b-col cols="4">
                                    <span>
                                        <span>$</span>
                                        <strong class="pull-right">{{ account.balance }}</strong>
                                    </span>
                                </b-col>
                            </div>
                        </div>
                        <div slot="footer" class="justify-content-center d-flex">
                            <button class="w-50 justify-content-center btn-md btn btn-primary d-flex align-items-center">
                                <span><i class="icon-dym-add"></i></span>
                                <span>Add Account</span>
                            </button>
                        </div>
                    </b-card>
                </section>
            </b-col>
        </b-row>
    </b-container>
</template>
<script src="./dashboard.controller.js"></script>
<style lang="scss" src="./_dashboard.scss" scoped></style>
