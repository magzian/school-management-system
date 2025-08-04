<script setup>

import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const course_name = ref('');
const course_code = ref('');
const description = ref('');
const loading = ref(false);

const confirmAddSubject = async() => {
    loading.value = true;

    const formData = new FormData();
    formData.append('course_name', course_name.value);
    formData.append('course_code', course_code.value);
    formData.append('description', description.value);
    try{
        await router.post("/admin/subjects/store", formData, {
            onSuccess: (page) => {
                loading.value = false;
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    title: page.props.flash.message || 'Subject added successfully!',
                })
            },
            onError: (error) => {
                loading.value = false;
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Validation Error",
                })
            }
        })

    } catch (error) {
        console.error('Error adding subject:', error);
    } finally {
        loading.value = false;
    }
}




</script>


<template>
    <AdminLayout>
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">Create Subject</h1>
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <form @submit.prevent="confirmAddSubject">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="course_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject name</label>
                            <input type="text" id="course_name" v-model="course_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div>
                            <label for="course_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                                code</label>
                            <input type="text" id="course_code" v-model="course_code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description
                                </label>
                            <input type="text" id="description" v-model="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                    </div>
                    
                    <button type="submit" :disabled="loading"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center justify-center">
                        <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        {{ loading ? 'Adding...' : 'Add Subject' }}
                    </button>
                </form>
            </div>
        </div>
    </AdminLayout>

</template>