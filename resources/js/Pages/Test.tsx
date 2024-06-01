import { useTranslation } from 'react-i18next';

const Test = ()=>{
    const {t} = useTranslation()
    return <div>{t('Badge')}</div>


    
}
export default Test;