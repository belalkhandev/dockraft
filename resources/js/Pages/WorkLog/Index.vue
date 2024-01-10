<script setup>
import {ref} from "vue";
import {Link, useForm} from "@inertiajs/vue3";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Pagination from "@/Components/Pagination.vue";
import ToastEditor from "@/Components/ToastEditor.vue";
import moment from "moment";

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
                    <div class="box-header no-border">
                        <h5 class="title">Work logs</h5>
                        <div class="action">
                            <button @click="showFormModal" class="btn btn-sm btn-outline-primary">Add new</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="log-items">
                            <div class="notes">
                                <div v-for="log in work_logs.data" class="note bg-slate-50 border-1 p-2 rounded-1 mb-3">
                                    <p class="mb-1">{{ log.summary }}</p>
                                    <div class="mt-3 d-flex justify-content-start align-items-center gap-2">
                                        <span v-if="log.project" class="text-xs">
                                            {{ log.project.name }}
                                        </span>
                                        <small class="text-gray-300">|</small>
                                        <span class="text-xs">
                                            <i class="bx bx-calendar"></i>
                                            {{ moment(log.worked_at || log.created_at).format('MMMM D Y') }}
                                        </span>
                                        <small class="text-gray-300">|</small>
                                        <Link :href="route('work-log.show', log.ref)" class="text-slate-500 hover:text-green-600">
                                            <i class="bx bx-show-alt"></i>
                                        </Link>
                                        <small class="text-gray-300">|</small>
                                        <button @click="editAction(log)" class="text-slate-500 hover:text-blue-600">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <small class="text-gray-300">|</small>
                                        <button @click="deleteAction(log.id)" class="text-slate-500 hover:text-orange-600">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
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
                {{ form.work_log_ref ? 'Edit' : 'Add' }} Log
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
                <SecondaryButton @click="displayFormModal = false">Close</SecondaryButton>
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.work_log_ref ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
