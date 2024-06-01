import { useEffect, useState } from "react";
import { getLocal } from "@/utils/getLocal";

export const useTranslations = (namespaces: string[]) => {
    const [translations, setTranslations] = useState<{
        i18n: any;
        resources: any;
    } | null>(null);
    const loadTranslations = async () => {
        try {
            const result = await getLocal(namespaces);
            setTranslations(result);
        } catch (error) {
            console.log("err", error);
        }
    };
    useEffect(() => {
        loadTranslations();
    }, [namespaces]);
    return translations;
};
