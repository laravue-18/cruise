<template>
    <div>
      <input
        type="text"
        v-model="dob"
        @focus="state = 'during'"
        @blur="state = dob.length === 10 ? 'completed' : 'before'"
        :class="borderColor"
        :placeholder="placeholder"
      />
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        dob: '',
        state: 'before', // 'before', 'during', 'completed'
      };
    },
    computed: {
      placeholder() {
        if (this.state === 'before') {
          return 'MM/DD/YYYY';
        }
        if (this.state === 'during' || this.state === 'completed') {
          return this.dob.padEnd(10, '_').replace(/(\d{2})(\d{0,2})(\d{0,4})/, '$1/$2/$3');
        }
      },
      borderColor() {
        switch (this.state) {
          case 'before':
            return 'border-gray-300'; // Tailwind class for before
          case 'during':
            return 'border-blue-500'; // Tailwind class for during
          case 'completed':
            return 'border-green-500'; // Tailwind class for completed
          default:
            return '';
        }
      },
    },
    watch: {
      dob(newValue) {
        // Format the input to match MM/DD/YYYY format
        let v = newValue.replace(/\D/g, '').slice(0, 8);
        if (v.length >= 4) {
          this.dob = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
        } else if (v.length >= 2) {
          this.dob = v.slice(0, 2) + '/' + v.slice(2);
        } else {
          this.dob = v;
        }
      },
    },
  };
  </script>
  
  <style>
  /* Additional custom styles if needed */
  </style>
  