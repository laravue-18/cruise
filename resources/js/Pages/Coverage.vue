<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavMenu from '@/Shared/NavMenu.vue';
import Footer from '@/Shared/Footer.vue';
import MyCollapse from '@/Components/collapse/MyCollapse.vue';
import MyPanel from '@/Components/collapse/MyPanel.vue';
</script>

<template>
    <Head title="Coverage" />

    <section class="bg-[#DC76190D]">
        <NavMenu />
        <div class="container">
            <div class="px-4 py-20 lg:py-40 text-center lg:w-3/4 mx-auto">
                <h6 class="text-[#B65C08] text-lg font-poppins font-semibold">Coverage</h6>
                <h3 class="text-6xl font-medium mt-11 mb-44">
                    Coverage
                </h3>
                
            </div>
        </div>
    </section>

    <Footer/>
</template>

<style>
</style>
