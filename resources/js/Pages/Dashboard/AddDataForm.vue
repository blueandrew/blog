<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';


let props = defineProps({
    refreshWorks: Function,
    closeWorkAddModal: Function,
});

const form = useForm({
    title: '',
    url: '',
    status: 1,
});

const submitForm = () => {
    form.post(route('dashboard.add'), {
        onFinish: () => {
            props.refreshWorks();
            props.closeWorkAddModal();
        }
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
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="url" value="Url" />

                <TextInput
                    id="url"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.url"
                    required
                    autocomplete="url"
                />

                <InputError class="mt-2" :message="form.errors.url" />
            </div>
            
            <div>
                <InputLabel for="status" value="status" />

                <select id="status" class="mt-1 block w-full" v-model="form.status" >
                    <option value="1">Now</option>
                    <option value="2">Stop</option>
                </select>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
