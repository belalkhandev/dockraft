<script setup>
    import Dropdown from "../Components/Dropdown.vue";
    import DropdownLink from "../Components/DropdownLink.vue";
</script>

<template>
    <header>
        <div class="apps">
            <div class="app-brand">
                <h2>Dockraft</h2>
            </div>
        </div>
        <div class="header-navs">
            <div class="page-title">
                <h5><slot name="header"/></h5>
            </div>
            <div class="nav-items">
                <div class="nav-item no-border">
                    {{ $page.props.auth.user.name }}
                </div>
                <div class="nav-item">
                    <Dropdown align="right">
                        <template #trigger>
                                <span class="nav-icon" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
                                    <i class='bx bx-user' ></i>
                                </span>
                        </template>

                        <template #content>
                            <p class="text-dark mb-0 p-2 border-bottom">{{ $page.props.auth.user.name }} {{ $page.props.auth.user.email }}</p>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Logout
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </div>
    </header>
</template>

<style>

</style>
