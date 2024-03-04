<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { TransitionRoot } from '@headlessui/vue'
import {Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import 'swiper/css'

const swp = ref(null)
const setSwiper = (swiper) => {
    swp.value = swiper
}
const active = ref(0)
let interval

onMounted(() => {      
  interval = setInterval(() => {
    active.value = active.value + 1 === testimonials.length ? 0 : active.value + 1
  }, 2000)
})

onUnmounted(() => clearInterval(interval))

const testimonials = [
    {
        img: 'assets/img/profile1.png',
        quote: "We love WISERS because they pay attention to senior details and whoever I talk to is very knowledgeable about coverage options!",
        name: 'Rachel B.',
        trip: 'From New Jersey Traveled to Italy'
    },
    {
        img: 'assets/img/profile1.png',
        quote: "We love WISERS because they pay attention to senior details and whoever I talk to is very knowledgeable about coverage options!",
        name: 'Rachel B.',
        trip: 'From New Jersey Traveled to Italy'
    },
    {
        img: 'assets/img/profile1.png',
        quote: "We love  because they pay attention to senior details and whoever I talk to is very knowledgeable about coverage options!",
        name: 'Linda',
        trip: 'From New Jersey Traveled to Italy'
    }
]
</script>

<template>
    <section class="py-32 container px-4">
        <h5 class="text-center text-[#097CCD] text-2xl font-poppins font-semibold px-24">
            SAVVY SAILERS CHOOSE US
        </h5>

        <swiper class="mySwiper"
            :spaceBetween="30"
            :autoplay="{ delay: 300000 }"
            :modules="[ Autoplay ]"
            :loop="true"
            @swiper="setSwiper"
        >
            <template v-for="(testimonial, index) in testimonials">
                <swiper-slide>
                    <div class="">
                        <h3 class="lg:w-[58rem] mx-auto text-center text-4xl font-medium leading-relaxed mt-7 mb-12">
                            {{ testimonial.quote }}
                        </h3>
                        <p class="text-center text-2xl mb-4">{{ testimonial.name }}</p>
                        <p class="text-center text-lg text-slate-600">{{ testimonial.trip }}</p>
                        <div class="flex justify-center items-center gap-8 mt-9">
                            <button @click="swp.slidePrev()" class="text-[#FF9900]">
                                <Icon type="ios-arrow-round-back" size="40"/>
                            </button>
                            <img src="assets/img/profile1.png" class="rounded-full" alt="">
                            <button @click="swp.slideNext()" class="text-[#FF9900]">
                                <Icon type="ios-arrow-round-forward" size="40"/>
                            </button>
                        </div>
                    </div>
                </swiper-slide>
            </template>
        </swiper>
    </section>
</template>