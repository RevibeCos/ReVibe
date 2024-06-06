import { useTranslations } from "@/hooks";
import TranslationsProvider from "./translation-provider";

const I18nProviderWrapper: React.FC<{
    children: React.ReactNode;
    i18nNamespaces: string[];
}> = ({ children, i18nNamespaces }) => {
    const translations = useTranslations(i18nNamespaces);
    if (!translations) {
        return <div>Loading...</div>;
    }
    const { i18n, resources } = translations;
    return (
        <TranslationsProvider
            locale={i18n.language}
            namespaces={i18nNamespaces}
            resources={resources}
        >
            <main>{children}</main>
        </TranslationsProvider>
    );
};
export default I18nProviderWrapper;