<template>
    <div>
        <h1 class="text-3xl font-bold mb-6">Create API Key</h1>
        <form @submit.prevent="submit" class="space-y-4">
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="form.name" id="name" name="name" type="text" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
            </button>
        </form>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';

export default {
    setup() {
        const form = ref({
            name: '',
        });

        const submit = () => {
            Inertia.post('/api-keys', form.value, {
                onSuccess: (response) => {
                    form.value.name = ''; // Réinitialise le champ de formulaire après la création réussie
                    // Met à jour la liste des clés API dans le store Inertia après création réussie
                    Inertia.reload({ only: ['apiKeys'] });
                },
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>

