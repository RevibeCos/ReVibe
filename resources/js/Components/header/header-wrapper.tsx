import { useTranslations } from "@/hooks";
import TranslationsProvider from "@/providers/translation-provider";
import Header from "./header";
import LanguageSelector from "./partials/LanguageSelector";
const i18nNamespaces = ["header"];

export default function HeaderWrapper() {
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
            <Header />
        </TranslationsProvider>
    );
}
