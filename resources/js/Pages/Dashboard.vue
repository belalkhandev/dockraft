<script setup>
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import MonthlyBillCollectionChart from "@/Components/Charts/MonthlyBillCollectionChart.vue";
import {Link} from "@inertiajs/vue3";
import moment from "moment";
import PaymentStatusLabel from "@/Components/PaymentStatusLabel.vue";

const props = defineProps({

});

</script>

<template>
    <AdminPanelLayout title="Dashboard">
        <template #header>Dashboard</template>


    </AdminPanelLayout>
</template>
