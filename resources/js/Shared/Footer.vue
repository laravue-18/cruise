<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    quote: {
        type: Boolean,
        default: true
    },
    bg: {
        type: Boolean,
        default: true
    }
})
</script>

<template>
    <section class="px-4 lg:px-60 mt-40" :class="{'bg-[#0D1F34]': bg}">
        <div v-if="quote" class="rounded-lg hidden lg:block relative bg-[url('/assets/img/bg_home_banner.jpg')] -translate-y-1/2 py-20">
            <div class="w-20 h-20 rounded-full bg-[#FFB11A] mx-auto grid place-content-center mb-12">
                <img src="/assets/img/logo-sm.png" class="w-8" alt="" srcset="">
            </div>
            <h1 class="mx-auto text-white text-center text-5xl font-semibold mb-12">
                Secure Your Next Voyage Today
            </h1>
            <p class="mx-auto w-[52rem] text-center text-white text-xl">
                Nulla sollicitudin aliquet ex, et luctus sapien bibendum quis. Pellentesque habitant morbi 
                tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <div class="text-center mt-8">
                <Link href="/quote/create">
                    <button class="w-52 h-14 bg-[#0D1F34] text-white rounded hover:opacity-70 mr-12">
                        <span class="text-base">Get a Quote</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
                <Link href="/quote/create">
                    <button class="w-52 h-14 border border-white text-white rounded hover:opacity-70">
                        <span class="text-base">Contact Us</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
            </div>
        </div>
        <div class="flex justify-between -mt-32 border-b border-[#FFFFFF40] pb-16">
            <img src="assets/img/logo.svg" class="w-32" alt="">
            <ul class="flex items-center gap-10 mt-8 lg:mt-0">
                <li>
                    <Link href="/" class="text-white hover:text-zinc-500"><Icon type="logo-youtube" size="20"/></Link>
                </li>
                <li>
                    <Link href="/" class="text-white hover:text-zinc-500"><Icon type="logo-facebook" size="20"/></Link>
                </li>
                <li>
                    <Link href="/" class="text-white hover:text-zinc-500"><Icon type="logo-instagram" size="20"/></Link>
                </li>
            </ul>
        </div>
        <div class="lg:flex justify-between pt-12 pb-32 text-white">
            <div class="">
                <h4 class="text-4xl font-medium w-96">We Are Your Cruise Insurance Experts</h4>
                <p class="text-xl text-opacity-80 font-light mt-8">
                    Specialized Insurance for Your Sea Adventures 
                </p>
            </div>
            <div class="font-light text-xl">
                <p class="mb-16">Pages</p>
                <ul class="">
                    <li class="mb-10">
                        <Link href="/about" class="text-white text-opacity-70 hover:text-zinc-500">About</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/faq" class="text-white text-opacity-70 hover:text-zinc-500">Coverage</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/coverage" class="text-white text-opacity-70 hover:text-zinc-500">Cruises</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/destinations" class="text-white text-opacity-70 hover:text-zinc-500">Contact</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/destinations" class="text-white text-opacity-70 hover:text-zinc-500">FAQ</Link>
                    </li>
                </ul>
            </div>
            <div class="font-light text-xl">
                <p class="mb-16">Legal</p>
                <ul class="">
                    <li class="mb-10">
                        <Link href="/about" class="text-white text-opacity-70 hover:text-zinc-500">Privacy Policy</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/faq" class="text-white text-opacity-70 hover:text-zinc-500">Disclaimer</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/coverage" class="text-white text-opacity-70 hover:text-zinc-500">Brand Guidelines</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/destinations" class="text-white text-opacity-70 hover:text-zinc-500">Terms & Conditions</Link>
                    </li>
                </ul>
            </div>
            <div class="font-light text-xl">
                <p class="mb-16">Contact Info</p>
                <ul class="">
                    <li class="mb-10">
                        <Link href="/about" class="text-white text-opacity-70 hover:text-zinc-500">Privacy Policy</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/faq" class="text-white text-opacity-70 hover:text-zinc-500">Disclaimer</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/coverage" class="text-white text-opacity-70 hover:text-zinc-500">Brand Guidelines</Link>
                    </li>
                    <li class="mb-10">
                        <Link href="/destinations" class="text-white text-opacity-70 hover:text-zinc-500">Terms & Conditions</Link>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <footer class="bg-gradient-to-r from-[#EE8DB7] to-[#0B7ECE] py-3 px-4 lg:px-60">
        <p class="text-white">Copyright © 2010-2023 Company S.L. All rights reserved.</p>
    </footer>
</template>