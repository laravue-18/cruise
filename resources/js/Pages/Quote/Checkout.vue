<script setup>
import { ref, computed } from 'vue'
import { Head, Link, useForm, router } from '@inertiajs/vue3'
import NavMenu from '@/Shared/NavMenu.vue'
import Footer from '@/Shared/Footer.vue'
import ErrorInput from '@/Components/ErrorInput.vue'
import CountryInput from '@/Shared/CountryInput.vue'
import StateInput from '@/Shared/StateInput.vue'
import CityInput from '@/Shared/CityInput.vue'
import Traveler from "./Partials/Traveler.vue";
import { useQuoteForm } from '@/composables/quote-form.js'
import { store } from './store'
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import { IMaskDirective } from 'vue-imask';
import * as InputIcons from '@/Components/icons';
import {cardMasks, expirationMask, securityMask} from './masks';
import cardTypes from './cardTypes';

let ld = JSON.parse(localStorage.getItem("wiserData"));

let oform = useForm(ld.oform)
const form = useQuoteForm()
const props = defineProps({ product: Object, id: Number })

const cpform = useForm({
    address1: '1234 Fake St',
    address2: '',
    city: 'Indianapolis',
    state: form['state'],
    zipCode: '32606',
    country: 'US',
    phones: ['555-123-4567'],
    emails: ['john@test.com'],

    cardNumber: '4111111111111111',
    cardHolder: 'Yurij Klimov',
    expireMonth: 9,
    expireYear: 2026,
    cvv: '123',
    sameAddress: true,
    terms: true,
})

const rules = computed(() => ({
    address1: { required },
    city: { required },
    state: { required },
    zipCode: { required },
    country: { required },
    emails: { required },
    cardHolder: { required },
    cvv: { required },
}))

const v$ = useVuelidate(rules, cpform);

const removePhone = (index) => {
    cpform.phones.splice(index, 1)
}

// Payment Card
const cardName = ref('')

const vImask = IMaskDirective

const onAccept = (e) => {
    const maskRef = e.detail
    const name = maskRef.masked.currentMask.cardtype;
    cpform.cardNumber = maskRef.value

    if (cardTypes.hasOwnProperty(name)) {
        cardName.value = cardTypes[name].name;

        return;
    }

    cardName.value = ''
};

const submit = async () => {
    const result = await v$.value.$validate();
    if(result) {
        router.post('', {
            form: {...form, ...oform},
            cpform,
            premium: ld.premium
        })
    }
}

const back = () => {
    window.history.back()
}


</script>

<template>
    <Head title="Checkout"/>
    <NavMenu :quote="false" :other="false" phone="info"/>

    <div class="px-4 lg:px-60 pt-8">
        <button class="text-[#555555]" @click="back"><Icon type="ios-arrow-back" />Go Back</button>

        <div v-if="product['provider'] == 'Geoblue'">
            <iframe name="contentWindow" title="Individual Sales Portal" src="https://individualsalesportal-staging.betahth.com/Session/SSO">
            </iframe>
        </div>
        <div v-else class="lg:grid lg:grid-cols-3">
            <!-- Left -->
            <div class="col-span-2 pr-0 lg:pr-36">
                <h2 class="text-5xl font-medium my-6">Purchase Policy</h2>
                <p class="text-xl text-[#555555] font-poppins mb-16">Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                <div class="divide-y mb-12">
                    <!-- Traveler Info -->
                    <div v-for="(traveler, index) in form.travelers" class="">
                        <h3 class="text-4xl my-10"> {{ index ? `Traveler ${index}` : 'You First' }} </h3>
                        <Traveler
                            v-model:f_name="traveler.f_name"
                            v-model:l_name="traveler.l_name"
                            v-model:m_name="traveler.m_name"
                            v-model:gender="traveler.gender"
                            v-model:birthday="traveler.birthday"
                        />
                    </div>
                    <!-- Contact Form -->
                    <div class="pb-16">
                        <h3 class="text-4xl my-10"> Primary Contact Information </h3>
                        <div>
                            <div class="mb-7">
                                <label class="text-[#606060] text-xl">Address line 1</label>
                                <Input type="text" v-model="cpform.address1" class="w-full mt-4" />
                                <ErrorInput :errors="v$.address1.$errors"/>
                            </div>
                            <div class="mb-7">
                                <label class="text-[#606060] text-xl">Address line 2</label>
                                <Input type="text" v-model="cpform.address2" class="w-full mt-4" />
                            </div>
                            <div class="grid grid-cols-2 gap-7 mb-7">
                                <div class="">
                                    <label class="text-[#606060] text-xl">City</label>
                                    <CityInput v-model="cpform.city" :country="cpform.country" :state="cpform.state" class="w-full mt-4" />
                                    <ErrorInput :errors="v$.city.$errors"/>
                                </div>
                                <div class="">
                                    <label class="text-[#606060] text-xl">State</label>
                                    <StateInput v-model="cpform.state" :country="cpform.country" class="w-full mt-4" />
                                    <ErrorInput :errors="v$.state.$errors"/>
                                </div>
                                <div class="">
                                    <label class="text-[#606060] text-xl">Zip</label>
                                    <Input type="text" v-model="cpform.zipCode" class="w-full mt-4" />
                                    <ErrorInput :errors="v$.zipCode.$errors"/>
                                </div>
                                <div class="">
                                    <label class="text-[#606060] text-xl">Country</label>
                                    <CountryInput v-model="cpform.country" class="mt-4"/>
                                    <ErrorInput :errors="v$.country.$errors"/>
                                </div>
                            </div>
                            <div>
                                <label class="text-[#606060] text-xl">Phone Number</label>
                                <div v-for="(phone, i) in cpform.phones" :key="i" class="flex items-center gap-8 mt-4">
                                    <Input type="text" :model-value="phone" @on-change="(e) => cpform.phones[i] = e.target.value" />
                                    <button :disabled="!cpform.phones.length" @click="removePhone(i)"
                                        
                                    >
                                        <Icon type="md-trash" size="24"/>
                                    </button>
                                </div>

                                <div class="text-right">
                                    <button class="text-[#FF9900] text-base mt-4" @click="cpform.phones.push('')">
                                        + Add Phone No
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="text-[#606060] text-xl">Email Address</label>
                                <div v-for="(email, i) in cpform.emails" :key="i" class="flex items-center gap-8 mt-4">
                                    <Input type="email" :model-value="email" @on-change="(e) => cpform.emails[i] = e.target.value" />
                                    <button :disabled="!cpform.emails.length" @click="removePhone(i)">
                                        <Icon type="md-trash" size="24"/>
                                    </button>
                                </div>

                                <div class="text-right">
                                    <button class="text-[#FF9900] text-base mt-4" @click="cpform.emails.push('')">
                                        + Add Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="pb-16">
                        <h3 class="text-4xl my-10"> Enter Secure Payment </h3>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="">
                                <label class="text-[#606060] text-xl">Card Number</label>
                                <div class="relative mt-4">
                                    <input
                                        :model-value="cpform.cardNumber"
                                        v-imask="cardMasks"
                                        @accept="onAccept"
                                        @complete="onAccept"
                                        class="w-full appearance-none rounded px-5 h-[60px] border-[#dcdee2] hover:border-[#ffad33] focus:border-[#ffad33] focus:shadow-[0_0_0_2px_rgba(255,153,0,0.2)] text-gray-700 text-[18px] focus:outline-none focus:ring-0"
                                    />
                                    <svg v-if="cardName" class="absolute inset-y-5 right-4" width="30" height="17" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <component :is="InputIcons[cardName]"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="">
                                <label class="text-[#606060] text-xl">Expires</label>
                                <div class="flex items-center gap-6 mt-4">
                                    <Select v-model="cpform.expireMonth">
                                        <Option value="01">01</Option>
                                        <Option value="02">02</Option>
                                        <Option value="03">03</Option>
                                        <Option value="04">04</Option>
                                        <Option value="05">05</Option>
                                        <Option value="06">06</Option>
                                        <Option value="07">07</Option>
                                        <Option value="08">08</Option>
                                        <Option value="09">09</Option>
                                        <Option value="10">10</Option>
                                        <Option value="11">11</Option>
                                        <Option value="12">12</Option>
                                    </Select>
                                    /
                                    <Select v-model="cpform.expireYear">
                                        <Option :value="2023">2023</Option>
                                        <Option :value="2023">2024</Option>
                                        <Option :value="2023">2025</Option>
                                        <Option :value="2023">2026</Option>
                                        <Option :value="2023">2027</Option>
                                        <Option :value="2023">2028</Option>
                                        <Option :value="2023">2029</Option>
                                        <Option :value="2023">2030</Option>
                                    </Select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-7 grid grid-cols-2 gap-8">
                            <div class="">
                                <label class="text-[#606060] text-xl">Name On Card</label>
                                <Input type="text" v-model="cpform.cardHolder" class="mt-4" />
                                <ErrorInput :errors="v$.cardHolder.$errors" />
                            </div>

                            <div class="grid grid-cols-2 gap-12">
                                <div>
                                    <label class="text-[#606060] text-xl">CVV</label>
                                    <Input type="text" v-model="cpform.cvv" class="mt-4" /> 
                                    <ErrorInput :errors="v$.cvv.$errors" />
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-[14px] mt-[14px]">
                            <Checkbox v-model="cpform.sameAddress">Use Same Address Entered Above</Checkbox>
                        </div>
                    </div>

                    <!-- Review Your Policy -->
                    <div>
                        <h3 class="text-4xl my-10"> Review Your Policy </h3>
                        <div class="bg-[#FCFCFCAD] py-10 pl-7 pr-20 rounded-xl border border-[#C7C7C7]">
                            <h4 class="text-xl text-[#272727] mb-5"> Terms & Conditions</h4>
                            <div class="overflow-y-auto">
                                <p class="text-lg text-[#909090] font-poppins">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat.
                                </p>
                                <p class="text-lg text-[#909090] font-poppins pt-5">
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                     eu fugiat nulla pariatur
                                </p>
                            </div>
                            <Checkbox v-model="cpform.terms" class="mt-7 text-xl text-[#787270]">I agree to the Terms & Conditions</Checkbox>
                        </div>
                    </div>
                </div>
                <button class="w-96 rounded-full py-6 text-xl font-medium bg-gradient-to-tr text-white hover:opacity-70"
                    :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                    @click="submit"
                >
                    COMPLETE CHECKOUT
                </button>
            </div>

            <!-- Product Info -->
            <div class="hidden lg:block sticky top-0 lg:top-20 lg:order-last z-10">
                <div class="sticky top-0 lg:top-20 rounded-lg overflow-hidden pb-6 flex flex-col shadow"
                    :class="['bg-[#FDF8F3]', 'bg-[#E8F7FF]'][id]" 
                >
                    <div class="text-center text-lg text-white font-poppins font-semibold py-2 lg:py-5"
                        :style="[
                            'background: var(--Linear, linear-gradient(92deg, #F90 7.93%, #FF6B00 103.12%));',
                            'background: var(--Linear, linear-gradient(93deg, #4D74FF 47.81%, #864DFF 99%));'
                            ][id]
                        "
                    >
                        <h3 class="hidden lg:block"> {{ ['BEST VALUE PLAN', 'PREMIUM PLAN'][id] }} </h3>
                    </div>
                    <div class="px-6 pt-11 pb-6">
                        <p class="text-lg text-[#555555] font-poppins font-semibold">
                            {{ product['provider'] }}
                        </p>
                        <h4 class="text-3xl text-[#333] mt-5">{{ product['name'] }}</h4>
                        <div class="mt-7 flex items-center gap-2.5 mb-6">
                            <h4 class="text-3xl text-[#2C2C2C]">
                                <template v-if="product['provider'] == 'Geoblue'">
                                    {{ product['quote'][oform['deductible'] * 4 + oform['policy_max']]['Rate'] }}
                                </template>
                                <template v-else>${{ ld.premium }}</template>
                            </h4>
                            <div class="px-4 py-2 bg-white rounded-full">
                                <span class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text"
                                    :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                                >
                                    {{ product['optional'] }} Optional Benefits
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-10 text-[#555555] mt-6 mb-8">
                            <Link href="/quote/create">
                                <button class="text-xl text-[#555555] flex items-center gap-1 hover:text-[#FF9900]">
                                    <Icon type="ios-share-alt" size="24" class="-scale-x-100"/> Edit Trip
                                </button>
                            </Link>
                            <button class="text-xl flex items-center gap-1  hover:text-[#FF9900]">
                                <Icon type="ios-mail" size="24" /> Email My Quote
                            </button>
                        </div>
                        <div class="divide-y">
                            <div class="py-4 flex items-center justify-between">
                                <span class="text-[#7E808A] text-xl">Destination</span>
                                <span class="text-[#393B48] text-xl font-medium">{{ form.destination }}</span>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <span class="text-[#7E808A] text-xl">Dates</span>
                                <span class="text-[#393B48] text-xl font-medium">{{ form.leave_date }} - {{ form.return_date }}</span>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <span class="text-[#7E808A] text-xl">Travelers</span>
                                <span class="text-[#393B48] text-xl font-medium">{{ form.num }} People</span>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <span class="text-[#7E808A] text-xl">Trip Cost</span>
                                <span class="text-[#393B48] text-xl font-medium">${{ form.total_trip_cost }}</span>
                            </div>
                        </div>
                    </div>
                    <button class="mt-4 mx-6 block rounded-full py-6 text-xl font-medium bg-gradient-to-tr text-white hover:opacity-70"
                        :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                        @click="submit"
                    >
                        COMPLETE CHECKOUT
                    </button>
                    
                </div>
            </div>

            
        </div>
    </div>

    <Footer :quote="false" :bg="false"/>
</template>