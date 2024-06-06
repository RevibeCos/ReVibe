import React from 'react';
import { I18nextProvider } from 'react-i18next';
import { Resource, createInstance } from 'i18next';
import initTranslations from '@/utils/i18n';

type TranslationsProviderProps = {
    children: React.ReactNode;
    locale: string;
    namespaces: string[];
    resources?: Resource;
}

const TranslationsProvider: React.FC<TranslationsProviderProps> = ({ children, locale, namespaces, resources }) => {
    const i18n = React.useMemo(() => createInstance(), []);

    React.useEffect(() => {
        initTranslations(locale, namespaces, i18n, resources);
    }, [locale, namespaces, resources, i18n]);

    return <I18nextProvider i18n={i18n}>{children}</I18nextProvider>;
};

export default TranslationsProvider;