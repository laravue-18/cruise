<script setup>
defineProps(['errors'])
</script>
<template>
    <div class="text-red-500 text-sm mt-2">
        <span v-for="error in errors" :key="error.$uid">
            {{ error.$message }}
        </span>
    </div>
</template>