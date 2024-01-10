<script setup>
import NavLink from "@/Components/NavLink.vue";
import {ref} from "vue";

const props = defineProps({
    sidebar_hidden: {
        type: Boolean,
        default: false
    }
})

const getActivePath = (routeName) => {
    const url = new URL(routeName)
    return url.pathname
}

</script>

<template>
    <aside class="sidebar" :class="{ 'toggle-sidebar': sidebar_hidden }">
        <div class="sidebar-items">
            <div class="sidebar-item">
                <div class="sidebar-item-body">
                    <ul>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class="bx bxs-dashboard"></i>
                                Dashboard
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-item-header">
                        <span class="icon">
                            <i class="bx bx-cog"></i>
                        </span>
                    <h4>Project Management</h4>
                </div>
                <div class="sidebar-item-body">
                    <ul>
                        <li :class="{ 'active': $page.url === getActivePath(route('project.index')) }">
                            <NavLink :href="route('project.index')">
                                <i class='bx bx-leaf' ></i>
                                Project
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class='bx bx-task'></i>
                                Issue
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class='bx bx-file' ></i>
                                Work Log
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class='bx bx-file' ></i>
                                Documentation
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
