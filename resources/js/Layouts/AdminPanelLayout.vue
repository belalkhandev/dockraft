<script setup>
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";
import {Head} from "@inertiajs/vue3";
import SpinnerGlow from "@/Components/SpinnerGlow.vue";
import {ref} from "vue";

defineProps({
    title: String,
});

let sidebarHidden = ref(false);
const toggleSidebar = () => {
    sidebarHidden.value = !sidebarHidden.value
}

</script>

<template>
    <Head :title="title"/>
    <Header>
        <template #header>
            <slot name="header"/>
        </template>
    </Header>
    <div class="wrapper">
        <Sidebar :sidebar_hidden="sidebarHidden"/>
        <main class="main-content">
            <div class="content">
                <slot />
            </div>
        </main>

        <span class="sidebar-toggle" @click="toggleSidebar">
            <i class='bx bx-dots-vertical-rounded'></i>
        </span>
    </div>

</template>

<style scoped>

</style>
