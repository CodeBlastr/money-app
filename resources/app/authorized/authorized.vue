<template>
    <loading-spinner :showSpinner="loadingUser">
        <div class="vueAuthorizedView container-fluid">
            <authorized-layout>
                <div class="row">
                    <div class="col-md-3 dashboard-sidebar-content alpha omega d-flex flex-column align-items-start">
                        <div class="dashboard-logo-content">
                            <img class="logo" src="~vue_root/assets/images/logo.png"/>
                        </div>
                        <div class="dashboard-sidebar-avatar dashboard-sidebar-padding invisible">
                            <img src="" />
                            <span v-if="user">
                                <h4>{{ user.name }}</h4>
                            </span>
                        </div>
                        <div class="dashboard-sidebar-nav dashboard-sidebar-padding">
                            <ul class="nav flex-column">
                                <router-link to="/" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-bar-chart"></i><span class="ml-3">Dashboard</span>
                                </router-link>
                                <router-link to="assign" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-credit-card"></i><span class="ml-3">Assign</span>
                                </router-link>
                                <router-link to="defend" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-pie-chart"></i><span class="ml-3">Defend</span>
                                </router-link>
                                <router-link to="setup" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-institution"></i><span class="ml-3">Setup</span>
                                </router-link>
                                <router-link to="help" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-comments"></i><span class="ml-3">Help</span>
                                </router-link>
                                <router-link to="settings" tag="li" class="pl-5 py-3 nav-item">
                                    <i class="fa fa-cog"></i><span class="ml-3">Settings</span>
                                </router-link>
                            </ul>
                        </div>
                        <div class="dashboard-sidebar-logout mt-auto mx-auto mb-5 w-75 dashboard-sidebar-padding">
                            <button v-on:click.prevent="logout" class="btn btn-primary btn-block btn-md">
                                <span><i class="icon-dym-sign-out"></i></span>
                                <span>Sign Out</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-9 dashboard-header-body-footer">
                        <div class="row flex-column align-items-start">
                            <div class="dashboard-header-content col-12">
                                <div class="header-alert pull-right">
                                    <i class="fa fa-bell-o"></i>
                                    <i class="fa fa-circle"></i>
                                </div>
                            </div>
                            <div class="col-12 dashboard-body">
                                <router-view></router-view>
                            </div>
                            <div class="col-12 dashboard-footer-content mt-auto">
                                <span class="brand-copy">&copy; Defend Your Money, LLC. All Rights Reserved.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </authorized-layout>
        </div>
    </loading-spinner>
</template>
<script src="./authorized.controller.js"></script>
