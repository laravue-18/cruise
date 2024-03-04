import { reactive } from 'vue';
import { useQuoteForm } from '@/composables/quote-form.js'

const quoteForm = useQuoteForm()

let step = 1

export const store = reactive({
    quoteForm,
    coverage_type: 'comprehensive',
    products: [],
    selected: 0,
})