<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavMenu from '@/Shared/NavMenu.vue';
import Footer from '@/Shared/Footer.vue';
import { ref } from 'vue';

const isSticky = ref(false)

isSticky.value = window.scrollY > 40;
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 40) {
        isSticky.value = true;
    } else {
        isSticky.value = false;
    }
});
</script>

<template>
    <Head title="About" />


    <section class="bg-[url('/assets/img/bg_about_banner.png')] bg-cover">
        <div :class="{'sticky top-0 bg-[#00469D] shadow-lg': isSticky}">
            <NavMenu />
        </div>
        <div class="text-white text-center mx-auto py-36 px-4">
            <div class="text-xl font-medium">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-300">
                    About Us
                </span>
            </div>
            <h3 class="text-6xl font-semibold mt-11 mb-8">
                Set Sail with Confidence
            </h3>
            <p class="mx-auto lg:w-[60rem] text-lg font-light leading-loose text-opacity-80 mb-8">
                Welcome to CruiseFreely.com, your compass to navigating the seas of cruise 
                travel insurance with ease and assurance. We are dedicated to empowering your seafaring spirit, 
                knowing that true freedom comes with the security of comprehensive coverage.
            </p>
            <Link href="/quote/create">
                <button class="w-52 h-14 bg-[#0D1F34] text-white rounded hover:opacity-70">
                    <span class="text-base">Get a Quote</span>
                    <Icon type="ios-arrow-forward" class="ml-4" />
                </button>
            </Link>
        </div>
    </section>

    <section class="px-4 lg:px-60 py-20 lg:py-48 lg:flex lg:items-center lg:justify-between">
        <div>
            <div class="text-xl font-medium">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#0D1F34] to-[#0D1F3482]">
                    Charting a Course for Cruiser Peace of Mind
                </span>
            </div>
            <h3 class="text-4xl font-semibold text-[#0D1F34] mt-11 mb-8 lg:w-[36rem]">
                At CruiseFreely.com, we embarked on our journey with a clear mission
            </h3>
            <p class="lg:w-[40rem] text-xl text-[#566B78] mb-12">
                To tailor travel insurance specifically for the cruise traveler. 
                Understanding that each voyage is filled with unique moments and potential uncertainties, 
                we've cast our anchor to provide specialized solutions that cater to your individual needs at sea.
            </p>
            <Link href="/quote/create">
                <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                    <span class="text-base">Get a Quote</span>
                    <Icon type="ios-arrow-forward" class="ml-4" />
                </button>
            </Link>
        </div>
        <div class="relative">
            <img src="/assets/img/img_about_1.png" alt="" class="lg:w-[39rem]" srcset="">
        </div>
    </section>

    <section>
        <img src="/assets/img/img_about_bg.png" alt="" srcset="">
    </section>

    <section class="px-4 lg:px-60 py-20 lg:py-48 lg:flex lg:items-center lg:justify-between">
        <div class="relative">
            <img src="/assets/img/img_about_2.png" alt="" class="lg:w-[39rem]" srcset="">
        </div>
        <div>
            <div class="text-xl font-medium">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#0D1F34] to-[#0D1F3482]">
                    Navigators of Tailored Cruise Coverage
                </span>
            </div>
            <h3 class="text-4xl font-semibold text-[#0D1F34] mt-11 mb-8 lg:w-[36rem]">
                The open sea is our home, and cruise enthusiasts are our family.
            </h3>
            <p class="lg:w-[40rem] text-xl text-[#566B78] mb-12">
                Our crew of experts has charted the waters of insurance policies to handpick 
                the finest coverage that speaks directly to the cruiser's experience. 
                From individual excursions to full fleet voyages, we ensure that every detail is covered, 
                so you can set sail on your adventure with nothing but the horizon ahead.
            </p>
            <Link href="/quote/create">
                <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                    <span class="text-base">Get a Quote</span>
                    <Icon type="ios-arrow-forward" class="ml-4" />
                </button>
            </Link>
        </div>
    </section>

    <section class="px-4 lg:px-60 py-20 lg:py-48 lg:flex lg:items-center lg:justify-between">
        <div>
            <div class="text-xl font-medium">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#0D1F34] to-[#0D1F3482]">
                    Cruise with the Experts at CruiseFreely
                </span>
            </div>
            <h3 class="text-4xl font-semibold text-[#0D1F34] mt-11 mb-8 lg:w-[36rem]">
                CruiseFreely.com isn't just a service — it's a promise of unwavering support and unmatched expertise.
            </h3>
            <p class="lg:w-[40rem] text-xl text-[#566B78] mb-12">
                To tailor travel insurance specifically for the cruise traveler. 
                Understanding that each voyage is filled with unique moments and potential uncertainties, 
                we've cast our anchor to provide specialized solutions that cater to your individual needs at sea.
            </p>
            <Link href="/quote/create">
                <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                    <span class="text-base">Get a Quote</span>
                    <Icon type="ios-arrow-forward" class="ml-4" />
                </button>
            </Link>
        </div>
        <div class="relative">
            <img src="/assets/img/img_about_3.png" alt="" class="lg:w-[39rem]" srcset="">
        </div>
    </section>
    
    <Footer/>
</template>

<style>
</style>
