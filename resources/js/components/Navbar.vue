<template>
    <header class="bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
        <nav :class="isOpen ? 'block' : 'hidden'" class="flex items-center justify-between flex-wrap p-6 sm:flex sm:p-0">
            <router-link to="/entry" class="mt-1 block text-white font-semibold rounded hover:bg-gray-800 sm:mt-0 sm:ml-2 p-5 mr-5">Calendar Entry </router-link>            
            <router-link to="/events" class="block text-white font-semibold rounded hover:bg-gray-800 p-5 mr-5">My Events </router-link>                        
        </nav>
        <div class="flex items-center justify-between px-4 py-3 sm:p-0">
            <div class="sm:hidden">
                <button @click="isOpen = !isOpen" type="button" class="block text-gray-600 hover:text-white focus:text-white focus:outline-none">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    </svg>
                </button>
            </div>
        </div>        
    </header>
</template>
    
<script>
export default {
    data() {
        return {
            isOpen: false,
        }
    },
}
</script>

<style>
    .router-link-active {
        background-color: #6983b9;
    }
</style>