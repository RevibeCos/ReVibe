import { useState, useEffect } from "react";
import { DropdownMenu, Icon } from "@/shadcn";
import { bake_cookie } from "sfcookies";
import { useTranslation } from "react-i18next";
import { Check } from "lucide-react";
import { router } from "@inertiajs/react";

const LanguageSelector = () => {
    const { i18n } = useTranslation();
    const [language, setLanguage] = useState(i18n.language);

    const handleLangChange = (locale: string) => {
        bake_cookie("x-current-lang", locale);
        i18n.changeLanguage(locale).then(() => {
            setLanguage(locale);
            router.get(window.location.href, {
                // preserveScroll: true,
                // preserveState: true,
                // replace: true,
            });
        });
    };

    useEffect(() => {
        setLanguage(i18n.language);
    }, [i18n.language]);

    return (
        <DropdownMenu.Root icon={<Icon name="languages" />}>
            <DropdownMenu.Item
                className="flex items-center capitalize"
                onClick={() => handleLangChange("en")}
            >
                English
                <Check
                    className={`h-4 w-4 ml-auto ${
                        language === "en" ? "text-primary" : "text-transparent"
                    }`}
                />
            </DropdownMenu.Item>
            <DropdownMenu.Item
                className="flex items-center capitalize"
                onClick={() => handleLangChange("ar")}
            >
                عربي
                <Check
                    className={`h-4 w-4 ml-auto ${
                        language === "ar" ? "text-primary" : "text-transparent"
                    }`}
                />
            </DropdownMenu.Item>
        </DropdownMenu.Root>
    );
};

export default LanguageSelector;
