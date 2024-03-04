<template>
    <div class="relative border bg-white inline-block rounded-lg px-3 text-[#606060] border-[#dcdee2] hover:border-[#ffad33] focus-within:border-[#ffad33] focus-within:shadow-[0_0_0_2px_rgba(255,153,0,0.2)] text-2xl focus:outline-none focus:ring-0">
      <div class="h-20 flex flex-col justify-center">
        <label v-if="label" class="text-base" for="">{{ label }}</label>
        <input ref="el"
            :value="modelValue"
            @input="inputValue"
            @change="changeValue"
            placeholder="MM/DD/YYYY"
            class="appearance-none border-none focus:ring-0 mt-1"
        >
      </div>
      <div class="absolute right-5 inset-y-0 grid items-center">
        <template v-if="label == 'Departing'">
          <img src="/assets/img/plane.png">
        </template>
        <template v-if="label == 'Returning'">
          <img src="/assets/img/plane.png" class="-scale-x-100">
        </template>
      </div>
    </div>
    <!-- <span class="ml-3 mt-1 text-slate-500">'MM/DD/YYYY'</span> -->
</template>

<script setup>
import { ref, computed } from 'vue'
import { useIMask } from 'vue-imask';
import moment from 'moment';

const props = defineProps(['modelValue', 'label'])
const emit = defineEmits(['update:modelValue'])

// const value = computed({
//   get() {
//     return props.modelValue
//   },
//   set(value) {
//     if(!/\d{1,2}\/\d{1,2}\/\d{2,4}/.test(value)) {
//       value = ''
//     }
//     emit('update:modelValue', value)
//   }
// })

const inputValue = (e) => {
    let v = e.target.value
    if(/\d{2}\/\d{2}\/\d{4}/.test(v)) {
      // emit('update:modelValue', v)
    }
}

const changeValue = (e) => {
    let v = e.target.value
    if(/\d{2}\/\d{2}\/\d{4}/.test(v)) {
      emit('update:modelValue', v)
    }else{
      emit('update:modelValue', '')
    }
}

const momentFormat = 'MM/DD/YYYY';

const { el, masked } = useIMask({
  mask: Date,
  pattern: momentFormat,
  lazy: false,
  autofix: true,
//   eager: "append", // true, false, "append", "remove"
  min: new Date(1900, 0, 1),
  max: new Date(2030, 0, 1),

  format: date => moment(date).format(momentFormat),
  parse: str => moment(str, momentFormat),

  blocks: {
    YYYY: {
        mask: IMask.MaskedRange,
        from: 1900,
        to: 2030,
        placeholderChar: 'Y'
    },
    MM: {
        mask: IMask.MaskedRange,
        from: 1,
        to: 12,
        placeholderChar: 'M'
    },
    DD: {
        mask: IMask.MaskedRange,
        from: 1,
        to: 31,
        placeholderChar: 'D'
    },
    HH: {
      mask: IMask.MaskedRange,
      from: 0,
      to: 23
    },
    mm: {
      mask: IMask.MaskedRange,
      from: 0,
      to: 59
    }
  }
})

// IMask(element, {
//   mask: Date,  // enable date mask

//   // other options are optional
//   pattern: 'Y-`m-`d',  // Pattern mask with defined blocks, default is 'd{.}`m{.}`Y'
//   // you can provide your own blocks definitions, default blocks for date mask are:
//   blocks: {
//     d: {
//       mask: IMask.MaskedRange,
//       from: 1,
//       to: 31,
//       maxLength: 2,
//     },
//     m: {
//       mask: IMask.MaskedRange,
//       from: 1,
//       to: 12,
//       maxLength: 2,
//     },
//     Y: {
//       mask: IMask.MaskedRange,
//       from: 1900,
//       to: 9999,
//     }
//   },

//   // define date -> str convertion
//   format: date => {
//     const day = date.getDate();
//     const month = date.getMonth() + 1;
//     const year = date.getFullYear();

//     if (day < 10) day = "0" + day;
//     if (month < 10) month = "0" + month;

//     return [year, month, day].join('-');
//   },

//   // define str -> date convertion
//   parse: str => {
//     const yearMonthDay = str.split('-');
//     return new Date(yearMonthDay[0], yearMonthDay[1] - 1, yearMonthDay[2]);
//   },

//   // optional interval options
//   min: new Date(2000, 0, 1),  // defaults to `1900-01-01`
//   max: new Date(2020, 0, 1),  // defaults to `9999-01-01`

//   autofix: true,  // defaults to `false`

//   // pattern options can be set as well
//   lazy: false,

//   // and other common options
//   overwrite: true  // defaults to `false`
// })

// IMask(element, {
//   mask: Date,
//   pattern: momentFormat,
//   lazy: false,
//   min: new Date(1970, 0, 1),
//   max: new Date(2030, 0, 1),

//   format: date => moment(date).format(momentFormat),
//   parse: str => moment(str, momentFormat),

//   blocks: {
//     YYYY: {
//       mask: IMask.MaskedRange,
//       from: 1970,
//       to: 2030
//     },
//     MM: {
//       mask: IMask.MaskedRange,
//       from: 1,
//       to: 12
//     },
//     DD: {
//       mask: IMask.MaskedRange,
//       from: 1,
//       to: 31
//     },
//     HH: {
//       mask: IMask.MaskedRange,
//       from: 0,
//       to: 23
//     },
//     mm: {
//       mask: IMask.MaskedRange,
//       from: 0,
//       to: 59
//     }
//   }
// });

</script>