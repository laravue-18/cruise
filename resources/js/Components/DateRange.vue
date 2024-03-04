<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    leave_date: String,
    return_date: String,
})

const emit = defineEmits(['update:leave_date', 'update:return_date'])

const currentDate = new Date();
const year = ref(currentDate.getFullYear());
const month = ref(currentDate.getMonth());

const cells = computed(() => {
    let cells = [];
    const firstDayOfMonth = new Date(year.value, month.value, 1);
    const startingDayOfWeek = firstDayOfMonth.getDay();
    const daysInPreviousMonth = new Date(year.value, month.value, 0).getDate();
    const daysInMonth = new Date(year.value, month.value + 1, 0).getDate();

    // Fill in the space with days from the previous month
    for (let i = startingDayOfWeek; i > 0; i--) {
        cells.push('');
    }

    // Fill in the days of the current month
    for (let i = 1; i <= daysInMonth; i++) {
        cells.push(i);
    }

    // Adjust the grid to be a multiple of 7 (weeks)
    const remainingCells = 7 - (cells.length % 7);
    if (remainingCells < 7) {
    for (let i = 1; i <= remainingCells; i++) {
            cells.push('');
    }
    }
    return cells;
})
const prevMonth = (side) => {
    console.log(side);
}

const nextMonth = (side) => {
    console.log(side);
}
</script>

<template>
    <div class="bg-white border border-[#C7C7C7] rounded-lg inline-block text-[#555555]">
        <div class="flex justify-between items-center px-7 py-9">
            <span @click="prevMonth('left')"><Icon type="ios-arrow-back"></Icon></span>
            <span class=" text-xl font-poppins font-semibold">
                {{ ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][month] }} 
                 {{ year }}</span>
            <span @click="nextMonth('left')"><Icon type="ios-arrow-forward"></Icon></span>
        </div>
        <div class="px-7 grid grid-cols-7 gap-x-14 gap-y-4 pb-10">
            <span v-for="day in ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']" class="py-4 text-center">{{ day }}</span>
            <button v-for="day in cells" class="w-8 h-8 text-center rounded-full hover:bg-[#FF9900B0] hover:text-white">{{ day }}</button>
        </div>
    </div>
</template>