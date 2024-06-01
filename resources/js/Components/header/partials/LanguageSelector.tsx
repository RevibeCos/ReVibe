import { useState } from 'react'; // Import useState hook
import { DropdownMenu, Icon } from "@/shadcn";
import { bake_cookie } from "sfcookies";
import { useTranslation } from "react-i18next";
import { Check } from "lucide-react";
import { router } from "@inertiajs/react";

const LanguageSelector = () => {
    const { i18n } = useTranslation();
    const [language, setLanguage] = useState(i18n.language); 

    const handleLangChange = async (locale: string) => {
        bake_cookie("x-current-lang", locale);
        await i18n.changeLanguage(locale);
        console.log("Language after change:", i18n.language); 
        setLanguage(i18n.language); 
        router.visit(window.location.href, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    };

    return (
        <DropdownMenu.Root icon={<Icon name="languages" />}>
            <DropdownMenu.Item
                className="flex items-center capitalize"
                onClick={() => handleLangChange("en")}
            >
                English
                <Check
                    className={`h-4 w-4 ml-auto ${
                        language === "en" // Use the state variable 'language' instead of 'i18n.language'
                            ? "text-primary"
                            : "text-transparent"
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
                        language === "ar" // Use the state variable 'language' instead of 'i18n.language'
                            ? "text-primary"
                            : "text-transparent"
                    }`}
                />
            </DropdownMenu.Item>
        </DropdownMenu.Root>
    );
};

export default LanguageSelector;
