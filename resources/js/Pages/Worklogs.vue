<script setup>
import {ref} from "vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Pagination from "@/Components/Pagination.vue";
import ToastEditor from "@/Components/ToastEditor.vue";
import moment from "moment";
import ToastViewer from "@/Components/ToastViewer.vue";

const props = defineProps({
    work_logs: {
        type: Object,
        default: () => ({})
    },
    projects: {
        type: Object,
        default: () => ({})
    },
});

const displayFormModal = ref(false);

const showFormModal = () => {
    form.reset();
    displayFormModal.value = !displayFormModal.value
}

const form = useForm({
    work_log_ref: '',
    project_id: '',
    summary: '',
    description: ''
})

const submitForm = () => {
    if (!form.work_log_ref) {
        form.transform(data => ({
            ...data
        })).post(route('work-log.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Log stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('work-log.edit', form.work_log_ref), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Log update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (work_log) => {
    form.work_log_ref = work_log.ref;
    form.project_id = work_log.project_id;
    form.summary = work_log.summary;
    form.description = work_log.description;

    displayFormModal.value = true
}


const deleteAction = (work_log_ref) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0284c7',
        cancelButtonColor: '#DC2626',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('work_log.delete', work_log_ref), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Log has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Work logs">
        <template #header>Work logs</template>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Work logs</h5>
                        <div class="action">
                            <button @click="showFormModal" class="btn btn-sm btn-rounded btn-outline-primary"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="log-items">
                            <div v-for="log in work_logs.data" class="log-item border-1 p-2 rounded-2 mb-3 bg-slate-50-50">
                                <div class="log-item-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>{{ log.project.name }}</h5>
                                        <p>{{ moment(log.worked_at || log.created_at).format('LL') }}</p>
                                    </div>
                                    <div>
                                        <div class="action">
                                            <ul class="d-flex justify-content-end align-items-center gap-2">
                                                <li>
                                                    <button @click="editAction(work_log)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                                </li>
                                                <li>
                                                    <button @click="deleteAction(work_log.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="log-item-body">

                                    <h5>{{ log.summary }}</h5>
                                    <ToastViewer :content="log.description"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="work_logs"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false" :max-width="'3xl'">
            <template #title>
                {{ form.work_log_ref ? 'Edit' : 'Add' }} work_log
            </template>

            <template #content>
                <form @submit.prevent="submitForm">

                    <div class="form-group">
                        <label>Project</label>
                        <select v-model="form.project_id" class="form-control form-select">
                            <option v-for="project in projects" :value="project.id">{{ project.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.project_id" />
                    </div>
                    <div class="form-group">
                        <label>Summary</label>
                        <input type="text" class="form-control" v-model="form.summary" placeholder="e.g: Project A">
                        <InputError class="mt-2" :message="form.errors.summary" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <ToastEditor v-model="form.description"/>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="displayFormModal = false">Cancel</SecondaryButton>
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.work_log_ref ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
