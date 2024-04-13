<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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

const clearForm = () => {
    form.reset()
};

const submitForm = () => {
    form.post(route('dashboard.create'), {
        preserveScroll: true,
        onFinish: () => {
            props.refreshWorks();
            // props.closeWorkAddModal();
        }
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                新增
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                新增
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="標題" />
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
                <InputLabel for="status" value="狀態" />
                <select id="status" class="mt-1 block w-full" v-model="form.status" >
                    <option value="1">啟用</option>
                    <option value="2">停止</option>
                </select>
            </div>

            <div class="flex items-center justify-end gap-4">
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        儲存完成
                    </p>
                </Transition>

                <SecondaryButton @click="closeWorkAddModal(); clearForm()">關閉</SecondaryButton>

                <PrimaryButton :disabled="form.processing">儲存</PrimaryButton>
            </div>
        </form>
    </section>
</template>
