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
                                <i class="bx bx-tachometer"></i>
                                Dashboard

                                <i class="icofont-accessibility"></i>
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
