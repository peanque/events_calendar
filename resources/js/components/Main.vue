<template>
    <div id="main">                
        <PageHeader/>        
        <div class="content">
            <router-view></router-view>
        </div>        
    </div>
</template>

<script>
import PageHeader from './Header.vue';

export default {
    name: 'main-app',
    components: {
        PageHeader,
    }
}
</script>

<style>

</style>