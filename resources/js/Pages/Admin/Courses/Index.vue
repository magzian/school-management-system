<script setup>


import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

defineProps({
    courses:Array,
})

const id = ref(null)
const course_name = ref('')
const course_code = ref('')
const description = ref('')
const editMode = ref(false)


const openEditModal = (course) => {
    editMode.value = true;
    id.value = course.id;
    course_name.value = course.name;
    course_code.value = course.code;
    course_description.value = course.description;

    document.getElementById("courseModal").showModal();
}



const resetForm = () => {
    course_name.value = "";
    course_code.value = "";
    description.value = "";
}

const openAddSubject = () => {
    resetForm()
    editMode.value = false;
    document.getElementById("courseModal").showModal();
}

const confirmDelete = (course) => {

}


</script>

<template>
    <AdminLayout>
        <div class="container mx-auto">
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search" required="" />
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button @click="openAddSubject" type="button"
                                    class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Subject
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            Subject name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Subject code
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="course in courses.data" :key="course.id"
                                        class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">
                                            {{ course.name }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ course.code }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ course.description }}
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                            <button
                                                type="button"
                                                @click="openEditModal(course)"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button
                                                type="button"
                                                @click="confirmDelete(course)"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add/Edit Course Modal -->

                        <dialog id="courseModal" class="modal">
                            <form method="dialog" class="modal-box">
                                <h3 class="font-bold text-lg mb-4">{{ editMode ? 'Edit' : 'Add' }}</h3>
                                <div v-if="Object.keys(errors).length" class="mb-4">
                                    <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                        <li v-for="(msg, key) in errors" :key="key">{{ msg }}</li>
                                    </ul>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <input v-model="course_name" type="text" placeholder="Course name" class="input input-bordered" />
                                    <input v-model="course_code" type="text" placeholder="Course code" class="input input-bordered" />
                                    <input v-model="description" type="text" placeholder="Description" class="input input-bordered" />

                                </div>
                                <div class="modal-action">
                                    <button class="btn" @click="resetForm">Cancel</button>
                                    <button class="btn btn-primary" @click.prevent="editMode ? updateCourse() : addCourse()">
                                        {{ editMode ? 'Update' : 'Add' }}
                                    </button>
                                </div>
                                    <div>

                                </div>
                            </form>
                        </dialog>

                        <!--  End modal  -->

                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                Showing
                                <span class="font-semibold text-gray-900 dark:text-white">{{ courses.from }}</span>
                                to
                                <span class="font-semibold text-gray-900 dark:text-white">{{ courses.to }}</span>
                                of
                                <span class="font-semibold text-gray-900 dark:text-white">{{ courses.total }}</span>
                            </span>
                            <ul class="inline-flex items-stretch -space-x-px">
                                <li v-for="(link, i) in students.links" :key="i">
                                    <button
                                        v-if="link.url"
                                        :class="[
                                            'flex items-center justify-center text-sm py-2 px-3 leading-tight border',
                                            link.active
                                                ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                                                : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                                            i === 0 ? 'rounded-l-lg' : '',
                                            i === students.links.length - 1 ? 'rounded-r-lg' : ''
                                        ]"
                                        @click="router.visit(link.url, { preserveScroll: true })"
                                        v-html="link.label"
                                    />
                                    <span v-else
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-400 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                                        <span v-html="link.label" />
                                    </span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
        
    </AdminLayout>
</template>
