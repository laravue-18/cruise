<script setup>
import { ref } from 'vue'
import { Head, router } from '@inertiajs/vue3'
import NavMenu from '@/Shared/NavMenu.vue'
import Footer from '@/Shared/Footer.vue'
import { useQuoteForm } from '@/composables/quote-form.js'
import { store } from './store'
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'

const form = useQuoteForm()

const props = defineProps(['products', 'benefit_groups'])
store.products = props.products

const medicalModal = ref(false)

const handlerCoverageTypeChange = (value) => {
    if(value == 'comprehensive') {
        submit()
    } else {
        medicalModal.value = true
    }
}

const submit = () => {
    medicalModal.value = false
    form.post('/quote')
}

const closeMedicalModal = () => {
    medicalModal.value = false
    form.coverage_type = 'comprehensive'
}

const chooseProduct = (index) => {
    router.get(`/quote/${index}`)
}

const price = (product) => {
    try {
        let r = 0;
        if(product['provider'] == 'World Trips') {
            r = product['quote']['premiumAmount']
        } else if(product['provider'] == 'Trawick') {
            r = product['quote']['quoteViewModelProductDetails'][0]['quoteResponseDetail']['totalPrice']
        } else if(product['provider'] == 'Geoblue') {
            r = product['quote'] ? product['quote'][0]['Rate'] : 0
        }
        if(r) return r.toFixed(2)
    } catch (error) {
        return 0
    }
}

const isSticky = ref(false)

isSticky.value = window.scrollY > 40;
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 40) {
        isSticky.value = true;
    } else {
        isSticky.value = false;
    }
});

const emailModal = ref(false)
</script>

<template>
    <Head title="Quote Result"/>

    <!-- Desktop Design -->
    <div class="hidden lg:block">
        <section class="bg-[url('/assets/img/bg_create.png')] bg-top bg-no-repeat bg-[length:100%_80%] flex flex-col sticky top-0 z-10 bg-white -mb-12">
            <div class="py-8 flex items-center justify-between px-4 lg:px-60">
                <img src="/assets/img/logo.svg" alt="">
                <button class="w-52 h-14 border rounded-full hover:border-[#41a2df] bg-white">
                    <i class="ivu-icon ivu-icon-md-call mr-2"></i> 123-456-7890 
                </button>
            </div>
            <div class=" flex-1 px-4 lg:px-60 pt-4 grid grid-cols-3" :class="{'gap-12': !isSticky}">
                <div class="pr-10 text-white">
                    <h2 class="text-4xl font-medium lg:w-96 mb-12">Here Are The Best Plans For You</h2>
                    <Select v-if="!isSticky" v-model="form.coverage_type" @on-change="handlerCoverageTypeChange" class="text-white bg-blue-300 mb-10">
                        <Option value="comprehensive">Cancelation Plans</Option>
                        <Option value="medical">Medical Only</Option>
                    </Select>
                    <Modal v-model="medicalModal" :footer-hide="true" width="934px"
                        @on-cancel="closeMedicalModal"
                    >
                        <div class="p-4 lg:p-14">
                            <h3 class="text-3xl font-medium">You've Selected Medical Only Coverage</h3>
                            <p class="text-base py-9 text-[#555555] font-poppins">
                                To direct you to the exact plan that will serve you best, we have 2 more quick questions:
                            </p>
                            <div class="lg:flex items-center justify-between mb-9">
                                <h5 class="text-[#191919] text-2xl mb-4 lg:mb-0">Do you have a primary health insurance plan?</h5>
                                <div class="flex gap-5">
                                    <button 
                                        class="w-28 h-14 text-lg border rounded-lg"
                                        :class="{
                                            'border-[#FF9900] bg-white text-[#191919]': form.primary_health,
                                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': !form.primary_health,
                                        }"
                                        @click="form.primary_health = true"
                                    >Yes</button>
                                    <button 
                                        class="w-28 h-14 text-lg border rounded-lg"
                                        :class="{
                                            'border-[#FF9900] bg-white text-[#191919]': !form.primary_health,
                                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': form.primary_health,
                                        }"
                                        @click="form.primary_health = false"
                                    >No</button>
                                </div>
                            </div>
                            <div class="lg:flex items-center justify-between mb-9">
                                <h5 class="text-[#191919] text-2xl mb-4 lg:mb-0">Have you already departed on your trip?</h5>
                                <div class="flex gap-5">
                                    <button 
                                        class="w-28 h-14 text-lg border rounded-lg"
                                        :class="{
                                            'border-[#FF9900] bg-white text-[#191919]': form.departed,
                                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': !form.departed,
                                        }"
                                        @click="form.departed = true"
                                    >Yes</button>
                                    <button 
                                        class="w-28 h-14 text-lg border rounded-lg"
                                        :class="{
                                            'border-[#FF9900] bg-white text-[#191919]': !form.departed,
                                            'border-[#C7C7C7] bg-[#FFFFFFAD] text-[#BBBBBB]': form.departed,
                                        }"
                                        @click="form.departed = false"
                                    >No</button>
                                </div>
                            </div>
                            <div class="text-center lg:flex items-center gap-7">
                                <Button type="warning" shape="circle" class="w-full lg:w-48" @click="submit">
                                    SUBMIT
                                </Button>
                                <button class="text-[#979797] my-4" @click="closeMedicalModal">CANCEL</button>
                            </div>
                        </div>
                    </Modal>
                    <p v-if="!isSticky" class="text-base leading-loose mb-9">
                        We've compared hundreds of options to bring you the best matching 
                        travel insurance policies to fit you andyour itinerary.
                    </p>
                    <div class="flex gap-10">
                        <Link href="/quote/create">
                            <button class="text-xl text-white flex items-center gap-1 hover:text-[#FF9900]">
                                <Icon type="ios-share-alt" size="24" class="-scale-x-100"/> Edit Trip
                            </button>
                        </Link>
                        <Dropdown trigger="click" placement="bottom-end">
                            <button class="text-xl flex items-center gap-1  hover:text-[#FF9900]">
                                <Icon type="ios-mail" size="24" /> Email My Quote
                            </button>
                            <template #list class="mt-8">
                                <div class="p-7 lg:w-[30rem]">
                                    <p class="text-xl mb-4 lg:w-[18rem]">We'll email you quick access to these plans</p>
                                    <form @submit.prevent class="relative">
                                        <input
                                            type="email"
                                            class="appearance-none rounded-lg border-[#c7c7c7] w-full h-16 pl-4 pr-24 text-gray-700 text-lg border focus:outline-none focus:ring-0 focus:border focus:border-[#FF9900]"
                                            placeholder="Enter Email"
                                            >
                                        <button class="absolute right-0 h-16 w-32 bg-[#FF9900] text-white rounded-lg hover:bg-opacity-60">Submit</button>
                                    </form>
                                </div>
                            </template>
                        </Dropdown>
                    </div>
                </div>
                <template v-if="products.length == 1">
                    <div class="col-span-2">
                        <div class="rounded-lg overflow-hidden pb-6 bg-[#FDF8F3] flex flex-col">
                            <h3 v-if="!isSticky" 
                                class="text-center text-lg text-white font-poppins font-semibold py-4 bg-gradient-to-r from-[#F90] to-[#FF6B00]"
                            >
                                BEST VALUE PLAN
                            </h3>
                            <div class="grid grid-cols-2 p-5">
                                <div class="flex items-center">
                                    <div class="px-6 mt-5 flex-1">
                                        <p class="text-lg text-[#555555] font-poppins font-semibold">
                                            {{ products[0]['provider'] }}
                                        </p>
                                        <h4 class="text-3xl text-[#333] mt-5">{{ products[0]['name'] }}</h4>
                                        <div class="mt-7 flex items-center gap-2.5 mb-6">
                                            <h4 class="text-3xl text-[#2C2C2C]">
                                                ${{ price(products[0]) }}
                                            </h4>
                                            <div class="px-4 py-1 bg-white rounded-full">
                                                <span class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text from-[#F90] to-[#FF6B00]">
                                                    {{products[0]['optional']}} Optional Benefits
                                                </span>
                                            </div>
                                        </div>
                                        <button 
                                            class="w-full from-[#F90] to-[#FF6B00] mt-4 block border border-[#19191980] rounded-full py-4 text-xl font-medium hover:border-[#FDF8F3] hover:bg-gradient-to-tr hover:text-white"
                                            @click="chooseProduct(0)"
                                        >
                                            CHOOSE THIS POLICY
                                        </button>
                                    </div>
                                </div>
                                <div v-if="!isSticky" class="divide-y flex-1 px-6">
                                    <div v-for="highlight in products[0]['highlights']" class="py-3 flex items-center gap-3.5">
                                        <Icon type="ios-checkmark-circle" size="24" class="bg-gradient-to-r text-transparent bg-clip-text from-[#F90] to-[#FF6B00]"/>
                                        <p class="font-poppins font-medium text-[#333]">{{ highlight['highlight'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div v-for="(product, index) in products" 
                        class="rounded-t-lg rounded-b-sm overflow-hidden flex flex-col"
                        :class="['bg-[#DCF2FF]', 'bg-[#FFF8F1]'][index]"    
                    >
                        <div class="p-4">
                            <span v-if="!isSticky"
                                class="text-xs text-white bg-gradient-to-r px-6 py-2 rounded-full mt-4"
                                :class="[ 'from-[#EE8DB7] to-[#097CCD]', 'from-[#FFB11A] to-[#FA667C]'][index]"
                            >
                                <span>{{ ['BEST VALUE PLAN', 'PREMIUM PLAN'][index] }}</span>
                            </span>
                        </div>
                        <div class="px-5 py-5 flex-1">
                            <p class="text-base text-[#0D1F34] font-medium">
                                {{ product['provider'] }}
                            </p>
                            <h4 class="text-4xl text-[#0D1F34] font-bold lg:w-64 mt-5">{{ product['name'] }}</h4>
                            <div class="mt-5 flex items-center gap-2.5">
                                <h4 class="text-3xl text-[#0D1F34] font-bold">
                                    ${{ price(product) }}
                                </h4>
                                <div class="px-4 py-1 bg-white rounded-full">
                                    <span class="text-base font-medium bg-gradient-to-r text-transparent bg-clip-text"
                                        :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#FFB11A] to-[#FA667C]'][index]"
                                    >
                                        {{product['optional']}} Optional Benefits
                                    </span>
                                </div>
                            </div>
                            <div v-if="!isSticky" class="mt-5 divide-y flex-1">
                                <div v-for="highlight in product['highlights']" class="py-3 flex items-center gap-3.5">
                                    <Icon type="ios-checkmark-circle" size="24" 
                                        class="bg-gradient-to-r text-transparent bg-clip-text"
                                        :class="['from-[#EE8DB7] to-[#097CCD]', 'from-[#FFB11A] to-[#FA667C]'][index]"    
                                    />
                                    <p class="font-poppins font-medium text-[#333]">{{ highlight['highlight'] }}</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full py-4 text-xl text-white font-medium bg-gradient-to-tr hover:opacity-50"
                            :class="['to-[#EE8DB7] from-[#097CCD]', 'to-[#FFB11A] from-[#FA667C]'][index]"
                            @click="chooseProduct(index)"
                        >
                            CHOOSE THIS POLICY
                        </button>
                    </div>
                </template>
            </div>
        </section>

        <!-- Benefits Table -->
        <section class="px-4 lg:px-60">
            <template v-for="(group, i) in benefit_groups" :key="i">
                <div v-if="group.coverage_type == form.coverage_type" class="mb-12">
                    <h5 class="py-7 text-3xl font-medium">
                        {{ group.name}}
                    </h5>

                    <table>
                        <tbody>
                            <tr v-for="(row, j) in group.benefit_types" :key="j" class="hover:bg-[#7B7B7B12] group">
                                <td class="bg-[#7B7B7B0D] group-hover:bg-[#7B7B7B2E] text-xl px-0" style="width:33.3%;">
                                    <Poptip trigger="hover" v-if="row.tooltip" placement="bottom-start" class="w-full">
                                        <div class="p-5 flex items-center">{{ row.name }}</div>
                                        <template #content>
                                            <p class="w-[400px] font-poppins text-xl whitespace-normal">
                                                {{ row.tooltip }}
                                            </p>
                                        </template>
                                    </Poptip>
                                    <div v-else class="p-5">
                                        {{ row.name }}
                                    </div>
                                </td>
                                <td v-for="(product, k) in products" :key="k" class="group py-2 px-3 font-poppins text-lg hover:bg-[#7B7B7B2E]" :style="{width: products.length == 1 ? '66.6%' : '33.3%'}">
                                    <div class="relative">
                                        <template v-if="product.group_benefits[row.id] && product.group_benefits[row.id].length">
                                            <div class="divide-y">
                                                <p v-for="i in product.group_benefits[row.id][0].content.split(':')" class="py-2"> {{ i }} </p>
                                            </div>
                                            <!-- <p v-if="row.eligible">
                                                <template v-if="product.group_benefits[row.id][0].eligible - datediff(new Date(form['initialPaymentDate']), new Date()) > 0">
                                                    Eligible For {{ product.group_benefits[row.id][0].eligible - datediff(new Date(form['initialPaymentDate']), new Date()) }} More Days
                                                </template>
                                                <template v-else>
                                                    Not Eligible
                                                </template>
                                            </p> -->
                                        </template>
                                        <template v-else>
                                            <p class="text-center text-[#FFB79F]">Not Available</p>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </section>
    </div>

    <!-- Mobile Design -->
    <div class="lg:hidden bg-[#EBEBEB]">
        <div class="px-6 py-9 bg-white rounded-b-xl">
            <h2 class="text-xl font-medium mb-7">Here Are The Wisest Plans For You</h2>
            <p class="font-poppins text-sm text-[#555555] leading-loose mb-9">
                We've compared hundreds of 
                options to bring you the best matching travel insurance policies to fit you and
                your itinerary.
            </p>
            <Select v-model="form.coverage_type" @on-change="handlerCoverageTypeChange" class="mb-10" size="small">
                <Option value="comprehensive">Cancelation Plans</Option>
                <Option value="medical">Medical Only</Option>
            </Select>
            <div class="flex gap-10 text-[#2C2C2C]">
                <Link href="/quote/create">
                    <button class="text-xl text-[#191919] flex items-center gap-1 hover:text-[#FF9900]">
                        <Icon type="ios-share-alt" size="24" class="-scale-x-100"/> Edit Trip
                    </button>
                </Link>
                <Dropdown trigger="click" placement="bottom-end">
                    <button class="text-xl flex items-center gap-1  hover:text-[#FF9900]">
                        <Icon type="ios-mail" size="24" /> Email My Quote
                    </button>
                    <template #list class="mt-8">
                        <div class="p-7 lg:w-[30rem]">
                            <p class="text-xl mb-4 lg:w-[18rem]">We'll email you quick access to these plans</p>
                            <form @submit.prevent class="relative">
                                <input
                                    type="email"
                                    class="appearance-none rounded-lg border-[#c7c7c7] w-full h-16 pl-4 pr-24 text-gray-700 text-lg border focus:outline-none focus:ring-0 focus:border focus:border-[#FF9900]"
                                    placeholder="Enter Email"
                                    >
                                <button class="absolute right-0 h-16 w-32 bg-[#FF9900] text-white rounded-lg hover:bg-opacity-60">Submit</button>
                            </form>
                        </div>
                    </template>
                </Dropdown>
            </div>
        </div>
        <div class="mt-8 grid sticky top-0 z-10" :class="`grid-cols-${products.length}`">
            <div v-for="(product, index) in products" 
                class="rounded-lg overflow-hidden pb-6 flex flex-col shadow-lg"
                :class="['bg-[#FDF8F3]', 'bg-[#F4FBFF]'][index]"
            >
                <div class="h-2.5 bg-gradient-to-r"
                    :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][index]"
                ></div>
                <div class="pt-4 flex-1 text-center">
                    <p class="text-xs text-[#555555] font-poppins font-semibold">
                        {{ product['provider'] }}
                    </p>
                    <h4 class="text-base text-[#333]">{{ product['name'] }}</h4>
                    <h4 class="text-base text-[#2C2C2C] pt-3.5 pb-4">
                        ${{ price(product) }}
                    </h4>
                    <div class="inline-block px-3 bg-white rounded-full">
                        <span class="text-[11px] font-medium bg-gradient-to-r text-transparent bg-clip-text"
                            :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][index]"
                        >
                            {{product['optional']}} Optional Benefits
                        </span>
                    </div>
                    
                </div>
                <button 
                    :class="['from-[#F90] to-[#FF6B00]', 'from-[#4D74FF] to-[#864DFF]'][index]"
                    class="mt-4 mx-3 bg-white block border border-[#19191980] rounded-full py-3 text-[11px] font-medium hover:border-[#FDF8F3] hover:bg-gradient-to-tr hover:text-white"
                    @click="chooseProduct(index)"
                >
                    CHOOSE THIS POLICY
                </button>
            </div>
        </div>

        <!-- Benefits Table -->
        <section class="mb-7 border">
            <template v-for="(group, i) in benefit_groups" :key="i">
                <Disclosure as="div"  v-if="group.coverage_type == form.coverage_type" class="bg-white mb-7" v-slot="{open}">
                    <DisclosureButton class="w-full flex items-center justify-between px-6 py-4">
                        <h5 class="text-lg font-medium">
                            {{ group.name}}
                        </h5>
                        <Icon v-if="open" type="ios-arrow-up" size="24" class="text-[#FF9900]"/>
                        <Icon v-else type="ios-arrow-down" size="24" class="text-[#FF9900]"/>
                    </DisclosureButton>
                    <DisclosurePanel class="">
                        <div v-for="(row, j) in group.benefit_types" :key="j">
                            <div class="flex justify-between px-10 py-5 bg-[#FDF8F3] text-sm">
                                <span>{{ row.name }}</span>
                                <span>?</span>
                            </div>
                            <div class="grid divide-x" :class="`grid-cols-${products.length}`">
                                <div v-for="(product, k) in products" :key="k" class="group py-2 px-3 font-poppins text-sm">
                                    <div class="relative">
                                        <template v-if="product.group_benefits[row.id] && product.group_benefits[row.id].length">
                                            <div class="divide-y">
                                                <p v-for="i in product.group_benefits[row.id][0].content.split(':')" class="py-2"> {{ i }} </p>
                                            </div>
                                            <!-- <p v-if="row.eligible">
                                                <template v-if="product.group_benefits[row.id][0].eligible - datediff(new Date(form['initialPaymentDate']), new Date()) > 0">
                                                    Eligible For {{ product.group_benefits[row.id][0].eligible - datediff(new Date(form['initialPaymentDate']), new Date()) }} More Days
                                                </template>
                                                <template v-else>
                                                    Not Eligible
                                                </template>
                                            </p> -->
                                        </template>
                                        <template v-else>
                                            <p class="text-center text-[#FFB79F]">Not Available</p>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </DisclosurePanel>
                </Disclosure>
            </template>
        </section>
    </div>

    <Footer :quote="false" :bg="false"/>
</template>

<style scoped lang="less">
table{
    @apply w-full border-collapse border-[#6D6D6DB0] text-[#3D3D3D];
    tbody {
        tr {
            td {
                @apply border border-[#6D6D6DB0] w-1/3;
                
                &:not(:first-child) {
                    @apply bg-opacity-40 hover:bg-opacity-100;
                }
            }
        }
    }
}
</style>