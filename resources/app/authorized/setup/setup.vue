<template>
    <b-container class="setup-container">
        <b-row>
            <b-col cols="6">
                <section>
                    <b-card
                        title="Financial Accounts"
                        title-tag="h1"
                    >
                        <div class="d-flex align-items-stretch">
                            <div class="card-text-icon">
                                <i class="icon-dym-drag-and-drop"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="card-text">Drag and drop to link your Financial Accounts to a Defend Your Money Account</p>
                            </div>
                        </div>
                        <draggable
                            :list="institutionAccounts"
                            :options="{
                                group:'accounts',
                                dragClass:'dragging',
                                sort:false}"
                            @end="checkDymAccountLink"
                        >
                            <div class="sub-card"
                                v-for="institutionAccount in institutionAccounts"
                                :key="institutionAccount.id"
                                :data-institution-account-id="institutionAccount.id"
                            >
                                <strong>{{ institutionAccount.subtype | titlecase }}</strong>
                                <span>{{ institutionAccount.name }} x-{{ institutionAccount.mask }}</span>
                            </div>
                        </draggable>
                        <div slot="footer">
                            <plaid
                                ref="plaidContainer"
                                @accountSelected="addAccount"
                                class="d-flex justify-items-start"
                            >
                                <button
                                    slot="plaid-button"
                                    @click="addInstitution"
                                    class="ml-auto btn-md btn btn-primary d-flex align-items-center">
                                    <span><i class="icon-dym-add"></i></span>
                                    <span>Add Financial Institution</span>
                                </button>
                            </plaid>
                        </div>
                    </b-card>
                </section>
            </b-col>
            <b-col cols="6">
                <section>
                    <div class="card-padding">
                        <h1>Defend Your Money Accounts</h1>
                        <div
                            v-for="dymAccount in dymAccounts"
                            :key="dymAccount.id"
                        >
                            <draggable
                                :list="dymAccount.linked"
                                :options="{group:'accounts','handle':'none'}"
                                :class="['custom-card','d-flex','flex-column',dymAccount.color]"
                                :data-account-id="dymAccount.id"
                            >
                                <div class="custom-card-content d-flex flex-row justify-content-start">
                                    <div class="pr-1">
                                        <i :class="['custom-card-icon','fa-'+dymAccount.icon,'fa']"></i>
                                    </div>
                                    <span>{{ dymAccount.name }}</span>
                                    <div class="ml-auto">
                                        <a href="#">
                                            <i class="icon-dym-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                    </div>
                                </div>
                                <div
                                    v-if="dymAccount.linked.length===1"
                                    class="custom-card-footer d-flex flex-row justify-content-start align-items-baseline"
                                >
                                    <strong class="pr-1">{{ dymAccount.linked[0].subtype | titlecase }}</strong>
                                    <span> {{ dymAccount.linked[0].name }} x-{{ dymAccount.linked[0].mask }}</span>
                                    <a
                                        class="ml-auto"
                                        href="#"
                                        v-on:click="unlinkAccounts(dymAccount)"
                                    >
                                        <i class="icon-dym-remove"></i>
                                    </a>
                                </div>
                            </draggable>
                        </div>
                        <div class="mt-1 pt-3 mr-1 pr-3 d-flex justify-content-start">
                            <button class="btn btn-primary ml-auto btn-md d-flex align-items-center">
                                <span><i class="icon-dym-add"></i></span>
                                <span>Add Account</span>
                            </button>
                        </div>
                    </div>
                </section>
            </b-col>
        </b-row>
    </b-container>
</template>
<script type="text/javscript" src="./setup.controller.js"></script>
<style lang="scss" src="./_setup.scss"></style>

