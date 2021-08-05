// TODO: If this is intended for other locales, internationalization will be needed
export function dateFilter(_date){
    if(!_date){
        return '';
    }
    _date = new Date(_date);
    const locale = 'en-us';
    return _date.toLocaleString(locale, { month: 'long', day: 'numeric', year: 'numeric' });
}
