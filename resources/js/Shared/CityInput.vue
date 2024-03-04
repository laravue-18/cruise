<script setup>
import { computed, ref, reactive, watchEffect } from 'vue'
import { City } from "country-state-city";

const props = defineProps(['modelValue', 'country', 'state'])
const emit = defineEmits(['update:modelValue'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

let cityList = reactive([]);

watchEffect(() => {
    cityList = City.getCitiesOfState(props.country, props.state).map((city) => {
        return {
            label: city.name,
            value: city.name
        }
    })
});
</script>

<template>
    <Select v-model="value" filterable>
        <Option v-for="item in cityList" :value="item.value" :key="item.value">{{ item.label }}</Option>
    </Select>
</template>