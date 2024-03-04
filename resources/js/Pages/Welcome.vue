<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavMenu from '@/Shared/NavMenu.vue';
import Footer from '@/Shared/Footer.vue';
import MyCollapse from '@/Components/collapse/MyCollapse.vue';
import MyPanel from '@/Components/collapse/MyPanel.vue';
import TestimonialsSlider from '@/Components/TestimonialsSlider.vue';
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

const offerTab = ref(0)

</script>

<template>
    <Head title="Welcome" />

    <section class="bg-[url('/assets/img/bg_home_banner.jpg')] bg-cover">
        <!-- banner -->
        <div :class="{'sticky top-0 bg-[#00469D] shadow-lg': isSticky}">
            <NavMenu />
        </div>
        <div class=" px-4 lg:px-60 py-20 lg:flex lg:items-center lg:justify-between">
            <div class="text-white">
                <p>Sail with Confidence</p>
                <h2 class="lg:w-[42rem] text-6xl font-medium leading-tight tracking-tight pr-8 lg:pr-0">
                    We Are Your Cruise Insurance Experts
                </h2>
                <p class="lg:w-[51rem] font-poppins text-2xl leading-relaxed my-16 pr-4 lg:pr-0">
                    Specialized Insurance for Your Sea Adventures - Because Every Voyage Deserves Peace of Mind
                </p>
                <div class="">
                    <Link href="/quote/create">
                        <button class="w-52 h-14 bg-[#0D1F34] text-white rounded hover:opacity-70">
                            <span class="text-base">Get a Quote</span>
                            <Icon type="ios-arrow-forward" class="ml-4" />
                        </button>
                    </Link>
                </div>
            </div>
            <div class="hidden lg:block">
                <img src="assets/img/hero.png" alt="">
            </div>
        </div>
        <div class="px-4 lg:px-60 translate-y-1/2">
            <div class="bg-[#0D1F34] px-24 py-4 rounded">
                <img src="/assets/img/providers.png" alt="" srcset="">
            </div>
        </div>
    </section>

    <section class="lg:flex gap-24 items-center justify-center pt-40 pb-20 px-4 lg:px-20">
        <div class="relative">
            <div class="w-32 h-32 rounded-full bg-[#FFB11A] grid place-content-center absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <img src="/assets/img/logo-sm.png" alt="" srcset="">
            </div>
            <img src="/assets/img/img1.png" alt="" srcset="" class="mx-auto">
            <div class="-z-10 absolute -bottom-8 left-1/2 -translate-x-1/2 w-[35rem] h-[26rem] bg-gradient-to-tr from-[#EE8DB7] to-[#0B7ECE] rounded">
            </div>
        </div>
        <div class="lg:w-[36rem] mt-20 lg:mt-0">
            <p class="text-xl font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#0D1F3482]">Navigating Smooth Seas</p>
            <h2 class="text-4xl font-semibold text-[#0D1F34] my-12">Set sail on your cruise adventure with peace of mind.</h2>
            <p class="text-xl text-[#5C6469] mb-12">
                Our carefully selected travel insurance policies are designed 
                to provide comprehensive cruise coverage, ensuring a 
                worry-free experience on the high seas.
            </p>
            <Link href="/quote/create">
                <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                    <span class="text-base">Get a Quote</span>
                    <Icon type="ios-arrow-forward" class="ml-4" />
                </button>
            </Link>
        </div>
    </section>

    <!-- Elder means wiser -->
    <section id="discover" class="bg-[#FDF4F8]">
        <div class="w-60 h-16 bg-gradient-to-br from-[#EE8DB7] to-[#0B7ECE] rounded-sm"></div>
        <div class="px-4 lg:px-60 py-20">
            <h5 class="text-xl bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#737c8b] font-medium">Your Voyage, Expertly Covered</h5>
            <h3 class="lg:w-[50rem] text-4xl font-semibold mt-11 mb-8">
                Navigating the vast ocean of travel insurance options can be daunting.
            </h3>
            <div class="lg:grid lg:grid-cols-3 gap-12 mt-20">
                <div class="mb-14">
                    <img src="assets/img/icon_ship_yellow.svg" alt="">
                    <h5 class="text-2xl font-semibold mt-8 mb-7">Partnered with the Best</h5>
                    <p class="text-base text-[#5C6469]">
                        Our carefully selected travel insurance policies 
                        are designed to provide comprehensive cruise coverage, 
                        ensuring a worry-free experience on the high seas.
                    </p>
                    <button class="mt-8 text-[#656565] text-xl">Learn More ></button>
                </div>
                <div class="mb-14">
                    <img src="assets/img/icon_ship_pink.svg" alt="">
                    <h5 class="text-2xl font-semibold mt-8 mb-7">Tailored Policy Comparison</h5>
                    <p class="text-base text-[#5C6469]">
                        Our team meticulously compares coverage details across numerous plans, 
                        focusing specifically on features that are 
                        most relevant and beneficial for cruise-goers.
                    </p>
                    <button class="mt-8 text-[#656565] text-xl">Learn More ></button>
                </div>
                <div class="mb-14">
                    <img src="assets/img/icon_ship_blue.svg" alt="">
                    <h5 class="text-2xl font-semibold mt-8 mb-7">Customized Selection for You</h5>
                    <p class="text-base text-[#5C6469]">
                        We present you with the options that best suit your 
                        unique cruise itinerary and personal requirements, 
                        simplifying your decision-making process and ensuring a perfect match.
                    </p>
                    <button class="mt-8 text-[#656565] text-xl">Learn More ></button>
                </div>
            </div>
        </div>
        <div class="ml-auto w-[30rem] h-16 bg-gradient-to-br from-[#EE8DB7] to-[#0B7ECE] rounded-sm"></div>
    </section>

    <section class="pt-20 px-4 lg:px-60">
        <p class="text-xl font-medium">Why Cruise Insurance Matters</p>
        <div class="lg:flex gap-20 items-end">
            <h2 class="text-4xl font-semibold lg:w-[30rem] text-[#0D1F34] mt-12">Cruising offers a unique set of experiences</h2>
            <p class="text-xl text-[#5C6469] lg:w-[42rem] leading-normal mt-12 lg:mt-0">
                It comes with unique needs for protection. From missed port departures
                 to onboard medical emergencies, we've got you covered every nautical mile of your journey.
            </p>
        </div>
        <!-- Tabs -->
        <div class="w-full overflow-auto mt-6">
            <div class="flex lg:grid lg:grid-cols-4 gap-12">
                <div class="" @click="offerTab = 0">
                    <p class="py-4 w-auto whitespace-nowrap">Top-Tier Trip Interruption & Delay Benefits</p>
                    <div class="h-1 rounded-full" :class="offerTab == 0 ? 'bg-[#097CCD]' : 'bg-[#5FA8FFA1]'"></div>
                </div>
                <div class="" @click="offerTab = 1">
                    <p class="py-4 w-auto whitespace-nowrap">High-Level Emergency Evacuation</p>
                    <div class="h-1 rounded-full" :class="offerTab == 1 ? 'bg-[#097CCD]' : 'bg-[#5FA8FFA1]'"></div>
                </div>
                <div class="" @click="offerTab = 2">
                    <p class="py-4 whitespace-nowrap">Travel Inconvenience Options</p>
                    <div class="h-1 rounded-full" :class="offerTab == 2 ? 'bg-[#097CCD]' : 'bg-[#5FA8FFA1]'"></div>
                </div>
                <div class="" @click="offerTab = 3">
                    <p class="py-4 whitespace-nowrap">Add. Coverage Options for Your Voyage</p>
                    <div class="h-1 rounded-full" :class="offerTab == 3 ? 'bg-[#097CCD]' : 'bg-[#5FA8FFA1]'"></div>
                </div>
            </div>
        </div>
        <!-- Tab Panel -->
        <div v-if="offerTab == 0" class="rounded bg-[#edf1f9] mt-12 lg:flex items-center justify-between">
            <div class="p-12">
                <p class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#0D1F3420]">Top-Tier Trip Interruption & Delay Benefits</p>
                <h5 class="text-3xl font-semibold text-[#0D1F34] lg:w-[34rem] my-6">Navigate the seas knowing you're protected against the unexpected.</h5>
                <p class="lg:w-[36rem] text-base text-[#5C6469] mb-8">
                    Our plans offer substantial benefits for trip interruption and delays, 
                    including options like 'Interruption for Any Reason', 
                    perfect for the intricate nature of cruise schedules and unforeseen changes.
                </p>
                <Link href="/quote/create">
                    <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                        <span class="text-base">Get a Quote</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
            </div>
            <div class="bg-gradient-to-br from-[#EE8DB7] to-[#40AAF4] rounded">
                <img src="assets/img/img_tabs_1.png" alt="" class="ml-auto">
            </div>
        </div>
        <div v-if="offerTab == 1" class="rounded bg-[#edf1f9] mt-12 lg:flex items-center justify-between">
            <div class="p-12">
                <p class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#0D1F3420]">
                    High-Level Emergency Evacuation
                </p>
                <h5 class="text-3xl font-semibold text-[#0D1F34] lg:w-[34rem] my-6">
                    In the rare case of a serious medical emergency at Sea.
                </h5>
                <p class="lg:w-[36rem] text-base text-[#5C6469] mb-8">
                    Have peace of mind with our high-level emergency evacuation coverage. 
                    It ensures that you can access immediate transportation to a medical facility capable of providing the best care.
                </p>
                <Link href="/quote/create">
                    <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                        <span class="text-base">Get a Quote</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
            </div>
            <div class="bg-gradient-to-br from-[#EE8DB7] to-[#40AAF4] rounded">
                <img src="assets/img/img_tabs_2.png" alt="" class="ml-auto">
            </div>
        </div>
        <div v-if="offerTab == 2" class="rounded bg-[#edf1f9] mt-12 lg:flex items-center justify-between">
            <div class="p-12">
                <p class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#0D1F3420]">
                    Travel Inconvenience Options
                </p>
                <h5 class="text-3xl font-semibold text-[#0D1F34] lg:w-[34rem] my-6">
                    Tailored for the unique circumstances of cruise travel.
                </h5>
                <p class="lg:w-[36rem] text-base text-[#5C6469] mb-8">
                    This coverage caters to situations like Cruise Diversion and Cruise Disablement, 
                    providing support and compensation for the unique inconveniences faced by cruisers.
                </p>
                <Link href="/quote/create">
                    <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                        <span class="text-base">Get a Quote</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
            </div>
            <div class="bg-gradient-to-br from-[#EE8DB7] to-[#40AAF4] rounded">
                <img src="assets/img/img_tabs_3.png" alt="" class="ml-auto">
            </div>
        </div>
        <div v-if="offerTab == 3" class="rounded bg-[#edf1f9] mt-12 lg:flex items-center justify-between">
            <div class="p-12">
                <p class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#0D1F34] to-[#0D1F3420]">
                    Additional Coverage Options for Your Voyage
                </p>
                <h5 class="text-3xl font-semibold text-[#0D1F34] lg:w-[34rem] my-6">
                    Enhance your safety and convenience with our suite of additional coverage options.
                </h5>
                <p class="lg:w-[36rem] text-base text-[#5C6469] mb-8">
                    Protect your electronic/professional equipment, enjoy the peace of mind with rental car damage protection, 
                    and secure your trip with the essential Cancel for Any Reason (CFAR) benefit. 
                    Customize your policy for a seamless cruise experience.
                </p>
                <Link href="/quote/create">
                    <button class="w-52 h-14 bg-[#097CCD] text-white rounded hover:opacity-70">
                        <span class="text-base">Get a Quote</span>
                        <Icon type="ios-arrow-forward" class="ml-4" />
                    </button>
                </Link>
            </div>
            <div class="bg-gradient-to-br from-[#EE8DB7] to-[#40AAF4] rounded">
                <img src="assets/img/img_tabs_4.png" alt="" class="ml-auto">
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <TestimonialsSlider/>

    <Footer/>
</template>

<style>
html {
  scroll-behavior: smooth;
}
</style>
