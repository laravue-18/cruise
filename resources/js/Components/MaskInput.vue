<template>
    <input ref="el">
</template>

<script>
import { useIMask } from 'vue-imask';

export default {
    setup (props) {
    const { el, masked } = useIMask({
        mask: Number,
        radix: '.',
    });

    return { el };
    }
}
</script>