<script setup>
import { computed } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, numeric, minValue, maxValue, helpers } from "@vuelidate/validators";
import ErrorInput from '@/Components/ErrorInput.vue';
import { differenceInYears, parse } from 'date-fns'

const props = defineProps(['f_name', 'm_name', 'l_name', 'gender', 'birthday'])
const emit = defineEmits(['update:f_name', 'update:l_name', 'update:m_name', 'update:gender', 'update:birthday'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

const rules = computed(() => ({
    f_name: { required },
    l_name: { required },
    gender: { required },
    birthday: { required }
}))

const v$ = useVuelidate(rules, props)

const calculateAge = (birthday) => {
    const date = parse(birthday, 'MM/dd/yyyy', new Date())
    return differenceInYears(new Date(), date)
}

const disabledDob = {
    disabledDate: (date) =>  differenceInYears(new Date(), date) < 55
}
</script>

<template>
    <div class="py-[22px]">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-8 mb-[1rem]">
            <div>
                <label class="text-[#606060] text-xl"> First Name </label>
                <Input type="text" :model-value="f_name" @change="$emit('update:f_name', $event.target.value)" class="w-full mt-4" />
                <ErrorInput :errors="v$.f_name.$errors"/>
            </div>
            <div>
                <label class="text-[#606060] text-xl"> Middle Name </label>
                <Input type="text" :model-value="m_name" @change="$emit('update:m_name', $event.target.value)" class="w-full mt-4"/>
            </div>
            <div>
                <label class="text-[#606060] text-xl">Last Name</label>
                <Input type="text" :model-value="l_name" @change="$emit('update:l_name', $event.target.value)" class="w-full mt-4"/>
                <ErrorInput :errors="v$.l_name.$errors"></ErrorInput>
            </div>
            <div>
                <label class="text-[#606060] text-xl">Age</label>
                <div class="mt-4 border rounded h-[60px] flex items-center px-3">
                    {{ calculateAge(birthday) }}
                </div>
            </div>
            <div>
                <label class="text-[#606060] text-xl">Gender</label>
                <Select :model-value="gender" @on-change="val => $emit('update:gender', val)" class="w-full mt-4">
                    <Option value="male">Male</Option>
                    <Option value="female">Female</Option>
                </Select>
                <ErrorInput :errors="v$.gender.$errors"></ErrorInput>
            </div>
            <div>
                <label class="text-[#606060] text-xl">Date Of Birth</label>
                <div class="mt-4 border rounded h-[60px] flex items-center px-3">
                    {{ birthday}}
                </div>
                <ErrorInput :errors="v$.birthday.$errors"/>
            </div>
        </div>
    </div>
</template>