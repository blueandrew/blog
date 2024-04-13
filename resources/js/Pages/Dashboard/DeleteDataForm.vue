<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';


let props = defineProps({
    refreshWorks: Function,
    closeConfirmWorkDeletionModal: Function,
    deleteWork: Function,
    worksList: Object,
    workId: Number,
});

const form = useForm({
    title: '',
    url: '',
    status: 1,
});
const deleteWork = () => {
    axios.delete('/dashboard/' + props.workId)
    .then(response => {
        props.closeConfirmWorkDeletionModal();
        props.refreshWorks();
        location.reload();
    })
    .catch(error => {
        console.log(error);
    });
};

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please
                enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="mt-6">
            </div>
            
            <div class="flex items-center justify-end gap-4">
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>

                <SecondaryButton @click="closeConfirmWorkDeletionModal"> Cancel </SecondaryButton>
                
                <DangerButton
                    class="ms-3"
                    @click="deleteWork"
                >
                    Delete Work
                </DangerButton>
            </div>
        </form>
    </section>
</template>
