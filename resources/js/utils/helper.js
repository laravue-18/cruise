import { differenceInYears, parse } from 'date-fns'

let regionNames = new Intl.DisplayNames(['en'], {type: 'region'});

export const getCountryName = (countryCode) => {
    return regionNames.of(countryCode);;
}

export const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

export const datediff = (first, second) => {
    return Math.round((second - first)/(1000*60*60*24));
}

export const changeDateFormat = (d) => {
    let a = d.split('/')
    let t = a[0]
    a[0] = a[1]
    a[1] = t
    return a.join('/')
}

export const calculateAge = (birthday) => {
    const date = parse(birthday, 'MM/dd/yyyy', new Date())
    return differenceInYears(new Date(), date)
}