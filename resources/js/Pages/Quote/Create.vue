<script setup>
import { Head } from '@inertiajs/vue3'
import NavMenu from '@/Shared/NavMenu.vue'
import CountryInput from '@/Shared/CountryInput.vue'
import StateInput from '@/Shared/StateInput.vue'
import ErrorInput from '@/Components/ErrorInput.vue'
import DateInput from '@/Components/DateInput.vue'
import DateRange from '@/Components/DateRange.vue'
import Destination from './Partials/Destination.vue'
import Duration from './Partials/Duration.vue'
import { ref, computed } from 'vue'
import { useQuoteForm } from '@/composables/quote-form.js'
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { differenceInYears, subYears, parse, differenceInDays } from 'date-fns'

import 'v-calendar/style.css';

const form = useQuoteForm()

const step = ref(1)

const rules1 = computed(() => ({ destination: { required }}) )
const rules2 = computed(() => ({ num: { required }}) )
const rules3 = computed(() => ({ 
    travelers: {
        $each: helpers.forEach({ birthday: { required }})
    }
}) )
const rules4 = computed(() => ({ state: {required} }) )
const rules5 = computed(() => ({ leave_date: { required }, return_date: { required }}) )
const rules6 = computed(() => ({ total_trip_cost: { required } }) )
const rules7 = computed(() => ({ first_paid_at: { required } }) )

const v$1 = useVuelidate(rules1, form)
const v$2 = useVuelidate(rules2, form)
const v$3 = useVuelidate(rules3, form)
const v$4 = useVuelidate(rules4, form)
const v$5 = useVuelidate(rules5, form)
const v$6 = useVuelidate(rules6, form)
const v$7 = useVuelidate(rules7, form)

const goNext = async (i) => {
    if(i < 8) {
        const result = await eval(`v$${i}`).value.$validate()
        if(result) {
            ++step.value
        }
    } else if (i == 8) {
        ++step.value
    } else if (i == 9) {
        form.post('/quote')
    }
}

const goPrev = () => {
    --step.value
}

const increaseNum = () => {
    form.num++
    form.travelers = Array.from({ length: form.num}, () => ({birthday: null}))
}

const decreaseNum = () => {
    if(form.num > 1) {
        form.num--
        form.travelers = Array.from({ length: form.num}, () => ({birthday: null}))
    }
}

const numOfPeople = ref(null)

const isCfar = ref(true)

if(form.first_paid_at) {
    const diff = differenceInDays(new Date(), parse(form.first_paid_at, 'MM/dd/yyyy', new Date()))
    if(diff > 21) {
        form.cfar = false
        isCfar.value = false
    }
}

const firstPaidAtChange = (e) => {
    const diff = differenceInDays(new Date(), parse(e.target.value, 'MM/dd/yyyy', new Date()))
    if(diff > 21) {
        form.cfar = false
        isCfar.value = false
    }
}

</script>

<template>
    <Head title="Quote Form"/>
    
    <main v-if="step==1" class="">
        <div class="bg-[url('/assets/img/bg_create.png')] fixed top-0 bottom-0 left-0 right-0 -z-10">
            <img src="/assets/img/img_create.png" class="ml-auto h-screen" alt="" srcset="">
        </div>
        <div class="px-4 lg:px-60">
            <div class="lg:w-1/2 h-screen flex flex-col">
                <div class="py-10">
                    <img src="/assets/img/logo.svg" alt="" srcset="">
                </div>
                <div class="flex-1 flex flex-col justify-center">
                    <div class="">
                        <Destination v-model="form.destination"/>
                        <ErrorInput :errors="v$1.destination.$errors"/>
                        <button class="w-full lg:w-52 h-16 rounded text-[#0D1F34] text-lg bg-white mt-12 lg:px-6 flex items-center lg:justify-between" @click="goNext(1)">
                            <span>Next</span>
                            <Icon type="ios-arrow-forward" />
                        </button>
                        <div class="mt-16">
                            <div class="flex items-center gap-2">
                                <input id="multiple_destinations" v-model="form.multiple_destinations" type="checkbox" name="checkbox-example" 
                                    class="transition duration-100 ease-in-out rounded bg-transparent border border-white checked:border-white focus:ring-2 focus:ring-blue-200 focus:outline-none focus:ring-opacity-50 focus:ring-offset-0 disabled:opacity-50 disabled:cursor-not-allowed text-[#41a2df]">
                                <label for="multiple_destinations" class="text-xl text-white font-light">Multiple Destinations?</label>
                            </div>
                        </div>
                        <p class="mt-6 text-white">Please use the location where you will be spending most of your trip.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <main v-else class="min-h-screen bg-[#e5f4ff] flex flex-col">
        <div class="py-8 flex items-center justify-between px-4 lg:px-60">
            <img src="/assets/img/logo-dark.svg" alt="">
            <button class="w-52 h-14 border rounded-full hover:border-[#41a2df] bg-white">
                <i class="ivu-icon ivu-icon-md-call mr-2"></i> 123-456-7890 
            </button>
        </div>
        <div class=" lg:w-[50rem] lg:ml-[38rem] flex-1 flex flex-col justify-between lg:justify-center px-4 lg:px-0">
            <div v-if="step==2">
                <div class="relative text-4xl">
                    <div class="lg:absolute right-full lg:flex mb-12"><span>2.</span> <span class="text-[#48484875] mx-10 hidden lg:block">-</span></div>
                    <h4 class="">Number of Cruisers?</h4>
                </div>
                <p class="text-2xl text-[#191919] font-poppins mt-9">How many travelers are you purchasing travel insurance for?</p>
                <div @click="$refs.numOfPeople.focus()"
                    class="mt-10 border rounded-lg bg-white lg:w-[30rem] lg:h-16 flex items-center pl-9 pr-6 focus-within:border-[#097CCD] py-6"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 27 26" fill="none">
                        <path d="M13.5 0.343292C15.1879 0.343292 16.8067 1.01381 18.0002 2.20734C19.1937 3.40087 19.8643 5.01964 19.8643 6.70755C19.8643 8.39546 19.1937 10.0142 18.0002 11.2078C16.8067 12.4013 15.1879 13.0718 13.5 13.0718C11.8121 13.0718 10.1933 12.4013 8.99979 11.2078C7.80626 10.0142 7.13574 8.39546 7.13574 6.70755C7.13574 5.01964 7.80626 3.40087 8.99979 2.20734C10.1933 1.01381 11.8121 0.343292 13.5 0.343292ZM13.5 16.2539C20.5325 16.2539 26.2285 19.1019 26.2285 22.6182V25.8003H0.771484V22.6182C0.771484 19.1019 6.46749 16.2539 13.5 16.2539Z" fill="#097CCD"/>
                    </svg>
                    <input v-model="form.num" ref="numOfPeople"
                        class="appearance-none border-none focus:ring-0 ml-8 w-6 text-lg font-medium"
                        @change="e => form.travelers = Array.from({ length: Number(e.target.value)}, () => ({birthday: null}))"
                    />
                    <div class="flex-1 text-lg font-medium">People</div>
                    <button class="w-8 h-8 border rounded mr-3 hover:border-[#097CCD]" @click="increaseNum">
                        <Icon type="ios-arrow-up" />
                    </button>
                    <button class="w-8 h-8 border rounded hover:border-[#097CCD]" @click="decreaseNum">
                        <Icon type="ios-arrow-down" />
                    </button>
                </div>
                <ErrorInput :errors="v$2.num.$errors"/>
            </div>
        
            <div v-if="step==3" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>3.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Date(s) of birth</h4>
                </div>
                <p class="text-2xl text-[#555555] font-poppins my-10">When were you born? Be proud, older means wiser!</p>
                <template v-for="(traveler, i) in form.travelers">
                    <div class="mt-5 relative">
                        <div class="absolute right-full text-xl whitespace-pre mr-8 top-1/2 -translate-y-1/2">{{ i == 0 ? 'You' : `Traveler ${i + 1}` }}</div>
                        <DateInput v-model="traveler.birthday"/>
                        <!-- <DatePicker 
                            :model-value="traveler.birthday"
                            @on-change="val => traveler.birthday = val"
                            size="large" class="w-full mt-2" format="MM/dd/yyyy"
                            :options="disabledDob"
                            :start-date="subYears(new Date(), 60)"
                        /> -->
                    </div>
                    <ErrorInput :errors="v$3.travelers.$each.$response.$errors[i].birthday"/>
                </template>
            </div>
        
            <div v-if="step==4" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>4.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">State you reside in?</h4>
                </div>
                <p class="text-2xl text-[#555555] font-poppins mt-8 mb-12">Where do you currently live?</p>
                <StateInput v-model="form.state" country="US" class="w-[43rem]" size="large"/>
                <ErrorInput :errors="v$4.state.$errors"/>
            </div>
        
            <div v-if="step==5" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>5.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Departing</h4>
                </div>
                <p class="text-2xl text-[#555555] font-poppins my-10">
                    When do you leave home
                </p>
                <div>
                    <DateInput v-model="form.leave_date" label="Departing"/> 
                    <ErrorInput :errors="v$5.leave_date.$errors"/>
                </div>
                
                <div class="border border-[#48484875] my-9"/>

                <h4 class="text-3xl mb-9"> Returning</h4>
                <p class="text-2xl text-[#555555] font-poppins mb-10">
                    When do you return home
                </p>
                
                <div class="flex gap-10">
                    <div>
                        <DateInput v-model="form.return_date" label="Returning"/>
                        <ErrorInput :errors="v$5.return_date.$errors"/>
                    </div>
                </div>
            </div>
        
            <div v-if="step==6" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>6.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Total estimated pre-departure trip cost?</h4>
                </div>
                <p class="text-2xl font-poppins text-[#555555] my-10">
                    Including airfare, hotel, car and any other costs paid for prior to <br/>
                    departure (unless purchased with points or miles)
                </p>
                <InputNumber
                    :max="1000000"
                    v-model="form.total_trip_cost"
                    size="large" style="width: 100%"
                    :formatter="value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                    :parser="value => value.replace(/\$\s?|(,*)/g, '')" />
                <ErrorInput :errors="v$6.total_trip_cost.$errors"/>
            </div>
            
            <div v-if="step==7" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>7.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Date you made first trip payment?</h4>
                </div>
                <p class="text-2xl font-poppins text-[#555555] my-10">
                    (airfare or any other prepaid trip cost  - whichever came first)
                </p>
                <DateInput v-model="form.first_paid_at" @change="firstPaidAtChange"/>
                <ErrorInput :errors="v$7.first_paid_at.$errors"/>
            </div>
                
            <div v-if="step==8" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>8.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Any pre-departure trip costs payments left to pay?</h4>
                </div>
                <p class="text-2xl text-[#555555] font-poppins my-10">
                    Important to ensure you can be covered for pre-existing cond
                </p>
                <div>
                    <button 
                        class="w-32 lg:w-52 h-20 text-3xl border  rounded-lg mr-10"
                        :class="{
                            'border-[#FF9900] bg-white text-[#191919]': form.left_to_pay,
                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': !form.left_to_pay,
                        }"
                        @click="form.left_to_pay = true"
                    >Yes</button>
                    <button 
                        class="w-32 lg:w-52 h-20 text-3xl border  rounded-lg mr-10"
                        :class="{
                            'border-[#FF9900] bg-white text-[#191919]': !form.left_to_pay,
                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': form.left_to_pay,
                        }"
                        @click="form.left_to_pay = false"
                    >No</button>
                </div>
                
            </div>
            
            <div v-if="step==9" class="">
                <div class="relative text-3xl">
                    <div class="absolute right-full flex"><span>9.</span> <span class="text-[#48484875] mx-10">-</span></div>
                    <h4 class="">Do you want optional Cancel For Any <br/> Reason (CFAR) coverage?</h4>
                </div>
                <p class="text-2xl text-[#555555] font-poppins my-10">
                    These premium benefits allow you to cancel your trip for any
                    reasons beyond the usual policy terms, covering up to 75% of your 
                    prepaid, non-refundable travel expenses.
                </p>
                <p class="text-2xl text-[#555555] font-poppins mb-10">
                    To activate these options, you purchase your policy typically within 14 days,
                    and sometimes up to 21 days, of your first trip payment. Just make sure to 
                    insure the full amount of your non-refundable trip costs and be medically fit 
                    for travel at the time of purchas
                </p>
                <div>
                    <button 
                        class="w-32 lg:w-52 h-20 text-3xl border  rounded-lg mr-10"
                        :class="{
                            'border-[#FF9900] bg-white text-[#191919]': form.cfar,
                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': !form.cfar,
                        }"
                        @click="form.cfar = true"
                        :disabled="!isCfar"
                    >Yes</button>
                    <button 
                        class="w-32 lg:w-52 h-20 text-3xl border  rounded-lg mr-10"
                        :class="{
                            'border-[#FF9900] bg-white text-[#191919]': !form.cfar,
                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': form.cfar,
                        }"
                        @click="form.cfar = false"
                    >No</button>
                </div>
                
            </div>

            <div class="flex flex-wrap justify-center lg:justify-start gap-7 mt-12 mb-8">
                <button class="w-full lg:w-64 h-16 bg-[#097CCD] text-white rounded-lg hover:opacity-70 mr-4" @click="goNext(step)">
                    <span class="text-lg mr-16"> {{ true ? (step == 9 ? 'Submit For Quote' : 'Next') : (step == 8 ? 'Submit For Quote' : 'Next') }} </span>
                    <Icon type="ios-arrow-forward" />
                </button>
                <button class="text-[#979797] hover:text-[#097CCD] text-lg" @click="goPrev">
                    <Icon type="md-share-alt" class="-scale-x-100 mr-2" />
                    <span>Previous Question</span>
                </button>
            </div>
        </div>
    </main>
</template>