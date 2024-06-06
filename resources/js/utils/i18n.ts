import { Resource, createInstance, i18n as I18nInstance } from "i18next";
import { initReactI18next } from "react-i18next";
import resourcesToBackend from "i18next-resources-to-backend";
import LanguageDetector from "i18next-browser-languagedetector";
import i18nConfig from "@/config/i18nConfig";

export default async function initTranslations(
    locale: string,
    namespaces: string[],
    i18nInstance?: I18nInstance,
    resources?: Resource
) {
    i18nInstance = i18nInstance || createInstance();
    i18nInstance.use(LanguageDetector).use(initReactI18next);

    if (!resources) {
        i18nInstance.use(
            resourcesToBackend((language: string, namespace: string) => {
                console.log({ namespace });
                return import(`../locales/${language}/${namespace}.json`);
            })
        );
    }

    await i18nInstance.init({
        lng: locale,
        resources,
        fallbackLng: i18nConfig.defaultLocale,
        supportedLngs: i18nConfig.locales,
        defaultNS: namespaces[0],
        fallbackNS: namespaces[0],
        ns: namespaces,
        preload: resources ? [] : i18nConfig.locales,
    });

    return {
        i18n: i18nInstance,
        resources: i18nInstance.services.resourceStore.data,
        t: i18nInstance.t,
    };
}
