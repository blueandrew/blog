<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import UpdateDataForm from '@/Pages/Dashboard/UpdateDataForm.vue';
import DeleteDataForm from '@/Pages/Dashboard/DeleteDataForm.vue';
import AddDataForm from '@/Pages/Dashboard/AddDataForm.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

defineProps({
    works: {
        type: Object,
    },
});
const initialDataItem = {
    'id': 0,
    'title': '',
    'url': '',
    'status': 1,
};

let worksList = reactive([...usePage().props.works]);
let dataItem = reactive({ ...initialDataItem });


// Add  Modal
const confirmingWorkAdd = ref(false);
const confirmWorkAdd = (index) => {
    confirmingWorkAdd.value = true;

    dataItem = worksList[index];
};
const closeWorkAddModal = () => {
    confirmingWorkAdd.value = false;
};

// Edit  Modal
const confirmingWorkEdit = ref(false);
const confirmWorkEdit = (index) => {
    confirmingWorkEdit.value = true;

    dataItem = worksList[index];
};
const closeWorkEditModal = () => {
    confirmingWorkEdit.value = false;
};

// Delete  Modal
const confirmingWorkDeletion = ref(false);
const workId = ref(null);
const confirmWorkDeletion = (id) => {
    confirmingWorkDeletion.value = true;
    workId.value = id;
};
const closeConfirmWorkDeletionModal = () => {
    confirmingWorkDeletion.value = false;
};

const refreshWorks = () => {
    axios.get('/dashboard/getWorks')
    .then(response => {
        worksList = response.data;
        usePage().props.works = response.data;
    })
    .catch(error => {
        console.log(error);
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div ata-inertia-replace class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="align-middle shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                                <a href="#" @click="confirmWorkAdd(index)">
                                    新增
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr v-for="(item, index) in worksList" :key='index'>
                            <td class="px-6 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                        <img :src=item.url class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl" alt="">
                                    </div>
                                    <!-- <div class="flex flex-col justify-start">
                                        <a href="javascript:void(0)" class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary"></a>
                                    </div> -->
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm text-gray-900">{{item.title}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" v-if="item.status === 1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Now</span>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" v-if="item.status === 2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Stop</span>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm font-medium">
                                <div class="flex justify-end gap-4">
                                    <a x-data="{ tooltip: 'Edite' }" href="#" @click="confirmWorkEdit(index)">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                            />
                                        </svg>
                                    </a>
                                    <a x-data="{ tooltip: 'Delete' }" href="#" @click="confirmWorkDeletion(item.id)">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add  Modal-->
        <Modal :show="confirmingWorkAdd" @close="closeWorkAddModal">
            <div class="p-6">
                <AddDataForm class="max-w-xl" :refreshWorks="refreshWorks" :closeWorkAddModal="closeWorkAddModal"/>
            </div>
        </Modal>

        <!-- Edit  Modal-->
        <Modal :show="confirmingWorkEdit" @close="closeWorkEditModal">
            <div class="p-6">
                <UpdateDataForm class="max-w-xl" :dataItem="dataItem" :refreshWorks="refreshWorks" :closeWorkEditModal="closeWorkEditModal"/>
            </div>
        </Modal>

        <!-- Delete  Modal-->
        <Modal :show="confirmingWorkDeletion" @close="closeConfirmWorkDeletionModal">
            <div class="p-6">
                <DeleteDataForm class="max-w-xl" :workId="workId" :worksList="worksList" :refreshWorks="refreshWorks" :closeConfirmWorkDeletionModal="closeConfirmWorkDeletionModal"/>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
