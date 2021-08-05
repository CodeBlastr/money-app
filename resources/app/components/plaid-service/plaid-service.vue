<template>
    <div class="plaid-service-container">
        <slot name="plaid-button">
            <button v-on:click="plaidLink">Connect Bank Account</button>
        </slot>
    </div>
</template>
<script src="./plaid-service.controller.js"></script>
