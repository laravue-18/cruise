<script setup>
import { computed, reactive, ref } from 'vue';
import { Calendar } from 'v-calendar';
import { format } from 'date-fns'

const hoverRange = reactive([]);

const props = defineProps({
    leave_date: String,
    return_date: String,
})

const emit = defineEmits(['update:leave_date', 'update:return_date'])

const isStart = ref(true)
const today = new Date()
const tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1)
const minDate = ref(tomorrow)
const maxDate = ref(null)

const attributes = computed(() => {
    let range = props.leave_date && props.return_date ? [props.leave_date, props.return_date] : [];
    return [
        
        {
            highlight: 'selected',
            dates: [[props.leave_date, props.return_date]],
        },
        {
            highlight: 'hover',
            dates: hoverRange.value,
        },
    ];
})

const dayClick = (e) => {
    if(e.date < minDate.value) return
    if(maxDate.value && e.date > maxDate.value) return
    const date = format(e.date, 'MM/dd/yyyy')
    if(isStart.value) {
        emit('update:leave_date', date)
        // minDate.value = e.date
        // maxDate.value = null
        isStart.value = false
    } else {
        emit('update:return_date', date)
        isStart.value = true
    }
    hoverRange.value = []
}

const dayMouseEnter = (e) => {
    if(isStart.value) {
        // if(props.return_date)
            hoverRange.value = [[e.date, props.return_date]]
    }else{
        hoverRange.value = [[props.leave_date, e.date]]
    }
}
</script>
<template>
    <Calendar ref="calendar"
        :masks="{weekdays: 'WWW'}"
        :attributes="attributes"
        :data="'MM/DD/YYYY'"
        :min-date="minDate"
        :max-date="maxDate"
        @dayclick="dayClick"
        @daymouseenter="dayMouseEnter"
        @daymouseleave="hoverRange.value = []"
        expanded 
    />
    
</template>