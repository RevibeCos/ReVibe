import React from "react";
import { useTranslations } from "@/hooks";
import TranslationContextProvider from "./translation-context-provider";

type I18nProviderWrapperProps = {
    children: React.ReactNode;
    i18nNamespaces: string[];
};

const TranslationLoaderWrapper: React.FC<I18nProviderWrapperProps> = ({
    children,
    i18nNamespaces,
}) => {
    const { translations, error } = useTranslations(i18nNamespaces);

    if (error) {
        return <div>Error: {error}</div>;
    }

    if (!translations) {
        return <div>Loading...</div>;
    }

    const { i18n, resources } = translations;

    return (
        <TranslationContextProvider
            locale={i18n.language}
            namespaces={i18nNamespaces}
            resources={resources}
        >
            {children}
        </TranslationContextProvider>
    );
};

export default TranslationLoaderWrapper;
