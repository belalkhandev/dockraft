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

const props = defineProps({
    projects: {
        type: Object,
        default: () => ({})
    },
    statuses: {
        type: Object,
        default: () => ({})
    }
});

const displayFormModal = ref(false);

const showFormModal = () => {
    form.reset();
    displayFormModal.value = !displayFormModal.value
}

const form = useForm({
    project_ref: '',
    name: '',
    key: '',
    description: '',
    status: ''
})

const submitForm = () => {
    if (!form.project_ref) {
        form.transform(data => ({
            ...data
        })).post(route('project.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Project stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('project.edit', form.project_ref), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Project update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (project) => {
    form.project_ref = project.ref;
    form.name = project.name;
    form.key = project.key;
    form.description = project.description;
    form.status = project.status;

    displayFormModal.value = true
}


const deleteAction = (project_ref) => {
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
            form.delete(route('project.delete', project_ref), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Project has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Projects">
        <template #header>Projects</template>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Projects</h5>
                        <div class="action">
                            <button @click="showFormModal" class="btn btn-sm btn-rounded btn-outline-primary"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Name</th>
                                <th>Key</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(project, i) in projects.data">
                                <td>{{ project.ref }}</td>
                                <td>{{ project.name }}</td>
                                <td>{{ project.key }}</td>
                                <td>{{ project.status }}</td>
                                <td>
                                    <div class="action">
                                        <ul>
                                            <li>
                                                <button @click="editAction(project)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                            </li>
                                            <li>
                                                <button @click="deleteAction(project.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="projects"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false">
            <template #title>
                {{ form.project_ref ? 'Edit' : 'Add' }} project
            </template>

            <template #content>
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name" placeholder="e.g: Project A">
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" class="form-control" v-model="form.key" placeholder="e.g: PR">
                                <InputError class="mt-2" :message="form.errors.key" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.status" class="form-control form-select">
                                    <option value="">Select</option>
                                    <option v-for="status in statuses" :value="status">{{ status.charAt(0).toUpperCase() + status.slice(1) }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.status" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <ToastEditor v-model="form.description"/>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="displayFormModal = false">Close</SecondaryButton>
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.project_ref ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
