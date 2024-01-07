<script setup>
import NavLink from "@/Components/NavLink.vue";
import {ref} from "vue";

const getActivePath = (routeName) => {
    const url = new URL(routeName)
    return url.pathname
}

let sidebarHidden = ref(false);
const toggleSidebar = () => {
    sidebarHidden.value = !sidebarHidden.value
}

</script>

<template>
    <span class="sidebar-toggle" @click="toggleSidebar">
        <i class='bx bx-menu-alt-left'></i>
    </span>
    <aside class="sidebar" :class="{ 'toggle-sidebar': sidebarHidden }">
        <div class="sidebar-items">
            <div class="sidebar-item">
                <div class="sidebar-item-body">
                    <ul>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class="bx bx-tachometer"></i>
                                Dashboard
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </aside>
</template>

<style scoped>

</style>
