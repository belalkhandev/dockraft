<script setup>
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import {Link} from "@inertiajs/vue3";
import moment from "moment";
import ToastViewer from "@/Components/ToastViewer.vue";

const props = defineProps({
    log: {
        type: Object,
        default: () => ({})
    },
});


</script>

<template>
    <AdminPanelLayout title="Work logs">
        <template #header>Work logs</template>
        <div class="box">
            <div class="box-header no-border">
                <h5 class="title">Details</h5>
                <div class="action">
                    <Link  :href="route('work-log.index')" class="btn btn-sm btn-outline-primary">Log list</Link>
                </div>
            </div>
            <div class="box-body">
                <p class="m-0">{{ log.project.name }} <small>|</small> <i class="bx bx-calendar"></i>{{ moment(log.worked_at || log.created_at).format('LL')}}</p>
                <h5 class="mb-4">{{ log.summary }}</h5>
                <ToastViewer :content="log.description"/>
            </div>
        </div>
    </AdminPanelLayout>
</template>

<style scoped>

</style>
