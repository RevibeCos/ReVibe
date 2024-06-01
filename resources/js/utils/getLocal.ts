import { bake_cookie, read_cookie } from "sfcookies";
import initTranslations from "./i18n";

export const getLocal = async (namespaces: string[]) => {
    const locale = read_cookie("x-current-lang");
    const localValue = typeof locale === "string" ? locale : "en";
    if (!locale[0]) {
        const defaultLanguage = "en";
        bake_cookie("x-current-lang", defaultLanguage);
    }
    return await initTranslations(localValue, namespaces);
};
