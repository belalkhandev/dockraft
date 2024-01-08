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

        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Toast UI editor</h5>
            </div>
            <div class="box-body">
                <ToastEditor v-model="form.test_editor"/>
            </div>
        </div>
    </AdminPanelLayout>
</template>

<style scoped>

</style>
