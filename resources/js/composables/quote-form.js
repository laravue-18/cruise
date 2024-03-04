import { useForm } from "@inertiajs/vue3";
import { watch, reactive, ref } from 'vue'

export function useQuoteForm() {
    let ld = JSON.parse(localStorage.getItem("wiserData"));
    if(!ld) 
      ld = {form: {}}
    const lform = ld.form;
    
    const form = useForm({
      destination: lform.destination || [],
      num: lform.num || 1,
      travelers: lform.travelers || [{birthday: null}],
      state: lform.state || "",
      leave_date: (lform.leave_date && (new Date(lform.leave_date) > new Date())) ? lform.leave_date : null,
      return_date: (lform.return_date && (new Date(lform.leave_date) > new Date())) ? lform.return_date : null,
      total_trip_cost: lform.total_trip_cost || null,
      first_paid_at: lform.first_paid_at || null,
      left_to_pay: lform.payment_left || false,
      cfar: lform.cfar || false,
      coverage_type: lform.coverage_type || 'comprehensive',
      primary_health: lform.primary_health || false,
      departed: lform.departed || false,
    
      contact_address1: '1234 Fake St',
      contact_address2: '',
      contact_city: 'Indianapolis',
      contact_state: 'NY',
      contact_zipCode: '10005',
      contact_country: 'US',
      contact_phones: ['555-123-4567'],
      contact_emails: ['john@test.com'],

      payment_cardNumber: '',
      payment_cardHolder: 'Yurij Klimov',
      payment_expireMonth: 9,
      payment_expireYear: 2026,
      payment_cvv: '123',
    });

    watch(form, () => {
      ld.form = form;
      localStorage.setItem("wiserData", JSON.stringify(ld))
    })

    return form;
}