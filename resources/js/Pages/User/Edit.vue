<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit users:
            </h2>
            <div class="max-w-md mx-auto mt-8">
                <h1 class="text-2xl font-semibold mb-4">Edit User</h1>
                <form @submit.prevent="updateUser" class="space-y-4">
                    <div class="flex flex-col">
                        <label for="name" class="text-sm text-gray-600">Name:</label>
                        <input type="text" name="name" id="name" v-model="userData.name" class="border rounded-lg py-2 px-3 mt-1">
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-sm text-gray-600">Email:</label>
                        <input type="email" name="email" id="email" v-model="userData.email" class="border rounded-lg py-2 px-3 mt-1">
                    </div>
                    <div class="flex flex-col">
                        <label for="coins" class="text-sm text-gray-600">Coin balance</label>
                        <input type="text" id="coins" class="border rounded-lg py-2 px-3 mt-1">
                    </div>
                    <!-- Add more fields as needed to edit user data -->
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                      Update User
                    </button>
                </form>
            </div>
        </template>
    </AppLayout>
</template>

  <script>
  export default {
    props: {
        userData: Object, // User data passed from the controller
    },
    data() {
      return {
        user: {}, // Store user data
      };
    },
    methods: {
      updateUser() {
        // Send a request to update the user's data
        // You can use Axios or your preferred HTTP library here
        this.$inertia.put(`/update/${this.userData.id}`, {
            name: this.userData.name,
            email: this.userData.email
            // TO DO: Add coins
        });

      },
    },
  };
  </script>
  