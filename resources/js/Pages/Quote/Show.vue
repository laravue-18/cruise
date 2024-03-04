<script setup>
import { reactive, computed, ref } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import NavMenu from '@/Shared/NavMenu.vue'
import Footer from '@/Shared/Footer.vue'
import MyRadioGroup from '@/Components/radio/MyRadioGroup.vue'
import MyRadio from '@/Components/radio/MyRadio.vue'
import { useQuoteForm } from '@/composables/quote-form.js'
import { store } from './store'
import axios from 'axios';

const form = useQuoteForm()

const props = defineProps({ benefit_groups: Array, product: Object, id: String })

let oform = useForm({})

if(props.product['provider'] == 'World Trips'){
    for(const buyup of props.product.quote['buyups']){
        if(form.cfar && buyup.code == 'CNI'){
            oform[buyup.code] = buyup['options'][0]['code']
        } else {
            oform[buyup.code] = 0
        }
    }
}else if(props.product['id'] == 4){
    oform['policy_max'] = 50000
    oform['deductible'] = 0
    oform['trip_delay'] = 2000
} else {
    oform['policy_max'] = 0
    oform['deductible'] = 0
}

const world_trip_premium = computed(() => {
    if(props.product['provider'] == 'World Trips'){
        let p = props.product['quote']['premiumAmount']
        for(const buyup of props.product.quote['buyups']){
            if(buyup.options) {
                for(const option of buyup['options']){
                    if(option.code == oform[buyup.code]){
                        p += option.premiumAmount
                    }
                }
            } else {
                if(oform[buyup.code]){
                    p += buyup.premiumAmount
                }
            }
        }
        return p
    }
})

const trawick_premium = computed(() => {
    if(props.product['provider'] == 'Trawick'){
        let p = props.product['quote']['quoteViewModelProductDetails'][0]['quoteResponseDetail']['totalPrice']
        for(const buyup of props.product.quote['availableOptions']){
            if(buyup.optionValues) {
                for(const option of buyup['optionValues']){
                    if(option.optionValue == oform[buyup.keyName]){
                        p += option.itemCost
                    }
                }
            } 
        }
        return p.toFixed(2)
    }
})

const geoblue_premium = computed(() => props.product['quote'][oform['deductible'] * 4 + oform['policy_max']]['Rate'])

let rslt = []
for(const group of props.benefit_groups){
    for(const type of group.benefit_types){
        if(props.product.group_benefits[type.id] && (props.product.group_benefits[type.id].length - 1)){
            rslt.push(type)
        }
    }
}
const options = [...new Set(rslt)];

const refreshTrawickPremium = () => {
    axios.post(route('products.price', props.product.id), {...form, ...oform})
        .then(res => res.data)
        .then(res => {
            trawick_premium.value = res
        })
}

const submit = () => {
    let ld = JSON.parse(localStorage.getItem("wiserData"));
    ld.oform = oform;
    if(props.product['provider'] == 'World Trips')
        ld.premium = world_trip_premium.value
    if(props.product['provider'] == 'Trawick')
        ld.premium = trawick_premium.value
    localStorage.setItem("wiserData", JSON.stringify(ld))
    router.get(route('quote.checkout', props.id))
}

const back = () => {
    window.history.back()
}
</script>

<template>
    <Head title="Upgrade"/>
    
    <section class="bg-[url('/assets/img/bg_create.png')] px-4 lg:px-60">
        <div class="py-8 flex items-center justify-between">
            <img src="/assets/img/logo.svg" alt="">
            <button class="w-52 h-14 border rounded-full hover:border-[#41a2df] bg-white">
                <i class="ivu-icon ivu-icon-md-call mr-2"></i> 123-456-7890 
            </button>
        </div>
        <div class="text-white py-16">
            <button class="hidden lg:block" @click="back"><Icon type="ios-arrow-back" />Go Back</button>
            <h2 class="text-5xl font-medium my-6">Optional Coverage Benefits</h2>
            <p class="text-md lg:text-xl mb-16">Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
        </div>
    </section>

    <section class="px-4 lg:px-60">
        <div class="lg:grid lg:grid-cols-3">
            <div class="sticky top-0 lg:top-20 lg:order-last z-10 mt-12">
                <div class="sticky top-0 lg:top-20 rounded-lg overflow-hidden flex flex-col shadow-2xl"
                    :class="['bg-[#DCF2FF]', 'bg-[#FFF8F1]'][index]" 
                >
                    <div class="px-8 py-12 text-center lg:text-left">
                        <span class="text-xs text-white bg-gradient-to-r px-6 py-2 rounded-full mt-4"
                            :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#FFB11A] to-[#FA667C]'][id]"
                        >
                            <span> {{ ['BEST VALUE PLAN', 'PREMIUM PLAN'][id] }} </span>
                        </span>
                        <p class="text-base font-medium text-[#0D1F34] mt-10">
                            {{ product['provider'] }}
                        </p>
                        <h4 class="text-4xl text-[#0D1F34] font-bold mt-5">{{ product['name'] }}</h4>
                        <div class="mt-7 justify-center lg:justify-start flex items-center gap-2.5 mb-6">
                            <h4 class="text-3xl text-[#0D1F34] font-bold">
                                <template v-if="product['provider'] == 'World Trips'" >${{ world_trip_premium }}</template>
                                <template v-if="product['provider'] == 'Trawick'" >${{ trawick_premium }}</template>
                                <template v-if="product['provider'] == 'Geoblue'" >${{ geoblue_premium }}</template>
                            </h4>
                            <div class="px-4 py-1 bg-[#EE8DB71F] rounded-full">
                                <span class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text"
                                    :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                                >
                                    {{ product['optional'] }} Optional Benefits
                                </span>
                            </div>
                        </div>
                        <div class="hidden lg:flex gap-10 text-[#555555] mt-6 mb-8">
                            <Link href="/quote/create">
                                <button class="text-xl text-[#555555] flex items-center gap-1 hover:text-[#097CCD]">
                                    <Icon type="ios-share-alt" size="24" class="-scale-x-100"/> Edit Trip
                                </button>
                            </Link>
                            <button class="text-xl flex items-center gap-1  hover:text-[#097CCD]">
                                <Icon type="ios-mail" size="24" /> Email My Quote
                            </button>
                        </div>
                        <div class="hidden lg:block divide-y">
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
                    <button class="w-full py-6 text-xl font-medium bg-gradient-to-r text-white hover:opacity-70"
                        :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                        @click="submit"
                    >
                        CHECKOUT
                    </button>
                </div>
            </div>
            <div class="col-span-2 lg:pr-36">
                
                <div v-if="product['provider'] == 'World Trips'" class="divide-y mb-12">
                    <template v-for="(buyup, index) in product.quote['buyups']" :key="index">
                        <template v-if="buyup.code == 'CNI'">
                            <template v-if="form['cfar']">
                                <div>
                                    <h3 class="text-4xl font-medium my-10"> 
                                        {{ buyup['name'] }} 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                            <path d="M12.4851 19.9403H15.0851V12.1403H12.4851V19.9403ZM13.7851 9.54033C14.1535 9.54033 14.4624 9.41553 14.712 9.16593C14.9616 8.91633 15.086 8.60779 15.0851 8.24033C15.0851 7.872 14.9603 7.56346 14.7107 7.31473C14.4611 7.066 14.1526 6.9412 13.7851 6.94033C13.4168 6.94033 13.1083 7.06513 12.8595 7.31473C12.6108 7.56433 12.486 7.87286 12.4851 8.24033C12.4851 8.60866 12.6099 8.91763 12.8595 9.16723C13.1091 9.41683 13.4177 9.54119 13.7851 9.54033ZM13.7851 26.4403C11.9868 26.4403 10.2968 26.0988 8.71515 25.4159C7.13348 24.733 5.75765 23.8069 4.58765 22.6378C3.41765 21.4678 2.49162 20.092 1.80956 18.5103C1.12749 16.9286 0.786023 15.2387 0.785156 13.4403C0.785156 11.642 1.12662 9.95199 1.80956 8.37033C2.49249 6.78866 3.41852 5.41283 4.58765 4.24283C5.75765 3.07284 7.13348 2.1468 8.71515 1.46474C10.2968 0.782671 11.9868 0.441205 13.7851 0.440338C15.5835 0.440338 17.2735 0.781805 18.8551 1.46474C20.4368 2.14767 21.8126 3.0737 22.9826 4.24283C24.1526 5.41283 25.0791 6.78866 25.762 8.37033C26.445 9.95199 26.786 11.642 26.7851 13.4403C26.7851 15.2387 26.4437 16.9286 25.7607 18.5103C25.0778 20.092 24.1518 21.4678 22.9826 22.6378C21.8126 23.8078 20.4368 24.7343 18.8551 25.4172C17.2735 26.1001 15.5835 26.4412 13.7851 26.4403ZM13.7851 23.8403C16.6885 23.8403 19.1476 22.8328 21.1626 20.8178C23.1776 18.8028 24.1851 16.3437 24.1851 13.4403C24.1851 10.537 23.1776 8.07783 21.1626 6.06283C19.1476 4.04783 16.6885 3.04033 13.7851 3.04033C10.8818 3.04033 8.42265 4.04783 6.40765 6.06283C4.39265 8.07783 3.38515 10.537 3.38515 13.4403C3.38515 16.3437 4.39265 18.8028 6.40765 20.8178C8.42265 22.8328 10.8818 23.8403 13.7851 23.8403Z" fill="#097CCD"/>
                                        </svg>
                                    </h3>
                                    <MyRadioGroup v-model="oform[buyup.code]" @on-change="updatePrice">
                                        <template v-for="(option, l) in buyup['options']" :key="l">
                                            <MyRadio :label="option.code" class="text-lg lg:flex items-center">
                                                <div class="flex-1 flex items-center justify-between">
                                                    <span>{{ option.name }}</span>
                                                    <span class="px-3 py-0.5 rounded-full bg-white font-medium text-[#] text-xl"> + ${{ option.premiumAmount }}</span> 
                                                </div>
                                            </MyRadio>
                                        </template>
                                    </MyRadioGroup>
                                </div>
                            </template>
                        </template>
                        <div v-else>
                            <h3 class="text-4xl font-medium my-10 flex items-center gap-4"> 
                                {{ buyup['name'] }} 
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                    <path d="M12.4851 19.9403H15.0851V12.1403H12.4851V19.9403ZM13.7851 9.54033C14.1535 9.54033 14.4624 9.41553 14.712 9.16593C14.9616 8.91633 15.086 8.60779 15.0851 8.24033C15.0851 7.872 14.9603 7.56346 14.7107 7.31473C14.4611 7.066 14.1526 6.9412 13.7851 6.94033C13.4168 6.94033 13.1083 7.06513 12.8595 7.31473C12.6108 7.56433 12.486 7.87286 12.4851 8.24033C12.4851 8.60866 12.6099 8.91763 12.8595 9.16723C13.1091 9.41683 13.4177 9.54119 13.7851 9.54033ZM13.7851 26.4403C11.9868 26.4403 10.2968 26.0988 8.71515 25.4159C7.13348 24.733 5.75765 23.8069 4.58765 22.6378C3.41765 21.4678 2.49162 20.092 1.80956 18.5103C1.12749 16.9286 0.786023 15.2387 0.785156 13.4403C0.785156 11.642 1.12662 9.95199 1.80956 8.37033C2.49249 6.78866 3.41852 5.41283 4.58765 4.24283C5.75765 3.07284 7.13348 2.1468 8.71515 1.46474C10.2968 0.782671 11.9868 0.441205 13.7851 0.440338C15.5835 0.440338 17.2735 0.781805 18.8551 1.46474C20.4368 2.14767 21.8126 3.0737 22.9826 4.24283C24.1526 5.41283 25.0791 6.78866 25.762 8.37033C26.445 9.95199 26.786 11.642 26.7851 13.4403C26.7851 15.2387 26.4437 16.9286 25.7607 18.5103C25.0778 20.092 24.1518 21.4678 22.9826 22.6378C21.8126 23.8078 20.4368 24.7343 18.8551 25.4172C17.2735 26.1001 15.5835 26.4412 13.7851 26.4403ZM13.7851 23.8403C16.6885 23.8403 19.1476 22.8328 21.1626 20.8178C23.1776 18.8028 24.1851 16.3437 24.1851 13.4403C24.1851 10.537 23.1776 8.07783 21.1626 6.06283C19.1476 4.04783 16.6885 3.04033 13.7851 3.04033C10.8818 3.04033 8.42265 4.04783 6.40765 6.06283C4.39265 8.07783 3.38515 10.537 3.38515 13.4403C3.38515 16.3437 4.39265 18.8028 6.40765 20.8178C8.42265 22.8328 10.8818 23.8403 13.7851 23.8403Z" fill="#097CCD"/>
                                </svg>
                            </h3>
                            <MyRadioGroup v-model="oform[buyup.code]" @on-change="updatePrice">
                                <MyRadio :label="0" class="text-lg flex items-center">
                                    <span>No Upgrade</span>
                                </MyRadio>
                                <MyRadio :label="1" class="text-lg flex items-center">
                                    <div class="flex-1 flex items-center justify-between">
                                        <p> Upgrade </p>
                                        <span class="px-3 py-0.5 rounded-full bg-white font-medium text-[#097CCD] text-xl"> + ${{ buyup.premiumAmount }}</span> 
                                    </div>
                                </MyRadio>
                            </MyRadioGroup>
                        </div>
                    </template>
                </div>
                <div v-if="product['id'] == 3" class="divide-y mb-12">
                    <template v-for="(buyup, index) in product.quote['availableOptions']" :key="index">
                        <template v-if="buyup.keyName == 'cancel_for_any_reason'">
                            <div></div>
                        </template>
                        <div v-else>
                            <h3 class="text-4xl font-medium my-10 flex items-center gap-4"> 
                                {{ buyup['fieldName'] }} 
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                    <path d="M12.4851 19.9403H15.0851V12.1403H12.4851V19.9403ZM13.7851 9.54033C14.1535 9.54033 14.4624 9.41553 14.712 9.16593C14.9616 8.91633 15.086 8.60779 15.0851 8.24033C15.0851 7.872 14.9603 7.56346 14.7107 7.31473C14.4611 7.066 14.1526 6.9412 13.7851 6.94033C13.4168 6.94033 13.1083 7.06513 12.8595 7.31473C12.6108 7.56433 12.486 7.87286 12.4851 8.24033C12.4851 8.60866 12.6099 8.91763 12.8595 9.16723C13.1091 9.41683 13.4177 9.54119 13.7851 9.54033ZM13.7851 26.4403C11.9868 26.4403 10.2968 26.0988 8.71515 25.4159C7.13348 24.733 5.75765 23.8069 4.58765 22.6378C3.41765 21.4678 2.49162 20.092 1.80956 18.5103C1.12749 16.9286 0.786023 15.2387 0.785156 13.4403C0.785156 11.642 1.12662 9.95199 1.80956 8.37033C2.49249 6.78866 3.41852 5.41283 4.58765 4.24283C5.75765 3.07284 7.13348 2.1468 8.71515 1.46474C10.2968 0.782671 11.9868 0.441205 13.7851 0.440338C15.5835 0.440338 17.2735 0.781805 18.8551 1.46474C20.4368 2.14767 21.8126 3.0737 22.9826 4.24283C24.1526 5.41283 25.0791 6.78866 25.762 8.37033C26.445 9.95199 26.786 11.642 26.7851 13.4403C26.7851 15.2387 26.4437 16.9286 25.7607 18.5103C25.0778 20.092 24.1518 21.4678 22.9826 22.6378C21.8126 23.8078 20.4368 24.7343 18.8551 25.4172C17.2735 26.1001 15.5835 26.4412 13.7851 26.4403ZM13.7851 23.8403C16.6885 23.8403 19.1476 22.8328 21.1626 20.8178C23.1776 18.8028 24.1851 16.3437 24.1851 13.4403C24.1851 10.537 23.1776 8.07783 21.1626 6.06283C19.1476 4.04783 16.6885 3.04033 13.7851 3.04033C10.8818 3.04033 8.42265 4.04783 6.40765 6.06283C4.39265 8.07783 3.38515 10.537 3.38515 13.4403C3.38515 16.3437 4.39265 18.8028 6.40765 20.8178C8.42265 22.8328 10.8818 23.8403 13.7851 23.8403Z" fill="#097CCD"/>
                                </svg>
                            </h3>
                            <MyRadioGroup v-model="oform[buyup.keyName]" @on-change="updatePrice">
                                <template v-for="option in buyup['optionValues']">
                                    <MyRadio :label="option.optionValue" class="text-lg lg:flex items-center">
                                        <div class="flex-1 lg:flex items-center justify-between">
                                            <p class="mt-4 mb-3 lg:my-0"> {{ option.displayText }} </p>
                                            <span class="px-3 py-0.5 rounded-full bg-white font-medium text-[#097CCD] text-xl"> + ${{ option.itemCost }}</span> 
                                        </div>
                                    </MyRadio>
                                </template>
                            </MyRadioGroup>
                        </div>
                    </template>
                </div>
                <div v-if="product['id'] == 4" class="divide-y mb-12">
                    <div class="mb-4">
                        <h3 class="text-4xl font-medium my-10"> Maximum Limit </h3>
                        <MyRadioGroup v-model="oform['policy_max']" @on-change="refreshTrawickPremium">
                            <MyRadio :label="50000" class="text-lg">$50,000</MyRadio>
                            <MyRadio :label="100000" class="text-lg">$100,000</MyRadio>
                            <MyRadio :label="250000" class="text-lg">$250,000</MyRadio>
                            <MyRadio :label="500000" class="text-lg">$500,000</MyRadio>
                        </MyRadioGroup>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-4xl font-medium my-10"> Deductible </h3>
                        <MyRadioGroup v-model="oform['deductible']" @on-change="refreshTrawickPremium">
                            <MyRadio :label="0" class="text-lg">$0</MyRadio>
                            <MyRadio :label="50" class="text-lg">$50</MyRadio>
                            <MyRadio :label="100" class="text-lg">$100</MyRadio>
                            <MyRadio :label="250" class="text-lg">$250</MyRadio>
                            <MyRadio :label="500" class="text-lg">$500</MyRadio>
                            <MyRadio :label="1000" class="text-lg">$1000</MyRadio>
                            <MyRadio :label="2500" class="text-lg">$2500</MyRadio>
                        </MyRadioGroup>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-4xl my-10"> Trip Delay </h3>
                        <MyRadioGroup v-model="oform['trip_delay']" @on-change="refreshTrawickPremium">
                            <MyRadio :label="2000" class="text-lg"> $2,000 ($150 per day) (12 hours) </MyRadio>
                            <MyRadio :label="4000" class="text-lg flex items-center">
                                <div class="flex-1 flex items-center justify-between">
                                    <span>$4,000 Maximum ($300 daily)</span>
                                    <span class="px-3 py-0.5 rounded-full bg-white font-medium text-[#097CCD] text-xl"> + $8.50</span> 
                                </div>
                            </MyRadio>
                            <MyRadio :label="7000" class="text-lg flex items-center">
                                <div class="flex-1 flex items-center justify-between">
                                    <span>$7,000 Maximum ($500 daily)</span>
                                    <span class="px-3 py-0.5 rounded-full bg-white font-medium text-[#097CCD] text-xl"> + $14.00</span> 
                                </div>
                            </MyRadio>
                        </MyRadioGroup>
                    </div>
                </div>
                <div v-if="product['provider'] == 'Geoblue'" class="divide-y mb-12">
                    <div class="mb-4">
                        <h3 class="text-4xl my-10"> Maximum Limit </h3>
                        <MyRadioGroup v-model="oform['policy_max']" @on-change="refreshTrawickPremium">
                            <MyRadio :label="0" class="text-lg">$50,000</MyRadio>
                            <MyRadio :label="1" class="text-lg">$100,000</MyRadio>
                            <MyRadio :label="2" class="text-lg">$500,000</MyRadio>
                            <MyRadio :label="3" class="text-lg">$1,000,000</MyRadio>
                        </MyRadioGroup>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-4xl my-10"> Deductible </h3>
                        <MyRadioGroup v-model="oform['deductible']" @on-change="refreshTrawickPremium">
                            <MyRadio :label="0" class="text-lg">$0</MyRadio>
                            <MyRadio :label="1" class="text-lg">$100</MyRadio>
                            <MyRadio :label="2" class="text-lg">$250</MyRadio>
                            <MyRadio :label="3" class="text-lg">$500</MyRadio>
                        </MyRadioGroup>
                    </div>
                </div>
                <button class="w-96 rounded-lg py-6 text-xl font-medium bg-gradient-to-r text-white hover:opacity-70"
                        :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#4D74FF] to-[#864DFF]'][id]"
                        @click="submit"
                    >
                        CHECKOUT
                    </button>
            </div>
        </div>
    </section>

    <Footer :quote="false" :bg="false"/>
</template>
