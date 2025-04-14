<script setup>

import { usePage } from '@inertiajs/vue3';
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";


</script>

<template>

    <div>
        
        <Navbar />

        <Sidebar />
           
        <main class="p-4 md:ml-64 h-auto pt-20">
            <slot />
        </main>
        
        </div>

</template>