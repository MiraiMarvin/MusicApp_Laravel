<template>
    <div>
      <h1>API Keys</h1>
      <button @click="showCreateForm = true">Create New API Key</button>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Key</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="apiKey in apiKeys" :key="apiKey.id">
            <td>{{ apiKey.name }}</td>
            <td>{{ apiKey.key }}</td>
            <td>
              <button @click="deleteApiKey(apiKey.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="showCreateForm">
        <h2>Create API Key</h2>
        <form @submit.prevent="createApiKey">
          <input v-model="newApiKeyName" placeholder="API Key Name" required>
          <button type="submit">Create</button>
          <button @click="showCreateForm = false">Cancel</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        apiKeys: [],
        showCreateForm: false,
        newApiKeyName: '',
      };
    },
    methods: {
      fetchApiKeys() {
        axios.get('/api/api-keys')
          .then(response => {
            this.apiKeys = response.data;
          });
      },
      createApiKey() {
        axios.post('/api/api-keys', { name: this.newApiKeyName })
          .then(response => {
            this.apiKeys.push(response.data);
            this.newApiKeyName = '';
            this.showCreateForm = false;
          });
      },
      deleteApiKey(id) {
        axios.delete(`/api/api-keys/${id}`)
          .then(response => {
            this.apiKeys = this.apiKeys.filter(apiKey => apiKey.id !== id);
          });
      },
    },
    mounted() {
      this.fetchApiKeys();
    },
  };
  </script>
  