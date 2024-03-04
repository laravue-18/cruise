<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    active: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <Link  
        :class="{'text-[#FF9900]': active, 'text-white': !active}"
        class="hover:text-[#ff990090]"
    >
        <slot></slot>
    </Link>
</template>