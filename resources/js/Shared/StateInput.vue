<script setup>
import { computed, ref, reactive, onMounted, watchEffect } from 'vue'
import { State} from "country-state-city";

const props = defineProps(['modelValue', 'country'])
const emit = defineEmits(['update:modelValue'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

let stateList = reactive([]);

watchEffect(() => {
    stateList = State.getStatesOfCountry(props.country).map((state) => {
        return {
            label: state.name,
            value: state.isoCode
        }
    })
});
</script>

<template>
    <Select v-model="value" filterable>
        <Option v-for="item in stateList" :value="item.value" :key="item.value">{{ item.label }}</Option>
    </Select>
</template>