<template>
  <v-app>
    <keep-alive style="z-index: 9999999 !important">
        <loading-screen style="z-index: 9999999 !important"></loading-screen>
    </keep-alive>

    <v-app-bar absolute elevation=0 style="background-color: white; height: 64px; border-bottom: thin solid #28323b30; z-index: 1 !important;">
        <!-- logo -->
        <v-img
            v-if="appStore.logo"
            :src="appStore.logo"
            max-height="48"
            max-width="48"
            contain
            class="mr-2"
        ></v-img>
        <!-- spacer -->
        <v-spacer></v-spacer>
        <!-- login to login -->
        <!-- <v-btn
            v-if="!userStore.user"
            color="primary"
            href="/login"
        >
            Login
        </v-btn> -->
    </v-app-bar>

    <v-main class="background-main">
        <div class="container">
        <router-view></router-view>
        </div>
    </v-main>
  </v-app>
</template>

<script>

import { useAppStore } from '../store/appStore.js';
import { useUserStore } from '../store/userStore.js';

export default {
    name: 'App',

    setup() {
        const appStore = useAppStore();
        const userStore = useUserStore();
        return {appStore, userStore};
    },

    data(){
    return{

    }},
    mounted() {
    },
    methods:{

    },
    computed:{

    }
};
</script>



<style scoped>

    .container {
    max-width: 100%;
    padding-left: 24px;
    padding-right: 24px;
    padding-top: 24px;
    padding-bottom: 24px;
    }
    .background-main{
        background-color: #f8f8f8 !important;
    }

</style>
