<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from './NavLink.vue'
import { Link } from '@inertiajs/vue3';
defineProps({
    dark: {
        type: Boolean,
        default: false
    },
    quote: {
        type: Boolean,
        default: true
    },
    other: {
        type: Boolean,
        default: true
    },
    phone: {
        type: String,
        default: 'default'
    }
})

// const isSticky = ref(false)

const showMenu = ref(false)
</script>

<template>
    <nav class="relative flex flex-wrap items-center justify-between z-10" :class="{'bg-[#DC76190D] pb-8': showMenu}">
        <div class="w-full lg:h-24 px-4 lg:px-60 flex flex-wrap items-center justify-between">
            <div class="w-full relative flex items-center justify-between lg:w-auto lg:static lg:block lg:justify-start py-8">
                <Link href="/"><img :src="`/assets/img/logo${dark?'-dark':''}.svg`" class="w-32" alt=""></Link>
                <button @click="showMenu = !showMenu" class="block lg:hidden">
                    <Icon :type="showMenu ? 'ios-close' : 'ios-menu'" size="32" />
                </button>
            </div>
            <div :class="{'hidden': !showMenu, 'flex': showMenu}" class="lg:flex lg:flex-grow items-center">
                <ul class="font-poppins text-base font-medium flex flex-col lg:flex-row lg:items-center gap-8 ml-auto text-white">
                    <template v-if="other">
                        <li>
                            <NavLink href="/about" :active="$page.component == 'About'" class="text-white">About</NavLink>
                        </li>
                        <li>
                            <NavLink href="/coverage" :active="$page.component == 'Coverage'">Coverage</NavLink>
                        </li>
                        <li>
                            <NavLink href="/coverage" :active="$page.component == 'Coverage'">Cruises</NavLink>
                        </li>
                        <li>
                            <NavLink href="/coverage" :active="$page.component == 'Coverage'">Contact</NavLink>
                        </li>
                        <li>
                            <NavLink href="/coverage" :active="$page.component == 'Coverage'">FAQ</NavLink>
                        </li>
                        <li>
                            <NavLink href="/destinations" :active="$page.component == 'Destinations'">DESTINATIONS</NavLink>
                        </li>
                    </template>
                    <template v-if="quote">
                        <li>
                            <Link href="/quote/create">
                                <button class="w-52 h-14 bg-[#0D1F34] text-white rounded hover:opacity-70">
                                    <span class="text-base">Get a Quote</span>
                                    <Icon type="ios-arrow-forward" class="ml-4" />
                                </button>
                            </Link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style>
.ivu-btn-info {
    color: #191919;
}
.ivu-btn-info:hover {
    color: #FF9900;
}
</style>