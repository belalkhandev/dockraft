<script setup>
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import {useForm} from "@inertiajs/vue3";
import MarkdownIt from "markdown-it";
import {computed} from "vue";
import ToastEditor from "@/Components/ToastEditor.vue";
import ToastViewer from "@/Components/ToastViewer.vue";

const props = defineProps({

});

const form = useForm({
    test_editor: ""
});

const md = new MarkdownIt('commonmark');

const renderMarkdown = computed(() => {
    return md.render(form.test_editor);
})

</script>

<template>
    <AdminPanelLayout title="Dashboard">
        <template #header>Dashboard</template>

        <div class="box">
            <div class="box-body">
                <ToastEditor v-model="form.test_editor"/>
            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <ToastViewer :content="renderMarkdown"/>
            </div>
        </div>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
