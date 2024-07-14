<template>
    <div>
        <h1 class="text-3xl font-bold mb-6">API Keys</h1>
        <Link href="/api-keys/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Create New API Key
        </Link>
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full bg-white border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Key</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="apiKey in apiKeys" :key="apiKey.id" class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ apiKey.name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ apiKey.key }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <button @click="deleteApiKey(apiKey.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        Link,
    },
    props: {
        apiKeys: Array,
    },
    methods: {
        deleteApiKey(id) {
            if (confirm('Are you sure you want to delete this API key?')) {
                Inertia.delete(`/api-keys/${id}`, {
                    onSuccess: () => {
                        // Met à jour la liste des clés API après la suppression
                        this.apiKeys = this.apiKeys.filter(apiKey => apiKey.id !== id);
                    },
                });
            }
        },
    },
};
</script>
 