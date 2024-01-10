<script setup>
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import {useForm} from "@inertiajs/vue3";
import ToastEditor from "@/Components/ToastEditor.vue";

const props = defineProps({

});

const form = useForm({
    test_editor: ""
});

</script>

<template>
    <AdminPanelLayout title="Dashboard">
        <template #header>Dashboard</template>
    </AdminPanelLayout>
</template>

<style scoped>

</style>
